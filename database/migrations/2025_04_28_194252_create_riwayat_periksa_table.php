<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPeriksaTable extends Migration
{
    public function up()
    {
        Schema::create('riwayat_periksa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasien_id');
            $table->unsignedBigInteger('dokter_id')->nullable();
            $table->date('tanggal');
            $table->text('keluhan');
            $table->text('diagnosa');
            $table->timestamps();

            // Foreign key (kalau kamu punya tabel pasien dan dokter)
            $table->foreign('pasien_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dokter_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('riwayat_periksa');
    }
}