<?php

namespace App\Http\Controllers;

use App\Model\Country;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', ['countries' => Country::all()]);
    }

}
