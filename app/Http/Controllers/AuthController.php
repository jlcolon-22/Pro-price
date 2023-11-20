<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function store_seller(Request $request)
   {


            $request->validate([
                "email"=> "required|unique:sellers",
                'license'=>'required',
                'password' =>['required', Password::min(8)],
            ]);

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

            Session::flash('seller', 'info');

            return back()->with('success','Created Successfully!');
    }

    public function login_account(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password' =>['required', Password::min(8)],
        ]);

        if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password]))
        {

        }elseif(Auth::guard('seller')->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $request->session()->regenerate();

            return redirect('/');
        }
        else{
            return back()->with('error','Wrong Credentials');
        }
    }
}
