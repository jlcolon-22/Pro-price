<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Bookmark;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class BuyerController extends Controller
{
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
