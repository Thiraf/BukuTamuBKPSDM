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
        Schema::create('layanans', function (Blueprint $table) {
            $table->bigIncrements('id_layanan'); // Primary Key
            $table->string('nama_layanan', 255); // Nama layanan
            $table->unsignedBigInteger('id_bidang'); // Foreign key untuk bidang terkait

            // Kolom createAdd, updateAdd, dan userAdd untuk audit log
            $table->timestamp('createAdd')->default(DB::raw('CURRENT_TIMESTAMP')); // Timestamp untuk data saat ditambahkan
            $table->timestamp('updateAdd')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')); // Timestamp untuk data saat di-update
            $table->unsignedBigInteger('userAdd'); // ID pengguna yang menambah atau mengubah data

            // Foreign key ke tabel bidang
            $table->foreign('id_bidang')->references('id_bidang')->on('bidangs')->onDelete('cascade');

            // Foreign key ke tabel users (user yang menambah/ubah data)
            $table->foreign('userAdd')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps(); // Laravel's automatic timestamps (created_at and updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanans');
    }
};
