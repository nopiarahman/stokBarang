<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    protected $table = "barang";
    protected $guarded = ['id','created_at','updated_at'];

    /**
     * Get the masukBarang associated with the barang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function masukBarang()
    {
        return $this->hasOne(masukBarang::class);
    }
    public function keluarBarang()
    {
        return $this->hasOne(masukBarang::class);
    }
}
