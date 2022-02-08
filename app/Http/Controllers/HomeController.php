<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenkesehatan;
use App\Models\Kategori_tenkesehatan;
use App\Models\Jadwal;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tenkes = Tenkesehatan::with('kategori_tenkesehatan')->get();
        // dd($tenkes);
        return view('home', compact('tenkes'));
    }

    public function show_jadwal()
    {
        $jadwals = Jadwal::get();
        
        return view('jadwal', compact('jadwals'));
    }
}
