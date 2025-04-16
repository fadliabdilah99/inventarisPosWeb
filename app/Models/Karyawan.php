<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $guarded = [];

    public function absensi(){
        return $this->hasMany(RecordAbsensi::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
