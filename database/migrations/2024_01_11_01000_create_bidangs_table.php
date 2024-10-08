<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bidangs', function (Blueprint $table) {
            $table->bigIncrements('id_bidang'); // Primary Key
            $table->string('nama_bidang', 255); // Nama bidang
            $table->boolean('is_active')->default(1); // Status aktif/tidak aktif (1 = aktif, 0 = tidak aktif)

            // Kolom createAdd, updateAdd, dan userAdd untuk audit log
            $table->timestamp('createAdd')->default(DB::raw('CURRENT_TIMESTAMP')); // Timestamp untuk data saat ditambahkan
            $table->timestamp('updateAdd')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')); // Timestamp untuk data saat di-update
            $table->unsignedBigInteger('userAdd'); // ID pengguna yang menambah atau mengubah data

            // Relasi ke tabel users (user yang menambah/ubah data)
            $table->foreign('userAdd')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps(); // Kolom created_at dan updated_at yang dihasilkan otomatis oleh Laravel
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidangs');
    }
};
