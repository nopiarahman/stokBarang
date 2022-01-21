<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang;
use App\Models\masukBarang;
use App\Models\keluarBarang;
use Illuminate\Support\Facades\DB;
use Image;
use PDF;
use Carbon\Carbon;

class BarangController extends Controller
{
    public function index(){
        $barang = barang::latest()->get();
        return view('barang.barangIndex',compact('barang'));
    }
    public function stok(){
        $barang = barang::orderBy('nama')->get();
        return view('barang.stokIndex',compact('barang'));
    }
    public function create(){
        return view('barang.barangTambah');
    }
    public function store(Request $request){
        $request->validate([
            'nama'   => 'required',
        ]);
        $requestData = $request->all();
        if ($request->hasFile('foto')) {
            $file_nama            = $request->file('foto')->store('public/barang/foto');
            $requestData['foto'] = $file_nama;
            
        } else {
            unset($requestData['foto']);
        }
        barang::create($requestData);
        return redirect()->route('barang')->with('sukses','Data Berhasil Disimpan');
    }
    public function edit(barang $id){
        return view('barang.barangEdit',compact('id'));        
    }
    public function update(Request $request, barang $id){
        $request->validate([
            'nama'   => 'required',
        ]);
        $requestData = $request->all();
        $id->update($requestData);
        return redirect()->route('barang')->with('sukses','Data Berhasil Dirubah');
    }
    public function destroy(barang $id){
        if($id->masukBarang !=null || $id->keluarBarang!=null){
            return redirect()->route('barang')->with('sukses','Gagal Hapus Barang, Barang Memiliki Transaksi');
        }
        $id->delete();

        return redirect()->route('barang')->with('sukses','Data Berhasil Dihapus');
    }
    public function cari(Request $request){
        if ($request->has('q')) {
            $cari = $request->q;
            $data = barang::select('id', 'nama')->where('nama', 'LIKE', '%'.$cari.'%')
                                                ->get();
            return response()->json($data);
        }
    }
    /* barang Masuk */
    public function masuk(Request $request){
        $start = Carbon::now()->firstOfMonth()->isoFormat('YYYY-MM-DD');
        $end = Carbon::now()->endOfMonth()->isoFormat('YYYY-MM-DD');
        if($request->get('filter')){
            $start = Carbon::parse($request->start)->isoFormat('YYYY-MM-DD');
            $end = Carbon::parse($request->end)->isoFormat('YYYY-MM-DD');
        }
        $barangMasuk = masukBarang::whereBetween('tanggalMasuk',[$start,$end])->get();
        return view('masuk.masukIndex',compact('barangMasuk','start','end'));        
    }
    public function masukCetak(Request $request){
        $start = Carbon::now()->firstOfMonth()->isoFormat('YYYY-MM-DD');
        $end = Carbon::now()->endOfMonth()->isoFormat('YYYY-MM-DD');
        if($request->get('filter')){
            $start = Carbon::parse($request->start)->isoFormat('YYYY-MM-DD');
            $end = Carbon::parse($request->end)->isoFormat('YYYY-MM-DD');
        }
        $barangMasuk = masukBarang::whereBetween('tanggalMasuk',[$start,$end])->get();
        $pdf=PDF::loadview('masuk.masukCetak',compact('barangMasuk'))->setPaper('A4','portait');
        return $pdf->download('Riwayat Barang Masuk Van Trophy .pdf');

    }
    public function masukSimpan(Request $request){
        $request->validate([
            'barang_id'   => 'required',
            'supplier_id'   => 'required',
            'tanggalMasuk'   => 'required',
            'jumlah'   => 'required',
        ]);
        $requestData = $request->all();
        try {
            DB::beginTransaction();
            masukBarang::create($requestData);
            $barang=barang::find($request->barang_id);
            $barang->update(['jumlah'=>$barang->jumlah+$request->jumlah]);
            DB::commit();
            return redirect()->route('masuk')->with('sukses','Data Berhasil Disimpan');
        } catch (\exception $ex) {
            DB::rollback();
            dd($ex);
            return redirect()->back()->with('sukses','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    public function masukHapus(masukBarang $id){
        $stokBarang=barang::find($id->barang_id);
        $stokBarang->update(['jumlah'=>$stokBarang->jumlah-$id->jumlah]);
        $id->delete();
        return redirect()->back()->with('sukses','Transaksi Berhasil Dihapus');
    }
    public function keluarHapus(keluarBarang $id){
        $stokBarang=barang::find($id->barang_id);
        $stokBarang->update(['jumlah'=>$stokBarang->jumlah+$id->jumlah]);
        $id->delete();
        return redirect()->back()->with('sukses','Transaksi Berhasil Dihapus');
    }
    /* barang keluar */
    public function keluar(Request $request){
        $start = Carbon::now()->firstOfMonth()->isoFormat('YYYY-MM-DD');
        $end = Carbon::now()->endOfMonth()->isoFormat('YYYY-MM-DD');
        if($request->get('filter')){
            $start = Carbon::parse($request->start)->isoFormat('YYYY-MM-DD');
            $end = Carbon::parse($request->end)->isoFormat('YYYY-MM-DD');
        }
        $barangKeluar = keluarBarang::whereBetween('tanggal',[$start,$end])->get();
        return view('keluar.keluarIndex',compact('barangKeluar','start','end'));        
    }
    public function keluarCetak(Request $request){
        $start = Carbon::now()->firstOfMonth()->isoFormat('YYYY-MM-DD');
        $end = Carbon::now()->endOfMonth()->isoFormat('YYYY-MM-DD');
        if($request->get('filter')){
            $start = Carbon::parse($request->start)->isoFormat('YYYY-MM-DD');
            $end = Carbon::parse($request->end)->isoFormat('YYYY-MM-DD');
        }
        $barangKeluar = keluarBarang::whereBetween('tanggal',[$start,$end])->get();
        $pdf=PDF::loadview('keluar.keluarCetak',compact('barangKeluar'))->setPaper('A4','portait');
        return $pdf->download('Riwayat Barang Keluar Van Trophy .pdf');
    }
    public function keluarSimpan(Request $request){
        $request->validate([
            'barang_id'   => 'required',
            'tanggal'   => 'required',
            'pembeli'   => 'required',
            'jumlah'   => 'required',
        ]);
        $requestData = $request->all();
        try {
            DB::beginTransaction();
            keluarBarang::create($requestData);
            $barang=barang::find($request->barang_id);
            $barang->update(['jumlah'=>$barang->jumlah-$request->jumlah]);
            DB::commit();
            return redirect()->route('keluar')->with('sukses','Data Berhasil Disimpan');
        } catch (\exception $ex) {
            DB::rollback();
            dd($ex);
            return redirect()->back()->with('sukses','Gagal. Pesan Error: '.$ex->getMessage());
        }
    }
    public function cetak(){
        $barang = barang::latest()->get();
        // return view('barang.barangCetak',compact('barang'));
        $pdf=PDF::loadview('barang.barangCetak',compact('barang'))->setPaper('A4','portait');
        return $pdf->download('Daftar Stok Barang Van Trophy .pdf');
    }

}
