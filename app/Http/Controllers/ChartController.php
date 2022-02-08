<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekamMedik;
use App\Charts\RekamMedikBarChart;

class ChartController extends Controller
{
    public function chartBar()
    {
        $api = url('chart-bar');

        $chart = new RekamMedikBarChart;
        $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'])->load($api);

        return view('admin.dashboard', compact('chart'));
    }
}
