<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NakesController extends Controller
{
    public function nakes_dashboard($id)
    {
        $notifs = Notification::where('tenkesehatan_id', $id)->get();
        $notifCount = Notification::where('tenkesehatan_id', $id)->count();

        return view('nakes.dashboard', compact('notifs', 'notifCount'));
    }
}
