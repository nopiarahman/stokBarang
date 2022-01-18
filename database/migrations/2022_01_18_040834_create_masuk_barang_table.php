<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\barang;
use App\Models\supplier;
class CreateMasukBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masuk_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(barang::class);
            $table->foreignIdFor(supplier::class);
            $table->dateTime('tanggalMasuk');
            $table->bigInteger('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('masuk_barang');
    }
}
