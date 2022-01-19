<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Barang;
class ChartBarang extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $label = barang::select('nama')->get()->implode('nama', ', ');
        $dataset = barang::select('jumlah')->get()->implode('jumlah', ', ');
        // dd($dataset);
        return Chartisan::build()
            ->labels([$label])
            ->dataset('Stok', [$dataset]);
    }
}