<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Agent;
use App\Models\Buyer;
use App\Models\Rating;
use App\Models\Report;
use App\Models\Bookmark;
use App\Models\Feedback;
use App\Models\Property;
use App\Models\Appointment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class BuyerController extends Controller
{
    public function buyer_appointment_report_check(Report $id)
    {

        $property = Property::where('id',$id->property_id)->update([
            'status'=>3
        ]);
        $id->update(["status"=>true]);
        return response()->json(['id'=>$id->appointment_id]);
    }
    public function buyer_appointment_report($id)
    {
        return response()->json(Report::where('appointment_id',$id)->get());
    }

    public function buyer_agent_rate($value, $agent, $property)
    {
        $check = Rating::where('buyer_id',Auth::guard('buyer')->id())->where('agent_id',$agent)->first();
        if($check)
        {
            $check->update([
                'rating'=>$value
            ]);
        }else{
            Rating::create([
                'property_id'=>$property,
                'rating'=>$value,
                'agent_id'=>$agent,
                'buyer_id'=>Auth::guard('buyer')->id()
            ]);
        }

        return back()->with('success','Rate Submitted Successfully');
    }
    public function buyer_add_feedback(Request $request)
    {
        Feedback::query()->create([
            'feedback'=>$request->feedback,
            'user_type'=>'buyer',
            'user_id'=>Auth::guard('buyer')->id(),
        ]);
        return redirect()->back()->with('success','Submited Successfully!');
    }
    public function buyer_delete_feedback( $feedback)
    {
        Feedback::where('id',$feedback)->delete();
        return redirect()->back()->with('success','Deleted Successfully!');
    }
    public function buyer_feedback(Request $request)
    {
        $feedbacks = Feedback::where('user_id',Auth::guard('buyer')->id())->where('user_type','buyer')->latest()->paginate(7);
        return view('pages.buyer.feedback',compact('feedbacks'));
    }
    public function buyer_appointment()
    {
        $appointments = Appointment::query()->with('propertyDetails','agentInfo','reports')->where('buyer_id',Auth::guard('buyer')->id())->latest()->paginate(10);
        return view('pages.buyer.appointment',compact('appointments'));
    }
    public function buyer_add_ppointment(Request $request,$property, $agent)
    {
        $appointment = Appointment::query()->create([
            'date'=>$request->date,
            'time'=>$request->time,
            'purpose'=>$request->purpose,
            'agent_id'=>$agent,
            'property_id'=>$property,
            'buyer_id'=>Auth::guard('buyer')->user()->id
        ]);
        $agentInfo = Agent::where('id',$agent)->first();
        Report::create([
            'report'=>'Buyer '.Auth::guard('buyer')->user()->name.' book an appointment for this property this '.Carbon::now()->format('d-m-y'),
            'appointment_id'=>$appointment->id,
            'status'=>true,
            'property_id'=>$property,
        ]);
        Report::create([
            'report'=>'Agent '. $agentInfo->name .' confirms the appointment',
            'appointment_id'=>$appointment->id,
              'property_id'=>$property,
        ]);
        Report::create([
            'report'=>'Negotiation',
            'appointment_id'=>$appointment->id,
            'property_id'=>$property,
        ]);
        Report::create([
            'report'=>'Gather required documents',
            'appointment_id'=>$appointment->id,
            'property_id'=>$property,
        ]);
        Report::create([
            'report'=>'Confirm closing date (Contact the title company or attorney to confirm the closing date)',
            'appointment_id'=>$appointment->id,
            'property_id'=>$property,
        ]);
        Report::create([
            'report'=>'Inspections and repairs',
            'appointment_id'=>$appointment->id,
            'property_id'=>$property,
        ]);
        Report::create([
            'report'=>'Review and sign documents',
            'appointment_id'=>$appointment->id,
            'property_id'=>$property,
        ]);
        Report::create([
            'report'=>'Final walk-through',
            'appointment_id'=>$appointment->id,
            'property_id'=>$property,
        ]);
        Report::create([
            'report'=>'Finalize the deal (Exchange of keys and funds)',
            'appointment_id'=>$appointment->id,
            'property_id'=>$property,
        ]);
        return back()->with('success','Submited Successully!');
    }
    public function buyer_update_account_password(Request $request)
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
        $user = Buyer::where('id', Auth::guard('buyer')->user()->id)->first();
        $user->update([
            'password'=> Hash::make($request->password),
        ]);
        return back()->with('success','Password Updated Successfully!');

    }
    public function buyer_update_account_profile(Request $request)
    {
        $filename = Str::uuid() . '.' . $request->profile->extension();
        $user = Buyer::where('id', Auth::guard('buyer')->user()->id)->first();
        if (!!$user->profile) {

            $path = explode('profile/', $user->profile);
            unlink('storage/profile/' . $path[1]);
        }
        $user->update([
            'profile' => '/storage/profile/' . $filename
        ]);
        $request->profile->storeAs('public/profile', $filename);
        return redirect()->back()->with('success', 'Profile Updated Successfully!');
    }
    public function buyer_update_account(Request $request)
    {
        $user = Buyer::where('id', Auth::guard('buyer')->user()->id)->first();
        $user->update([
            "name" => $request->name,
            "phone_number" => $request->phone_number,
            "email" => $request->email,

        ]);
        return back()->with("success", "Updated Successfully!");
    }
    public function buyer_account()
    {
        return view('pages.buyer.account');
    }
    public function buyer_add_bookmark($id)
    {
        $check = Bookmark::query()->where('buyer_id', Auth::guard('buyer')->id())->where('property_id', $id)->first();
        if ($check) {
            $check->delete();
        } else {
            Bookmark::query()->create([
                'buyer_id' => Auth::guard('buyer')->id(),
                'property_id' => $id
            ]);
        }

        return back();
    }

    public function buyer_bookmarks()
    {
        $bookmarks = Bookmark::query()->with('property', function ($q) {
            $q->with('photo');
        })->where('buyer_id', Auth::guard('buyer')->id())->latest()->paginate(10);
        return view('pages.buyer.bookmarks', compact('bookmarks'));
    }
}
