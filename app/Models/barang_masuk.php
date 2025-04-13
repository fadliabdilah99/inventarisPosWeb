<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class barang_masuk extends Model
{
    protected $table = 'barang_masuks';
    protected $guarded = [];

    public function produk()
    {
        return $this->belongsTo(produk::class);
    }
}
