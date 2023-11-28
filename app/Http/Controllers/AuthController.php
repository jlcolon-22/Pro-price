<?php

namespace App\Http\Controllers;

use App\Mail\ForgetMail;
use App\Models\Agent;
use App\Models\Buyer;
use App\Models\Seller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function update_change_password(Request $request,$email,$type)
    {
        $validator = Validator::make($request->all(), [
            'password' =>  ['required', Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()],
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            // Handle validation failure, for example, return back with errors
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if($type == 'buyer')
        {
            $buyer = Buyer::where('email',$request->email)->first();
            $buyer->update([
                'password'=>Hash::make($request->password)
            ]);
            $request->session()->regenerate();
            Auth::guard('buyer')->login($buyer);
              return redirect('/properties')->with('success', 'You successfully changed your password.');
        }
        if($type == 'seller')
        {
            $seller = Seller::where('email',$request->email)->first();
            $seller->update([
                'password'=>Hash::make($request->password)
            ]);
            $request->session()->regenerate();
            Auth::guard('seller')->login($seller);
              return redirect('/properties')->with('success', 'You successfully changed your password.');
        }
        if($type == 'agent')
        {
            $agent = Agent::where('email',$request->email)->first();
            $agent->update([
                'password'=>Hash::make($request->password)
            ]);
            $request->session()->regenerate();
            Auth::guard('agent')->login($agent);
              return redirect('/properties')->with('success', 'You successfully changed your password.');
        }
    }
    public function change_password($email,$type)
    {
        return view('pages.change_password',compact('email','type'));
    }
    public function send_forgot_password(Request $request)
    {
        if(!!Buyer::where('email',$request->email)->first())
        {
            $data = [
                'url'=>'http://127.0.0.1:8000/auth/change_password/'. $request->email.'/buyer'
            ];
        }elseif(!!Agent::where('email',$request->email)->first())
        {
            $data = [
                'url'=>'http://127.0.0.1:8000/auth/change_password/'. $request->email.'/agent'
            ];
        }elseif(!!Seller::where('email',$request->email)->first())
        {
            $data = [
                'url'=>'http://127.0.0.1:8000/auth/change_password/'. $request->email.'/seller'
            ];
        }else{
            return back()->with("error","This email does not exist");
        }

        Mail::to($request->email)->send(new ForgetMail($data));

        return back()->with("success","Please check your email for instructions on changing your password.");
    }
    public function forgot_password()
    {
        return view('pages.forget');
    }
    public function verify_email(Request $request, $email, $type)
    {
        if ($type == "buyer") {
            $buyer = Buyer::where('email', $email)->first();
            $buyer->markEmailAsVerified();
            $request->session()->regenerate();
            Auth::guard('buyer')->login($buyer);
            return redirect('/properties')->with('success', 'Your email has been successfully verified.');
        }
        if ($type == "agent") {
            $agent = Agent::where('email', $email)->first();
            $agent->markEmailAsVerified();
            $request->session()->regenerate();
            Auth::guard('agent')->login($agent);
            return redirect('/properties')->with('success', 'Your email has been successfully verified.');
        }
        if ($type == "seller") {
            $seller = Seller::where('email', $email)->first();
            $seller->markEmailAsVerified();
            $request->session()->regenerate();
            Auth::guard('seller')->login($seller);
            return redirect('/properties')->with('success', 'Your email has been successfully verified.');
        }
    }
    public function admin_login(Request $request)
    {
        return view('pages.admin.login');
    }
    public function admin_login_post(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect('/admin/homepage');
        } else {
            return back()->with('error', 'Wrong Credentials');
        }
    }
    public function store_buyer(Request $request)
    {


        $validator = Validator::make($request->all(), [
            "email" => ['required', 'unique:buyers', 'unique:sellers'],
            'password' =>  ['required', Password::min(8)
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
        $data = [
            'email' => $request->email,
            'url' => 'http://127.0.0.1:8000/auth/verify/' . $request->email . '/buyer'
        ];
        Mail::to($request->email)->send(new VerificationEmail($data));
        $sellerAccount = Buyer::create([
            "email" => $request->email,
            "name" => $request->name,
            "phone_number" => $request->phone_number,
            "password" => Hash::make($request->password),

        ]);

        Session::flash('error_buyer', 'info');

        return back()->with('success', ' A verification link has been sent to your email address.');
    }
    public function store_seller(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "email" => ["required", 'unique:sellers', 'unique:buyers'],
            'license' => ['required'],
            'password' =>  ['required', Password::min(8)
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

        $data = [
            'email' => $request->email,
            'url' => 'http://127.0.0.1:8000/auth/verify/' . $request->email . '/seller'
        ];
        Mail::to($request->email)->send(new VerificationEmail($data));
        $sellerAccount = Seller::create([
            "email" => $request->email,
            "name" => $request->name,
            "phone_number" => $request->phone_number,
            "password" => Hash::make($request->password),

        ]);
        if (!!$request->license) {
            $filename = Str::uuid() . '.' . $request->license->extension();
            $sellerAccount->update([
                'license' => '/storage/seller/license/' . $filename
            ]);
            $request->license->storeAs('public/seller/license', $filename);
        }

        Session::flash('error_seller_success', 'info');

        return back()->with('success', ' A verification link has been sent to your email address.');
    }
    public function store_agent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => ["required", 'unique:sellers', 'unique:buyers'],
            'license' => ['required'],
            'company_name' => ['required'],
            'password' =>  ['required', Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()],

        ]);

        if ($validator->fails()) {
            Session::flash('error_agent', 'info');
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'email' => $request->email,
            'url' => 'http://127.0.0.1:8000/auth/verify/' . $request->email . '/agent'
        ];
        Mail::to($request->email)->send(new VerificationEmail($data));
        $agentAccount = Agent::create([
            "email" => $request->email,
            "name" => $request->name,
            "company_name" => $request->company_name,
            "phone_number" => $request->phone_number,
            "password" => Hash::make($request->password),

        ]);
        if (!!$request->license) {
            $filename = Str::uuid() . '.' . $request->license->extension();
            $agentAccount->update([
                'license' => '/storage/agent/license/' . $filename
            ]);
            $request->license->storeAs('public/agent/license', $filename);
        }

        Session::flash('error_agent', 'info');

        return back()->with('success', ' A verification link has been sent to your email address.');
    }

    public function login_account(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => ['required'],
            'password' =>  ['required'],

        ]);

        if ($validator->fails()) {
            Session::flash('error_login', 'info');
            return back()
                ->withErrors($validator)
                ->withInput();
        }



        if (Auth::guard('seller')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            if (!!Auth::guard('seller')->user()->email_verified_at) {
                return redirect('/');
            } else {
                Auth::guard('seller')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                Session::flash('error_login', 'info');
                return back()->with('error', 'Your email is not verified. Please verify it before logging in. Check your email ' . $request->email . ' to complete the verification.');
            }
        } elseif (Auth::guard('buyer')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();


            if (!!Auth::guard('buyer')->user()->email_verified_at) {
                return redirect('/properties');
            } else {
                Auth::guard('buyer')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                Session::flash('error_login', 'info');
                return back()->with('error', 'Your email is not verified. Please verify it before logging in. Check your email ' . $request->email . ' to complete the verification.');
            }
        } elseif (Auth::guard('agent')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            if (!!Auth::guard('agent')->user()->email_verified_at) {
                return redirect('/');
            } else {
                Auth::guard('agent')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                Session::flash('error_login', 'info');
                return back()->with('error', 'Your email is not verified. Please verify it before logging in. Check your email ' . $request->email . ' to complete the verification.');
            }
        } else {
            Session::flash('error_login', 'info');
            return back()->with('error', 'Wrong Credentials');
        }
    }

    public function user_logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        if (Auth::guard('seller')->check()) {
            Auth::guard('seller')->logout();
        }
        if (Auth::guard('buyer')->check()) {
            Auth::guard('buyer')->logout();
        }
        return redirect('/');
    }
    public function admin_logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        return redirect('/admin/login');
    }
}
