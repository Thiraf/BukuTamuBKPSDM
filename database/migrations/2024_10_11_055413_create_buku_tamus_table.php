<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Digunakan untuk default timestamp

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buku_tamus', function (Blueprint $table) {
            $table->bigIncrements('id_buku_tamu'); // Primary Key
            // $table->unsignedBigInteger('id_bidang'); // Foreign Key ke tabel Bidang
            $table->unsignedBigInteger('id_layanan')->nullable(); // Foreign Key ke tabel Layanan
            $table->unsignedBigInteger('id_bidang')->nullable(); // Foreign Key ke tabel Layanan
            $table->bigInteger('nik')->nullable(); // NIP, nullable
            $table->string('nama_pegawai', 255)->nullable(); // Nama pegawai, sesuai ERD (nullable)
            $table->string('jabatan_pegawai',255)->nullable();
            $table->string('unit_kerja_pegawai',255)->nullable();
            $table->string('tujuan_informasi', 255)->nullable(); // Tujuan informasi dari buku tamu (nullable)

            // Kolom createAdd, updateAdd, dan userAdd untuk audit log
            $table->timestamp('createAdd')->default(DB::raw('CURRENT_TIMESTAMP')); // Timestamp untuk data saat ditambahkan
            $table->timestamp('updateAdd')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')); // Timestamp untuk data saat di-update
            $table->unsignedBigInteger('userAdd')->nullable(); // ID pengguna yang menambah atau mengubah data (nullable)

            // Foreign Key ke tabel terkait
            $table->foreign('id_bidang')->references('id_bidang')->on('layanans')->onDelete('cascade');
            $table->foreign('id_layanan')->references('id_layanan')->on('layanans')->onDelete('cascade');
            $table->foreign('userAdd')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps(); // Laravel's automatic timestamps (created_at and updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_tamus');
    }
};
