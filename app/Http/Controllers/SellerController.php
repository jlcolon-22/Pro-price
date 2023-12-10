<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Seller;
use App\Models\Amenity;
use App\Models\Payment;
use App\Models\Bookmark;
use App\Models\Feedback;
use App\Models\Property;
use App\Models\Appointment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PropertyPhoto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Luigel\Paymongo\Facades\Paymongo;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class SellerController extends Controller
{
    public function seller_payment()
    {
        $payments = Payment::with('property')->where('seller_id',Auth::guard('seller')->id())->latest()->paginate(10);
        return view('pages.seller.paymeny',compact('payments'));
    }
    public function boost_property($id)
    {
        // $paymentIntent = Paymongo::paymentIntent()->find('pi_enrx9Tm2EoEi69WRoc7iVFrR');
        // dd($paymentIntent);
        $checkout = Paymongo::checkout()->create([
            'cancel_url' => 'http://127.0.0.1:8000/seller/manage_properties',
            'billing' => [
                'name' => Auth::guard('seller')->user()->name,
                'email' => Auth::guard('seller')->user()->email,
                'phone' => Auth::guard('seller')->user()->phone_number,
            ],
            // 'description' => 'My checkout session description',
            'line_items' => [
                [
                    'amount' => 69900,
                    'currency' => 'PHP',
                    // 'description' => 'Something of a product.',
                    // 'images' => [
                    //     'https://images.unsplash.com/photo-1613243555988-441166d4d6fd?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80'
                    // ],
                    'name' => 'Property Boosting',
                    'quantity' => 1
                ]
            ],
            'payment_method_types' => [
                'gcash',
                'paymaya'
            ],
            'success_url' => 'http://127.0.0.1:8000/seller/manage_properties',
            'statement_descriptor' => 'Pro Price',
            'metadata' => [
                'Key' => 'Value'
            ]
        ]);
        // dd($checkout);
        $payment_id =$checkout->payment_intent['id'];
        $checkPayment = $checkout->payment_intent['attributes']['payments'];
        Payment::create([
            'status'=>'unpaid',
            'property_id'=>$id,
            'seller_id'=>Auth::guard('seller')->id(),
            'payment_id'=>$payment_id,
            'amount'=>69900
        ]);

        return redirect($checkout->checkout_url);
    }
    public function seller_sold_property(Request $request, Property $id)
    {
        $report = Report::where('property_id',$id->id)->where('status',1)->orderBy('id','desc')->first();
        $appointment = Appointment::with('buyerInfo')->where('id',$report->appointment_id)->first();
        $check = Report::where('report','Seller changes the status of the property to SOLD')->where('appointment_id',$appointment->id)->first();
        if($check)
        {
            $id->update([
                'closed_date'=>$request->date,
                // 'status'=>3
            ]);
            $check->update([
                'status'=>true
            ]);
            return back()->with('success','Updated Successfully');
        }
        Report::create([
            'report'=>'Seller changes the status of the property to SOLD',
            'appointment_id'=>$report->appointment_id,
            'property_id'=>$report->property_id,
            'status'=>true
        ]);
        Report::create([
            'report'=>"Buyer ".$appointment->buyerInfo->name." confirms that property is sold",
            'appointment_id'=>$report->appointment_id,
            'property_id'=>$report->property_id,
            'status'=>false
        ]);
        $id->update([
            'closed_date'=>$request->date,
            // 'status'=>3
        ]);

        return back()->with('success','Updated Successfully');
    }
    public function seller_delete_feedback($feedback)
    {
        Feedback::where('id',$feedback)->delete();
        return redirect()->back()->with('success','Deleted Successfully!');
    }
    public function seller_feedback(Request $request)
    {
        $feedbacks = Feedback::where('user_id',Auth::guard('seller')->id())->where('user_type','seller')->latest()->paginate(7);
        return view('pages.seller.feedback',compact('feedbacks'));
    }
    public function seller_add_feedback(Request $request)
    {
        Feedback::query()->create([
            'feedback'=>$request->feedback,
            'user_type'=>'seller',
            'user_id'=>Auth::guard('seller')->id(),
        ]);
        return redirect()->back()->with('success','Submited Successfully!');
    }
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
        if($request->sortby == 'pending')
        {
            $properties = Property::with('photo','agentInfo')->with('appointments',function($q){
                $q->with('buyerInfo')->with('reports');
            })->where('seller_id',Auth::guard('seller')->id())->where('status',0)->latest()->paginate(9);
            return view('pages.seller.manage_properties',compact('properties'));
        }
        if($request->sortby == 'approved')
        {
            $properties = Property::with('photo','agentInfo')->with('appointments',function($q){
                $q->with('buyerInfo')->with('reports');
            })->where('seller_id',Auth::guard('seller')->id())->where('status',1)->latest()->paginate(9);
            return view('pages.seller.manage_properties',compact('properties'));
        }
        if($request->sortby == 'sold')
        {
            $properties = Property::with('photo','agentInfo')->with('appointments',function($q){
                $q->with('buyerInfo')->with('reports');
            })->where('seller_id',Auth::guard('seller')->id())->where('status',3)->latest()->paginate(9);
            return view('pages.seller.manage_properties',compact('properties'));
        }
        $properties = Property::with('photo','agentInfo')->with('appointments',function($q){
            $q->with('buyerInfo')->with('reports');
        })->where('seller_id',Auth::guard('seller')->id())->latest()->paginate(9);
        // dd( $properties);
//         ,function($r){
//             $r->orderBy('id','desc')->first();
//         }
// ,function($r){
//             $r->orderBy('id','desc')->first();
//         }
// ,function($r){
//             $r->orderBy('id','desc')->first();
//         }
        foreach($properties as $property)
        {
            $payment = Payment::where('property_id',$property->id)->latest()->first();
            if($payment)
            {
                $paymentIntent = Paymongo::paymentIntent()->find($payment->payment_id);

                // dd($paymentIntent->payments);


                if(!!$paymentIntent->payments)
                {
                    $payment->update([
                        'status'=>$paymentIntent->payments[0]['attributes']['status']
                    ]);
                    $property->update([
                        'boosted'=>date("Y-m-d H:i:s", $paymentIntent->payments[0]['attributes']['paid_at'])
                    ]);
                }
            }
        }

        return view('pages.seller.manage_properties',compact('properties'));
    }
    public function add_property(Request $request)
    {

        return view('pages.seller.add_property');
    }
    public function store_property(Request $request)
    {

        $validator = Validator::make($request->all(), [
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
            'title_copy'=>'required',
            'area_situation'=>'required',
            // 'photos.0'=>['required'],
            'outdoor'=>['required', 'array'],
            'outdoor.*' => ['required'],
            'indoor'=>['required', 'array'],
            'indoor.*' => ['required'],
            'photo'=>['required', 'array'],
            'photo.*' => ['required'],


        ]);


        if ($validator->fails()) {

            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $property = Property::query()->create(
            [
                'title'=>$request->title,
                'type'=>$request->type,
                'floor_area'=>$request->floor_area,
                'floor_number'=>$request->floor_number,

                'land_size'=>$request->land_size,
                'price'=>$request->price,
                'seller_id'=>Auth::guard('seller')->id(),
                'bed_room'=>$request->bed_room,
                'bath_room'=>$request->bath_room,
                'address'=>$request->address,
                'description'=>$request->description,
                'longitude'=>$request->longitude,
                'latitude'=>$request->latitude,
                'area_situation'=>$request->area_situation

            ]
        );
        foreach ($request->outdoor as $odoor) {
            Amenity::create([
                'property_id'=>$property->id,
                'amenity'=>$odoor
            ]);
        }
        foreach ($request->indoor as $idoor) {
            Amenity::create([
                'property_id'=>$property->id,
                'amenity'=>$idoor,
                'type'=>1
            ]);
        }
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
        if(!!$request->title_copy)
        {
            $filename =  Str::uuid().'.'.$request->title_copy->extension();
               $property->update([
                'title_copy'=>'/storage/seller/property/title/'.$filename
               ]);
                $request->title_copy->storeAs('public/seller/property/title',$filename);
        }

        return redirect('/seller/manage_properties')->with('success','Created Successfully!');
    }

    public function edit_property($id)
    {
        $property = Property::query()->with('photos')->with('amenities')->where('id',$id)->first();

        $odoor = [];
        $idoor = [];
        foreach($property['amenities'] as $amenity)
        {
            if($amenity['type'] == 0)
            {
                $odoor[] = $amenity['amenity'];
            }else{
                $idoor[] = $amenity['amenity'];
            }
        }



    return view('pages.seller.edit_property',compact('property','odoor','idoor'));
    }

    public function update_property(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
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

            'area_situation'=>'required',
            // 'photos.0'=>['required'],
            'outdoor'=>['required', 'array'],
            'outdoor.*' => ['required'],
            'indoor'=>['required', 'array'],
            'indoor.*' => ['required'],



        ]);


        if ($validator->fails()) {

            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $property = Property::query()->where('id',$id)->where('seller_id',Auth::guard('seller')->user()->id)->first();
        $property->update(
            [
                'title'=>$request->title,
                'type'=>$request->type,
                'floor_area'=>$request->floor_area,
                'floor_number'=>$request->floor_number,
                'land_size'=>$request->land_size,
                'price'=>$request->price,
                'seller_id'=>Auth::guard('seller')->id(),
                'bed_room'=>$request->bed_room,
                'bath_room'=>$request->bath_room,
                'address'=>$request->address,
                'description'=>$request->description,
                'longitude'=>$request->longitude,
                'latitude'=>$request->latitude,
                'area_situation'=>$request->area_situation
            ]
        );
        Amenity::where('property_id',$property->id)->delete();
        foreach ($request->outdoor as $odoor) {
            Amenity::create([
                'property_id'=>$property->id,
                'amenity'=>$odoor
            ]);
        }
        foreach ($request->indoor as $idoor) {
            Amenity::create([
                'property_id'=>$property->id,
                'amenity'=>$idoor,
                'type'=>1
            ]);
        }
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
        if(!!$request->title_copy)
        {
            $path = explode('property/',$property->title_copy);
            unlink('storage/seller/property/'.$path[1]);
            $filename =  Str::uuid().'.'.$request->title_copy->extension();
            $property->update([
             'title_copy'=>'/storage/seller/property/title/'.$filename
            ]);
             $request->title_copy->storeAs('public/seller/property/title',$filename);
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
