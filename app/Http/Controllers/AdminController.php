<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Buyer;
use App\Models\Seller;
use App\Models\Amenity;
use App\Models\Payment;
use App\Models\Bookmark;
use App\Models\Feedback;
use App\Models\Property;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PropertyPhoto;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function print_sales_report(Request $request)
    {
        if (!!$request->type) {
            if ($request->type == 'Day') {
                $reports = Payment::query()->with('property', 'sellerInfo')->whereDate('created_at', $request->date)->get();

            } elseif ($request->type == 'Month') {
                $reports = Payment::query()->with('property', 'sellerInfo')->whereMonth('created_at', $request->date)->get();
            } elseif ($request->type == 'Year') {
                $reports = Payment::query()->with('property', 'sellerInfo')->whereYear('created_at', $request->date)->get();
            }
            $total = 0;
            foreach ($reports as $report) {
                $total += (int)$report->amount;
            }
            return view('pages.admin.Print', compact('reports', 'total'));
        } else {
            $reports = [];
            return view('pages.admin.Print', compact('reports'));
        }
    }

    public function sales_report(Request $request)
    {
        if (!!$request->type) {
            if ($request->type == 'Day') {
                $reports = Payment::query()->with('property', 'sellerInfo')->whereDate('created_at', $request->date)->get();

            } elseif ($request->type == 'Month') {
                $reports = Payment::query()->with('property', 'sellerInfo')->whereMonth('created_at', $request->date)->get();
            } elseif ($request->type == 'Year') {
                $reports = Payment::query()->with('property', 'sellerInfo')->whereYear('created_at', $request->date)->get();
            }
            $total = 0;
            foreach ($reports as $report) {
                $total += (int)$report->amount;
            }
            return view('pages.admin.sales_report', compact('reports', 'total'));
        } else {
            $reports = [];
            return view('pages.admin.sales_report', compact('reports'));
        }

    }

    public function admin_payment()
    {
        $payments = Payment::with('property', 'sellerInfo')->latest()->paginate(10);
        return view('pages.admin.payments', compact('payments'));
    }

    public function property_delete(Property $id)
    {

        $propertyPhoto = PropertyPhoto::where('property_id', $id->id)->get();
        foreach ($propertyPhoto as $photo) {
            $path = explode('seller/', $photo->photo);
            unlink('storage/seller/' . $path[1]);
            $photo->delete();
        }
        Appointment::where('property_id', $id->id)->delete();
        Bookmark::where('property_id', $id->id)->delete();
        Amenity::where('property_id', $id->id)->delete();
        Payment::query()->where('property_id', $id->id)->delete();
        $path = explode('seller/', $id->title_copy);
        unlink('storage/seller/' . $path[1]);
        $id->delete();


        return back()->with('success', 'Deleted Successfully!');

    }

    public function admin_feedback_delete($id)
    {
        Feedback::where("id", $id)->delete();
        return back()->with("success", "Deteled Successfully!");
    }

    public function admin_feedback()
    {
        $feedbacks = Feedback::with('agent', 'seller', 'buyer')->latest()->paginate(10);
        return view('pages.admin.feedback', compact('feedbacks'));
    }

    public function buyer_account()
    {
        $buyers = Buyer::latest()->paginate(10);
        return view('pages.admin.buyer_account', compact('buyers'));
    }

    public function property_assign($agent, Property $property)
    {
        $property->update([
            'agent_id' => $agent
        ]);
        return back()->with('success', 'Assign Successfully!');
    }

    public function property_agents()
    {
        $agents = Agent::where('status', 1)->get();
        return response()->json($agents);
    }

    public function properties()
    {
        $properties = Property::with('sellerInfo', 'agentInfo')->latest()->paginate(10);
        return view("pages.admin.properties", compact("properties"));
    }

    public function homepage()
    {
        $propertyCount = Property::get()->count();
        $sellerCount = Seller::get()->count();
        $agentCount = Agent::get()->count();
        $buyerCount = Buyer::get()->count();
        $reports = Payment::query()->get()->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('M d Y');
        })->toArray();

        return view('pages.admin.homepage', compact('propertyCount', 'buyerCount', 'agentCount', 'sellerCount', 'reports'));
    }

    public function seller_account()
    {
        $sellers = Seller::latest()->paginate(10);
        return view('pages.admin.seller_account', compact('sellers'));
    }

    // ################## seller #############
    public function agent_account()
    {
        $agents = Agent::latest()->paginate(10);
        return view('pages.admin.agent_account', compact('agents'));
    }

    public function download_license(Seller $id)
    {

        return Storage::disk('public')->download(explode('/storage/', $id->license)[1], $id->name);
    }

    public function seller_approve(Seller $id)
    {
        $id->update([
            'status' => 1
        ]);
        return back()->with('success', 'Updated Successfully!');
    }

    public function seller_decline(Seller $id)
    {
        $id->update([
            'status' => 2
        ]);
        return back()->with('success', 'Updated Successfully!');
    }


    ########## agent ########3
    public function agent_download_license(Agent $id)
    {

        return Storage::disk('public')->download(explode('/storage/', $id->license)[1], $id->name);
    }

    public function agent_approve(Agent $id)
    {
        $id->update([
            'status' => 1
        ]);
        return back()->with('success', 'Updated Successfully!');
    }

    public function agent_decline(Agent $id)
    {
        $id->update([
            'status' => 2
        ]);
        return back()->with('success', 'Updated Successfully!');
    }


    // #################3 property #######################
    public function property_view($id)
    {
        $property = Property::with('photos')->where('id', $id)->first();

        return view('pages.admin.view_property', compact('property'));
    }

    public function property_approve(Property $id)
    {
        $id->update([
            'status' => 1
        ]);
        return back()->with('success', 'Updated Successfully!');
    }

    public function property_decline(Property $id)
    {
        $id->update([
            'status' => 2
        ]);
        return back()->with('success', 'Updated Successfully!');
    }
}
