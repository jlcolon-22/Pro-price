<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Property;
use App\Mail\ContactMail;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{
    public function send_contact(Request $request)
    {
        $data = [
            'email'=>$request->email,
            'name'=>$request->name,
            'message'=>$request->message,
        ];
        Mail::to('xxdekuxxweak@gmail.com')->send(new ContactMail($data));
        Session::flash('success_contact', 'info');
        return back()->with('success','Submited Successfully!');

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
        $properties = Property::with('photo')->latest()->paginate(6);

        return view("homepage",compact('properties'));
    }
    public function contact_seller_property(Property $id)
    {
        if($id->user_type == false)
        {
         $property = Property::with('photo','sellerInfo')->find($id->id);
         $type = 'seller';
        }else{
         $property = Property::with('photo','agentInfo')->find($id->id);
         $type = 'agent';
        }
        $bookmark = false;
        if(Auth::guard('buyer')->check())
        {

           $check = Bookmark::query()->where('buyer_id',Auth::guard('buyer')->id())->where('property_id',$property->id)->first();
           if($check)
           {
            $bookmark = true;
           }

        }
        return view("pages.propert_seller_contact",compact('property','bookmark','type'));
    }
    public function properties(Request $request)
    {
        if($request->type && $request->location && $request->price)
        {
            $properties = Property::with('photo')->where('status',1)->where('agent_id','!=', null)->where('address','LIKE', '%'.$request->location.'%')->where('type', $request->type)->where('price','>', $request->price)->latest()->paginate(15);
            return view("pages.properties",compact('properties'));
        }

        if($request->type && $request->price)
        {
            $properties = Property::with('photo')->where('status',1)->where('agent_id','!=', null)->where('type', $request->type)->where('price','>=', $request->price)->latest()->paginate(15);
            return view("pages.properties",compact('properties'));
        }
        if($request->location && $request->price)
        {

            $properties = Property::with('photo')->where('status',1)->where('agent_id','!=', null)->where('address','LIKE', '%'.$request->location.'%')->where('price','>=', $request->price)->latest()->paginate(15);
            return view("pages.properties",compact('properties'));
        }
        if($request->price)
        {
            $properties = Property::with('photo')->where('status',1)->where('agent_id','!=', null)->where('price','>', $request->price)->latest()->paginate(15);

            return view("pages.properties",compact('properties'));
        }

        $properties = Property::with('photo')->where('status',1)->where('agent_id','!=', null)->latest()->paginate(15);
        return view("pages.properties",compact('properties'));
    }
    public function view_property(Property $id)
    {


        $property = Property::with('photos','agentInfo')->find($id->id);
        $type = 'seller';


        $bookmark = false;
        $appointment = [
            'status' => false
        ];
        if(Auth::guard('buyer')->check())
        {
           $check = Bookmark::query()->where('buyer_id',Auth::guard('buyer')->id())->where('property_id',$property->id)->first();
           if($check)
           {
            $bookmark = true;
           }
           $checkAppointment = Appointment::query()->where('buyer_id',Auth::guard('buyer')->id())->where('property_id',$property->id)->first();
           if($checkAppointment)
           {
            $appointment = $checkAppointment;
           }

        }

        return view("pages.view_property",compact('property','bookmark','type','appointment'));
    }
}
