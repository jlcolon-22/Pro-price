<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Seller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function store_buyer(Request $request)
   {

                $validator = Validator::make($request->all(), [
                    "email"=> ['required','unique:buyers', 'unique:sellers'],
                    'password' =>  ['required',Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()],
                ]);

                if ($validator->fails()) {
                    Session::flash('error_buyer', 'info');
                    return back()
                        ->withErrors($validator)
                        ->withInput();
                }

            $sellerAccount = Buyer::create([
                "email"=> $request->email,
                "name"=> $request->name,
                "phone_number"=> $request->phone_number,
                "password"=> Hash::make($request->password),

            ]);

            Session::flash('error_buyer', 'info');

            return back()->with('success','Created Successfully!');
    }
    public function store_seller(Request $request)
   {
                $validator = Validator::make($request->all(), [
                    "email"=> ["required" ,'unique:sellers','unique:buyers'],
                    'license'=>['required'],
                    'password' =>  ['required',Password::min(8)
                        ->mixedCase()
                        ->letters()
                        ->numbers()
                        ->symbols()
                        ->uncompromised()],

                ]);

                if ($validator->fails()) {
                    Session::flash('error_seller', 'info');
                    return back()
                        ->withErrors($validator)
                        ->withInput();
                }


            $sellerAccount = Seller::create([
                "email"=> $request->email,
                "name"=> $request->name,
                "phone_number"=> $request->phone_number,
                "password"=> Hash::make($request->password),

            ]);
            if(!!$request->license)
            {
                $filename = Str::uuid().'.'.$request->license->extension();
                $sellerAccount->update([
                    'license'=>'/storage/seller/license/'.$filename
                ]);
                $request->license->storeAs('public/seller/license',$filename);
            }

            Session::flash('error_seller', 'info');

            return back()->with('success','Created Successfully!');
    }

    public function login_account(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email"=> ['required'],
            'password' =>  ['required'],

        ]);

        if ($validator->fails()) {
            Session::flash('error_login', 'info');
            return back()
                ->withErrors($validator)
                ->withInput();
        }



        if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password]))
        {

        }elseif(Auth::guard('seller')->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $request->session()->regenerate();

            return redirect('/');
        }elseif(Auth::guard('buyer')->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $request->session()->regenerate();

            return redirect('/properties');
        }
        else{
            Session::flash('error_login', 'info');
            return back()->with('error','Wrong Credentials');
        }
    }

    public function user_logout(Request $request)
    {
        $request->session()->invalidate();
            $request->session()->regenerateToken();
        if(Auth::guard('seller')->check())
        {
            Auth::guard('seller')->logout();
        }
        if(Auth::guard('buyer')->check())
        {
            Auth::guard('buyer')->logout();
        }
        return redirect('/');
    }
}
