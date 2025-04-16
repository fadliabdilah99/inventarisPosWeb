<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('record_absensis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('karyawan_id');
            $table->enum('status', ['sakit', 'masuk', 'cuti']);
            $table->time('waktu_masuk');
            $table->time('waktu_keluar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('record_absensis');
    }
};
