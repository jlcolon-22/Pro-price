<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Buyer;
use App\Models\Seller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function buyer_account()
    {
        $buyers = Buyer::latest()->paginate(10);
        return view('pages.admin.buyer_account',compact('buyers'));
    }

    public function property_assign($agent ,Property $property)
    {
       $property->update([
        'agent_id'=>$agent
       ]);
       return back()->with('success','Assign Successfully!');
    }
    public function property_agents()
    {
        $agents = Agent::where('status',1)->get();
        return response()->json($agents);
    }
    public function properties()
    {
        $properties = Property::with('sellerInfo','agentInfo')->latest()->paginate(10);
        return view("pages.admin.properties", compact("properties"));
    }
    public function homepage()
    {
        $propertyCount = Property::get()->count();
        $sellerCount = Seller::get()->count();
        $agentCount = Agent::get()->count();
        $buyerCount = Buyer::get()->count();

        return view('pages.admin.homepage',compact('propertyCount','buyerCount','agentCount','sellerCount'));
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

        return Storage::disk('public')->download(explode('/storage/',$id->license)[1],$id->name);
    }

    public function seller_approve(Seller $id)
    {
        $id->update([
            'status'=>1
        ]);
        return back()->with('success','Updated Successfully!');
    }
    public function seller_decline(Seller $id)
    {
        $id->update([
            'status'=>2
        ]);
        return back()->with('success','Updated Successfully!');
    }


    ########## agent ########3
    public function agent_download_license(Agent $id)
    {

        return Storage::disk('public')->download(explode('/storage/',$id->license)[1],$id->name);
    }
    public function agent_approve(Agent $id)
    {
        $id->update([
            'status'=>1
        ]);
        return back()->with('success','Updated Successfully!');
    }
    public function agent_decline(Agent $id)
    {
        $id->update([
            'status'=>2
        ]);
        return back()->with('success','Updated Successfully!');
    }


    // #################3 property #######################
    public function property_view( $id)
    {
        $property = Property::with('photos')->where('id',$id)->first();

        return view('pages.admin.view_property',compact('property'));
    }
    public function property_approve(Property $id)
    {
        $id->update([
            'status'=>1
        ]);
        return back()->with('success','Updated Successfully!');
    }
    public function property_decline(Property $id)
    {
        $id->update([
            'status'=>2
        ]);
        return back()->with('success','Updated Successfully!');
    }
}
