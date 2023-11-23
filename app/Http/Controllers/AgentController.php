<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Property;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AgentController extends Controller
{
    public function agent_assign_propery()
    {
        $properties = Property::with('photo')->where('agent_id',Auth::guard('agent')->user()->id)->paginate(10);
        return view('pages.agent.assign',compact('properties'));
    }
    public function agent_account()
    {
        return view('pages.agent.account');
    }

    public function agent_update_account(Request $request)
    {
        $user = Agent::where('id',Auth::guard('agent')->user()->id)->first();
        $user->update([
                "name"=> $request->name,
                "phone_number"=> $request->phone_number,
                "email"=> $request->email,
                "company_name"=> $request->company_name,

        ]);
        return back()->with("success","Updated Successfully!");
    }

    public function agent_update_account_profile(Request $request)
    {
        $filename = Str::uuid().'.'.$request->profile->extension();
        $user = Agent::where('id',Auth::guard('agent')->user()->id)->first();
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

    public function agent_update_account_password(Request $request)
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
        $user = Agent::where('id', Auth::guard('agent')->user()->id)->first();
        $user->update([
            'password'=> Hash::make($request->password),
        ]);
        return back()->with('success','Password Updated Successfully!');
    }
}
