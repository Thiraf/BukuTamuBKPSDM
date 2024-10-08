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
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id_admin'); // Primary Key
            $table->string('nama_admin', 255); // Nama Admin
            $table->unsignedBigInteger('id_role'); // Foreign Key ke tabel Role
            $table->string('username_admin', 100)->unique(); // Username admin
            $table->string('password_admin'); // Password admin

            // Kolom createAdd, updateAdd, dan userAdd untuk audit log
            $table->timestamp('createAdd')->default(DB::raw('CURRENT_TIMESTAMP')); // Timestamp untuk data saat ditambahkan
            $table->timestamp('updateAdd')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')); // Timestamp untuk data saat di-update
            $table->unsignedBigInteger('userAdd'); // ID pengguna yang menambah atau mengubah data

            // Foreign key ke tabel role
            $table->foreign('id_role')->references('id_role')->on('roles')->onDelete('cascade');

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
        Schema::dropIfExists('admins');
    }
};
