<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecordAbsensi extends Model
{
    protected $guarded = [];

    public function karyawan()
    {
        return $this->belongsTo(karyawan::class);
    }
}
