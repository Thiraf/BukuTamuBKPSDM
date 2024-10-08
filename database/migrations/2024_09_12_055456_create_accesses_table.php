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
        Schema::create('accesses', function (Blueprint $table) {
            $table->bigIncrements('id_access'); // Primary Key
            $table->unsignedBigInteger('id_role'); // Foreign key untuk role terkait
            $table->unsignedBigInteger('id_menu'); // Foreign key untuk menu terkait
            $table->boolean('can_view')->default(false); // Akses untuk melihat
            $table->boolean('can_create')->default(false); // Akses untuk membuat
            $table->boolean('can_update')->default(false); // Akses untuk memperbarui
            $table->boolean('can_delete')->default(false); // Akses untuk menghapus

            // Kolom createAdd, updateAdd, dan userAdd untuk audit log
            $table->timestamp('createAdd')->default(DB::raw('CURRENT_TIMESTAMP')); // Timestamp untuk data saat ditambahkan
            $table->timestamp('updateAdd')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')); // Timestamp untuk data saat di-update
            $table->unsignedBigInteger('userAdd'); // ID pengguna yang menambah atau mengubah data

            // Foreign key ke tabel roles
            $table->foreign('id_role')->references('id_role')->on('roles')->onDelete('cascade');

            // Foreign key ke tabel menus
            $table->foreign('id_menu')->references('id_menu')->on('menus')->onDelete('cascade');

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
        Schema::dropIfExists('accesses');
    }
};
