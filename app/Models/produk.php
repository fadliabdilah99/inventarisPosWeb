<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(kategori::class);
    }

    public function barang_masuk()
    {
        return $this->hasMany(barang_masuk::class);
    }
}
