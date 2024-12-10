<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanans', function (Blueprint $table) {
            $table->bigIncrements('id_layanan');
            $table->string('nama_layanan', 255);
            $table->unsignedBigInteger('id_bidang');

            $table->timestamp('createAdd')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updateAdd')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('userAdd');

            $table->foreign('id_bidang')->references('id_bidang')->on('bidangs')->onDelete('cascade');

            $table->foreign('userAdd')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('layanans');
    }
};
