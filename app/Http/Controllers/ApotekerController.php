<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\RekamMedik;

class ApotekerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function apotekerDashboard($id)
    {
        $notifications = Notification::where('user_id', $id)->orderBy('id', 'DESC')->get();
        $notifCount = Notification::where('user_id', $id)->count();

        return view('apoteker.dashboard', compact('notifications', 'notifCount'));
    }

    public function apotekerObatPasien($id)
    {
        $rekammedik = RekamMedik::find($id);

        return view('apoteker.obat_pasien', compact('rekammedik'));
    }
}
