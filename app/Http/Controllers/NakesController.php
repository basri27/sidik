<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NakesController extends Controller
{
    public function nakes_dashboard()
    {
        return view('nakes.dashboard');
    }
}
