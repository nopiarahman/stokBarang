<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\supplier;

class SupplierController extends Controller
{
    public function index(){
        $supplier = supplier::latest()->get();
        // dd($barang);
        return view('supplier.supplierIndex',compact('supplier'));
    }
    public function create(){
        return view('supplier.supplierTambah');
    }
    public function store(Request $request){
        $request->validate([
            'nama'   => 'required',
            'alamat'   => 'required',
        ]);
        $requestData = $request->all();
        supplier::create($requestData);
        return redirect()->route('supplier')->with('sukses','Data Berhasil Disimpan');
    }
    public function edit(supplier $id){
        return view('supplier.supplierEdit',compact('id'));        
    }
    public function update(Request $request, supplier $id){
        $request->validate([
            'nama'   => 'required',
        ]);
        $requestData = $request->all();
        $id->update($requestData);
        return redirect()->route('supplier')->with('sukses','Data Berhasil Dirubah');
    }
    public function destroy(supplier $id){
        $id->delete();
        return redirect()->route('supplier')->with('sukses','Data Berhasil Dihapus');
    }
    public function cari(Request $request){
        if ($request->has('q')) {
            $cari = $request->q;
            $data = supplier::select('id', 'nama')->where('nama', 'LIKE', '%'.$cari.'%')
                                               ->get();

            return response()->json($data);
        }
        
    }
}
