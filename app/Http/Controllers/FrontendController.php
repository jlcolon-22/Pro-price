<?php

namespace App\Http\Controllers;

use League\Csv\Reader;
use Phpml\Math\Matrix;
use App\Models\Bookmark;
use App\Models\Property;
use App\Mail\ContactMail;
use App\Models\Appointment;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Phpml\Regression\LeastSquares;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{
    public function predict_property($id , $number)
    {

        $percent = 3.4;

        // get propery value
        $property = Property::with('photo')->find($id);
        if($property->area_situation == 'flood_prone_area')
        {
            $percent = 2.4;
        }
        if($property->area_situation == 'landslide')
        {
            $percent = 1.4;
        }
        $csv = Reader::createFromPath(public_path('antipolo.csv'));
        $data = $csv->setHeaderOffset(0)->getRecords();

        $samples = [];
        $targets = [];
        foreach ($data as $row) {
            $samples[] = [(float) $row['Price (PHP)'], (int) $row['Lot Area (sqm)'] , (int) $row['Floor Area (sqm)'] ,  (int) $row['Number of Floors']];
            $targets[] = (float) $row['Price (PHP)'];
        }
        // dd((int)$property->price);
        $regression = new LeastSquares();
        $regression->train($samples, $targets);

        // Predict house prices for the next 10 years
        $future_predictions = [];
        $current_year = date('Y');
        $curentPrice = (float)$property->price;
        $yers = [];
        for ($i = 1; $i <= (int)$number; $i++) {

            $prediction = $regression->predict([ [ (float)$curentPrice,(int)$property->land_size, (int)$property->floor_area, (int)$property->floor_number]]);

            $yers[] = $current_year + $i;
            $future_predictions[] = [
                'year' => $current_year + $i,
                'prediction' => isset($prediction[0]) ? ($prediction[0] * ($percent / 100)) + $prediction[0] : null,
            ];
            $curentPrice = isset($prediction[0]) ? ($prediction[0] * ($percent  / 100)) + $prediction[0] : (float)$property->price;

        }

        // 222222
        // Output the predictions

        $changePercent = ((end($future_predictions)['prediction'] - (float)$property->price) /  (float)$property->price) * 100;
        $collection = new Collection();


        $try = 'ss';
        return view("pages.predict",compact('future_predictions','changePercent','property','try'));
    }
    public function send_contact(Request $request)
    {
        $data = [
            'email' => $request->email,
            'name' => $request->name,
            'message' => $request->message,
        ];
        Mail::to('proprice38@gmail.com')->send(new ContactMail($data));
        Session::flash('success_contact', 'info');
        return back()->with('success', 'Submited Successfully!');
    }
    public function about()
    {
        return view("pages.about");
    }
    public function contact()
    {
        return view("pages.contact");
    }
    public function terms_and_conditions()
    {
        return view("pages.terms_conditions");
    }
    public function privacy()
    {
        return view("pages.privacy");
    }
    public function homepage()
    {
        $properties = Property::with('photo')->latest()->paginate(3);

        return view("homepage", compact('properties'));
    }
    public function contact_seller_property(Property $id)
    {
        if ($id->user_type == false) {
            $property = Property::with('photo', 'sellerInfo')->find($id->id);
            $type = 'seller';
        } else {
            $property = Property::with('photo', 'agentInfo')->find($id->id);
            $type = 'agent';
        }
        $bookmark = false;
        if (Auth::guard('buyer')->check()) {

            $check = Bookmark::query()->where('buyer_id', Auth::guard('buyer')->id())->where('property_id', $property->id)->first();
            if ($check) {
                $bookmark = true;
            }
        }
        return view("pages.propert_seller_contact", compact('property', 'bookmark', 'type'));
    }
    public function properties(Request $request)
    {
        $page = 15;
        if(Auth::guard('seller')->check() || Auth::guard('buyer')->check() || Auth::guard('agent')->check())
        {
            $page = 3;
        }
        if ($request->type && $request->location && $request->price) {
            $properties = Property::with('photo')->where('status', 1)->where('agent_id', '!=', null)->where('address', 'LIKE', '%' . $request->location . '%')->where('type', $request->type)->where('price', '>', $request->price)->latest()->paginate($page);
            return view("pages.properties", compact('properties'));
        }

        if ($request->type && $request->price) {
            $properties = Property::with('photo')->where('status', 1)->where('agent_id', '!=', null)->where('type', $request->type)->where('price', '>=', $request->price)->latest()->paginate($page);
            return view("pages.properties", compact('properties'));
        }
        if ($request->location && $request->price) {

            $properties = Property::with('photo')->where('status', 1)->where('agent_id', '!=', null)->where('address', 'LIKE', '%' . $request->location . '%')->where('price', '>=', $request->price)->latest()->paginate($page);
            return view("pages.properties", compact('properties'));
        }
        if ($request->price) {
            $properties = Property::with('photo')->where('status', 1)->where('agent_id', '!=', null)->where('price', '>', $request->price)->latest()->paginate($page);

            return view("pages.properties", compact('properties'));
        }

        $properties = Property::with('photo')->where('status', 1)->where('agent_id', '!=', null)->latest()->paginate($page);
        return view("pages.properties", compact('properties'));
    }
    public function view_property(Property $id)
    {


        $property = Property::with('photos','amenities','sellerInfo')->with('agentInfo',function($q)
        {
            $q->with('getRating');
        })->find($id->id);
        $type = 'seller';
        if(Auth::guard('agent')->check())
        {
            $type = 'agent';
        }

        $bookmark = false;
        $appointment = [
            'status' => false
        ];
        if (Auth::guard('buyer')->check()) {
            $check = Bookmark::query()->where('buyer_id', Auth::guard('buyer')->id())->where('property_id', $property->id)->first();
            if ($check) {
                $bookmark = true;
            }
            $checkAppointment = Appointment::query()->where('buyer_id', Auth::guard('buyer')->id())->where('property_id', $property->id)->first();
            if ($checkAppointment) {
                $appointment = $checkAppointment;
            }
        }

        return view("pages.view_property", compact('property', 'bookmark', 'type', 'appointment'));
    }
}
