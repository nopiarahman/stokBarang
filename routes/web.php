<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');

})->name('dashboard');
Route::group(['middleware'=>['auth','role:admin,karyawan']],function(){
    Route::get('/barang',[ BarangController::class,'index'])->name('barang');
    Route::get('/stok',[ BarangController::class,'stok'])->name('stok');
    Route::get('/barang/tambah',[ BarangController::class,'create'])->name('barangTambah');
    Route::get('/barang/{id}',[ BarangController::class,'edit'])->name('barangEdit');
    Route::get('/cariBarang',[ BarangController::class,'cari'])->name('cariBarang');
    Route::post('/barang',[ BarangController::class,'store'])->name('barangSimpan');
    Route::get('/barangCetak',[ BarangController::class,'cetak'])->name('barangCetak');
    Route::delete('/barang/{id}',[ BarangController::class,'destroy'])->name('barangHapus');
    Route::patch('/barang/{id}',[ BarangController::class,'update'])->name('barangUpdate');
    
    Route::get('/supplier',[ SupplierController::class,'index'])->name('supplier');
    Route::get('/supplier/tambah',[ SupplierController::class,'create'])->name('supplierTambah');
    Route::get('/supplier/{id}',[ SupplierController::class,'edit'])->name('supplierEdit');
    Route::post('/supplier',[ SupplierController::class,'store'])->name('supplierSimpan');
    Route::patch('/supplier/{id}',[ SupplierController::class,'update'])->name('supplierUpdate');
    Route::delete('/supplier/{id}',[ SupplierController::class,'destroy'])->name('supplierHapus');
    Route::get('/cariSupplier',[ SupplierController::class,'cari'])->name('cariSupplier');
    
    Route::get('/masuk',[ BarangController::class,'masuk'])->name('masuk');
    Route::get('/masukCetak',[ BarangController::class,'masukCetak'])->name('masukCetak');
    Route::post('/masuk',[ BarangController::class,'masukSimpan'])->name('barangMasukSimpan');
    Route::delete('/masukHapus/{id}',[ BarangController::class,'masukHapus'])->name('barangMasukHapus');
    Route::get('/keluar',[ BarangController::class,'keluar'])->name('keluar');
    Route::get('/keluarCetak',[ BarangController::class,'keluarCetak'])->name('keluarCetak');
    Route::post('/keluar',[ BarangController::class,'keluarSimpan'])->name('barangKeluarSimpan');
    Route::delete('/keluarHapus/{id}',[ BarangController::class,'keluarHapus'])->name('barangKeluarHapus');
    
    Route::get('/user',[ UserController::class,'index'])->name('userIndex');
    Route::get('/user/tambah',[ UserController::class,'create'])->name('userTambah');
    Route::patch('/user/{id}',[ UserController::class,'update'])->name('userUpdate');
    Route::get('/user/{id}',[ UserController::class,'edit'])->name('userEdit');
    Route::post('/user',[ UserController::class,'store'])->name('userSimpan');
    Route::delete('/userHapus/{id}',[ UserController::class,'destroy'])->name('userHapus');

});