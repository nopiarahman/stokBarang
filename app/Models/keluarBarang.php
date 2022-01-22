<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keluarBarang extends Model
{
    use HasFactory;
    protected $table = "keluar_barang";
    protected $guarded = ['id','created_at','updated_at'];

    /**
     * Get the barang that owns the keluarBarang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function barang()
    {
        return $this->belongsTo(barang::class);
    }
    /**
     * Get the penjualan associated with the keluarBarang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function penjualan()
    {
        return $this->hasOne(penjualan::class);
    }
}
