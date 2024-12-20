<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buku_tamus', function (Blueprint $table) {
            $table->bigIncrements('id_buku_tamu');
            $table->unsignedBigInteger('id_layanan')->nullable();
            $table->unsignedBigInteger('id_bidang')->nullable();
            $table->bigInteger('nip')->nullable();
            $table->string('nama_pegawai', 255)->nullable();
            $table->string('jabatan_pegawai',255)->nullable();
            $table->string('unit_kerja_pegawai',255)->nullable();
            $table->string('tujuan_informasi', 255)->nullable();

            $table->timestamp('createAdd')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updateAdd')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('userAdd')->nullable();


            $table->foreign('id_bidang')->references('id_bidang')->on('layanans')->onDelete('cascade');
            $table->foreign('id_layanan')->references('id_layanan')->on('layanans')->onDelete('cascade');
            $table->foreign('userAdd')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku_tamus');
    }
};
