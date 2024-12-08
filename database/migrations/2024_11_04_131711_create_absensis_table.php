<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');
            $table->date('tanggal');
            $table->time('waktu_masuk');
            $table->time('waktu_keluar')->nullable();
            $table->timestamps();

            $table->foreign('pegawai_id')->references('id')->on('pegawais')->onDelete('cascade');
        });
    }
};
?>