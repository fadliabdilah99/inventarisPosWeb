<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaksi_item extends Model
{
    protected $guarded = [];

    public function produk() {
        return $this->belongsTo(produk::class);
    }

    public function transaksi() {
        return $this->belongsTo(transaksi::class);
    }
}
