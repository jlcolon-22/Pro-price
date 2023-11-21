<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
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
    public function properties()
    {
        $properties = Property::with('photo')->latest()->paginate(15);
        return view("pages.properties",compact('properties'));
    }
    public function view_property(Property $id)
    {

       if($id->user_type == false)
       {
        $property = Property::with('photos','sellerInfo')->find($id->id);
        $type = 'seller';
       }else{
        $property = Property::with('photos','agentInfo')->find($id->id);
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
        return view("pages.view_property",compact('property','bookmark','type'));
    }
}
