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
        $label = barang::select('nama')->get()->toArray();
        $dataset = barang::select('jumlah')->get()->toArray();
        $nama = array_column($label,'nama');
        $data = array_column($dataset,'jumlah');
        // dd($nama);
        return Chartisan::build()
            ->labels($nama)
            ->dataset('Stok', $data);
    }
}