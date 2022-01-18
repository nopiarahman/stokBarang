<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
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
Route::group(['middleware'=>['auth','role:admin']],function(){
    Route::get('/barang',[ BarangController::class,'index'])->name('barang');
    Route::get('/barang/tambah',[ BarangController::class,'create']);
    Route::get('/barang/{id}',[ BarangController::class,'edit'])->name('barangEdit');
    Route::get('/cariBarang',[ BarangController::class,'cari'])->name('cariBarang');
    Route::post('/barang',[ BarangController::class,'store'])->name('barangSimpan');
    Route::delete('/barang/{id}',[ BarangController::class,'destroy'])->name('barangHapus');
    Route::patch('/barang/{id}',[ BarangController::class,'update'])->name('barangUpdate');
    
    Route::get('/supplier',[ SupplierController::class,'index'])->name('supplier');
    Route::get('/supplier/{id}',[ SupplierController::class,'edit'])->name('supplierEdit');
    Route::get('/supplier/tambah',[ SupplierController::class,'create']);
    Route::post('/supplier',[ SupplierController::class,'store'])->name('supplierSimpan');
    Route::patch('/supplier/{id}',[ SupplierController::class,'update'])->name('supplierUpdate');
    Route::delete('/supplier/{id}',[ SupplierController::class,'destroy'])->name('supplierHapus');
    Route::get('/cariSupplier',[ SupplierController::class,'cari'])->name('cariSupplier');
    
    Route::get('/masuk',[ BarangController::class,'masuk'])->name('masuk');
    Route::post('/masuk',[ BarangController::class,'masukSimpan'])->name('barangMasukSimpan');
});