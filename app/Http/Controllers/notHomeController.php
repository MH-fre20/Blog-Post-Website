<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class notHomeController extends Controller
{
    public function home() {
        return view('nothome.index');
    }

    public function contact() 
    {
        return view('nothome.contact');

    }
}
