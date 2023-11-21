<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Seller;
use App\Models\Property;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PropertyPhoto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class SellerController extends Controller
{
    public function seller_update_account_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' =>  ['required','same:confirm_password',Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()],
            'confirm_password' => ['required'],
        ]);

        if ($validator->fails()) {
            Session::flash('error_password', 'info');
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = Seller::where('id', Auth::guard('seller')->user()->id)->first();
        $user->update([
            'password'=> Hash::make($request->password),
        ]);
        return back()->with('success','Password Updated Successfully!');
    }
    public function seller_update_account_profile(Request $request)
    {
        $filename = Str::uuid().'.'.$request->profile->extension();
        $user = Seller::where('id',Auth::guard('seller')->user()->id)->first();
        if(!!$user->profile)
        {

                $path = explode('profile/',$user->profile);
                unlink('storage/profile/'.$path[1]);
        }
        $user->update([
            'profile'=>'/storage/profile/'.$filename
        ]);
        $request->profile->storeAs('public/profile',$filename);
        return redirect()->back()->with('success','Profile Updated Successfully!');
    }
    public function seller_update_account(Request $request)
    {
        $user = Seller::where('id',Auth::guard('seller')->user()->id)->first();
        $user->update([
                "name"=> $request->name,
                "phone_number"=> $request->phone_number,
                "email"=> $request->email,

        ]);
        return back()->with("success","Updated Successfully!");
    }

    public function seller_account()
    {
        return view('pages.seller.account');
    }

    public function manage_properties(Request $request)
    {
        $properties = Property::with('photo')->where('seller_id',Auth::guard('seller')->id())->latest()->paginate(9);

        return view('pages.seller.manage_properties',compact('properties'));
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
                $photo->storeAs('public/seller/property',$filename);
            }
        }

        return redirect('/seller/manage_properties')->with('success','Created Successfully!');
    }

    public function edit_property($id)
    {
        $property = Property::query()->with('photos')->where('id',$id)->first();
    return view('pages.seller.edit_property',compact('property'));
    }

    public function update_property(Request $request, $id)
    {
        $property = Property::query()->where('id',$id)->where('seller_id',Auth::guard('seller')->user()->id)->first();
        $property->update(
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
                $photo->storeAs('public/seller/property',$filename);
            }
        }
        return back()->with('success','Updated Successfully!');
    }

    public function delete_property($id)
    {


        $property = Property::query()->where('id',$id)->where('seller_id',Auth::guard('seller')->user()->id)->first();
        if($property)
        {
            $photos = PropertyPhoto::query()->where('property_id',$property->id)->get();
            foreach($photos as $photo)
            {
                $path = explode('property/',$photo->photo);
                unlink('storage/seller/property/'.$path[1]);
                $photo->delete();
            }
            Bookmark::where('property_id',$property->id)->delete();
            $property->delete();
        }
        return back()->with('success','Deleted Successfully!');
    }

    public function delete_property_photo(PropertyPhoto $id)
    {
        $path = explode('property/',$id->photo);
        unlink('storage/seller/property/'.$path[1]);
        $id->delete();
        return back()->with('success','Photo Deleted Successfully!');
    }
}
