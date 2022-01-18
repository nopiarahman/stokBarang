<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class masukBarang extends Model
{
    use HasFactory;
    protected $table = "masuk_barang";
    protected $guarded = ['id','created_at','updated_at'];
    
    /**
     * Get the barang that owns the masukBarang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function barang()
    {
        return $this->belongsTo(barang::class);
    }
    /**
     * Get the supplier that owns the masukBarang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo(supplier::class);
    }
}
