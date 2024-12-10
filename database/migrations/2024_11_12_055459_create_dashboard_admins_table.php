<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('dashboard_admins')) {
        Schema::create('dashboard_admins', function (Blueprint $table) {
            $table->bigIncrements('id_dashboard_admin');
            $table->unsignedBigInteger('id_buku_tamu');
            $table->unsignedBigInteger('id_admin');
            $table->bigInteger('nip')->nullable();
            $table->string('nama_pegawai', 255)->nullable();
            $table->string('jabatan_pegawai',255)->nullable();
            $table->string('unit_kerja_pegawai',255)->nullable();
            $table->string('tujuan_informasi', 255)->nullable();
            $table->unsignedBigInteger('id_bidang');
            $table->unsignedBigInteger('id_layanan');
            $table->unsignedBigInteger('id_status');



            $table->timestamp('createAdd')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updateAdd')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('userAdd');

            $table->foreign('id_buku_tamu')->references('id_buku_tamu')->on('buku_tamus')->onDelete('cascade');
            $table->foreign('id_admin')->references('id_admin')->on('admins')->onDelete('cascade');
            $table->foreign('id_status')->references('id_status')->on('statuses')->onDelete('cascade');
            $table->foreign('id_layanan')->references('id_layanan')->on('layanans')->onDelete('cascade');
            $table->foreign('id_bidang')->references('id_bidang')->on('layanans')->onDelete('cascade');
            $table->foreign('userAdd')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('dashboard_admins');
    }
};
