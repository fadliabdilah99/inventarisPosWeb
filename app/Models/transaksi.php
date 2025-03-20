<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $guarded = [];

    public function item() {
        return $this->hasMany(transaksi_item::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    
}
