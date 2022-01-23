<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang;
use App\Models\penjualan;
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
        if ($request->hasFile('foto')) {
            $file_nama            = $request->file('foto')->store('public/barang/foto');
            $requestData['foto'] = $file_nama;
            
        } else {
            unset($requestData['foto']);
        }
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
    public function keluarHapus(penjualan $id){
        $stokBarang=barang::find($id->barang_id);
        $stokBarang->update(['jumlah'=>$stokBarang->jumlah+$id->jumlah]);
        $id->delete();
        return redirect()->back()->with('sukses','Barang Berhasil Dihapus');
    }
    /* barang keluar */
    public function keluar(Request $request){
        $baru = keluarBarang::firstOrCreate([
            'status'=>'open'
        ]);
        $barangKeluar = keluarBarang::orderBy('id','DESC')->first();
        $barangKeluar->update([
            'tanggal'=>Carbon::now()->isoFormat('YYYY-MM-DD'),
            'user_id'=>auth()->user()->id
        ]);
        // dd($barangKeluar);
        $penjualan = penjualan::where('keluar_barang_id',$barangKeluar->id)->get();
        return view('keluar.keluarIndex',compact('penjualan','barangKeluar'));        
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
            'jumlah'   => 'required',
        ]);
        $barang=barang::find($request->barang_id);
        $barangKeluar = keluarBarang::orderBy('id','DESC')->first();
        $requestData = $request->all();
        $requestData['total']=$barang->hargaJual*$request->jumlah;
        $requestData['keluar_barang_id']=$barangKeluar->id;
        if($request->jumlah > $barang->jumlah){
            return redirect()->route('keluar')->with('gagal','Transaksi Gagal, Stok Barang '.$barang->nama.' Tidak Mencukupi, Sisa Stok = '.$barang->jumlah.' buah');
        }
        try {
            DB::beginTransaction();
            penjualan::create($requestData);
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
    public function riwayat(Request $request){
        // dd($request);
        $start = Carbon::now()->firstOfMonth()->isoFormat('YYYY-MM-DD');
        $end = Carbon::now()->endOfMonth()->isoFormat('YYYY-MM-DD');
        if($request->get('filter')){
            $start = Carbon::parse($request->start)->isoFormat('YYYY-MM-DD');
            $end = Carbon::parse($request->end)->isoFormat('YYYY-MM-DD');
        }
        $barangKeluar = keluarBarang::whereBetween('tanggal',[$start,$end])->orderBy('id','DESC')->get();
        return view('keluar.riwayat',compact('barangKeluar','start','end'));
    }
    public function selesaiTransaksi(){
        $barangKeluar = keluarBarang::orderBy('id','DESC')->first();
        // dd($barangKeluar);
        try {
            DB::beginTransaction();
            $barangKeluar->update(['status'=>'closed']);
            DB::commit();
            // dd($barangKeluar->penjualan()->get());
            return view('keluar.struk',compact('barangKeluar'));
        } catch (\exception $ex) {
            DB::rollback();
            //throw $th;
            dd($ex);
        }
    }
}
