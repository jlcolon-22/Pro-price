<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyPhoto;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function manage_properties(Request $request)
    {
        return view('pages.seller.manage_properties');
    }
    public function add_property(Request $request)
    {
        return view('pages.seller.add_property');
    }
    public function store_property(Request $request)
    {

        $request->validate([
            'title'=>'required',
            'type'=>'required',
            'floor_area'=>'required',
            'floor_number'=>'required',
            'land_size'=>'required',
            'price'=>'required',
            'bed_room'=>'required',
            'bath_room'=>'required',
            'address'=>'required',
            'description'=>'required',
        ]);
        $property = Property::query()->create(
            [
                'title'=>$request->title,
                'type'=>$request->type,
                'floor_area'=>$request->floor_area,
                'floor_number'=>$request->floor_number,
                'status'=>$request->status,
                'land_size'=>$request->land_size,
                'price'=>$request->price,
                'seller_id'=>Auth::guard('seller')->id(),
                'bed_room'=>$request->bed_room,
                'bath_room'=>$request->bath_room,
                'address'=>$request->address,
                'description'=>$request->description,
            ]
        );
        if(!!$request->photo)
        {
            foreach($request->photo as $photo)
            {

                $filename =  Str::uuid().'.'.$photo->extension();
                PropertyPhoto::create([
                    'property_id'=>$property->id,
                    'photo'=>'/storage/seller/property/'.$filename
                ]);
                $photo->storeAs('public/property',$filename);
            }
        }

        return back()->with('success','Created Successfully!');
    }
}
