<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id_role'); // Primary Key
            $table->string('nama_role', 255); // Nama peran (role)

            // Kolom createAdd, updateAdd, dan userAdd untuk audit log
            $table->timestamp('createAdd')->default(DB::raw('CURRENT_TIMESTAMP')); // Timestamp untuk data saat ditambahkan
            $table->timestamp('updateAdd')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')); // Timestamp untuk data saat di-update
            $table->unsigneDBigInteger('userAdd'); // ID pengguna yang menambah atau mengubah data

            // Foreign key ke tabel users (user yang menambah/ubah data)
            $table->foreign('userAdd')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps(); // Laravel's automatic timestamps (created_at dan updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
