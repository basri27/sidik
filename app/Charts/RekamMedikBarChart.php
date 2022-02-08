<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Pasien;

class RekamMedikBarChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public ?string $name = 'my_chart';

    public ?string $routeName = 'adm_dashboard';

    public function handler(Request $request): Chartisan
    {
        $pasien = Pasien::get();
        $kategori = Category::get();
        $labels = [];
        $count = [];
        foreach ($kategori as $k) {
            array_push($labels, $k->nama_kategori);
        }
        $values = Pasien::with('categories')->get();
        foreach ($values as $item) {
            array_push($count, $item->category->count());
        }
        return Chartisan::build()
            ->labels([$labels])
            ->dataset('Sample', $count);
    }
}