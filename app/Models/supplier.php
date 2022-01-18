<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;
    protected $table = "supplier";
    protected $guarded = ['id','created_at','updated_at'];

    /**
     * Get the barang that owns the supplier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function masukBarang()
    {
        return $this->hasOne(masukBarang::class);
    }
}
