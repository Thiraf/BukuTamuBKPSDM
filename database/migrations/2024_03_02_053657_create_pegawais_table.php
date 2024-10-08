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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->bigIncrements('id_pegawai'); // Primary Key
            $table->string('nik', 20)->unique(); // Nomor induk pegawai, harus unik
            $table->string('nama', 255); // Nama pegawai
            $table->unsignedBigInteger('id_bidang'); // Foreign Key ke tabel bidangs
            $table->unsignedBigInteger('id_layanan'); // Foreign Key ke tabel layanans
            $table->string('nomor_hp', 15); // Nomor telepon pegawai
            $table->string('tempat_tanggal_lahir')->default('1970-01-01'); // Tanggal lahir pegawai
            $table->unsignedBigInteger('userAdd')->default(0); // ID pengguna yang menambah atau mengubah data

            // Kolom timestamps (created_at, updated_at)
            $table->timestamps();

            // Definisikan foreign key ke tabel bidangs dan layanans
            $table->foreign('id_bidang')->references('id_bidang')->on('bidangs')->onDelete('cascade');
            $table->foreign('id_layanan')->references('id_layanan')->on('layanans')->onDelete('cascade');
            $table->foreign('userAdd')->references('id')->on('users')->onDelete('cascade'); // Foreign key ke tabel users
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
