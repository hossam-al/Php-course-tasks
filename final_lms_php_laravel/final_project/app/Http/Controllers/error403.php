<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class error403 extends Controller
{
    public function error403()
    {

        return view('error403');
    }
}
