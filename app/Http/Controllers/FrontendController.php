<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function properties()
    {
        return view("pages.properties");
    }
}
