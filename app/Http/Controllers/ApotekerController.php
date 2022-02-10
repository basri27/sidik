<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\RekamMedik;
use App\Models\ResepObat;
use Carbon\Carbon;

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
        $pasiens = RekamMedik::
            whereNotNull('diagnosa_id')
            ->get()
        ;
        foreach($pasiens as $p) {
            $resep = ResepObat::where('rekam_medik_id', $p->id)
            ->whereDate('resepobat_created_at', Carbon::now()->toDateString())
            ->get();
        }
        // dd($resep);
        $pasienCount = $pasiens->count();

        return view('apoteker.dashboard', compact('notifications', 'notifCount', 'pasiens', 'pasienCount', 'resep'));
    }

    public function apotekerObatPasien($id)
    {
        $rekammedik = RekamMedik::find($id);

        return view('apoteker.obat_pasien', compact('rekammedik'));
    }
}
