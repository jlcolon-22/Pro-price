<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function properties()
    {
        $properties = Property::with('photo')->latest()->paginate(15);
        return view("pages.properties",compact('properties'));
    }
    public function view_property($id)
    {
        $property = Property::with('photos','userInfo')->find($id);
        return view("pages.view_property",compact('property'));
    }
}
