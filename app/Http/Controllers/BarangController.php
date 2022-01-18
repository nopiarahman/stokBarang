<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang;
use App\Models\masukBarang;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index(){
        $barang = barang::latest()->get();
        // dd($barang);
        return view('barang.barangIndex',compact('barang'));
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
        $id->delete();
        return redirect()->route('barang')->with('sukses','Data Berhasil Dihapus');
    }
    /* barang Masuk */
    public function masuk(){
        $barangMasuk = masukBarang::latest()->get();
        return view('masuk.masukIndex',compact('barangMasuk'));        
    }
    public function cari(Request $request){
        if ($request->has('q')) {
            $cari = $request->q;
            $data = barang::select('id', 'nama')->where('nama', 'LIKE', '%'.$cari.'%')
                                               ->get();

            return response()->json($data);
        }
        
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
}
