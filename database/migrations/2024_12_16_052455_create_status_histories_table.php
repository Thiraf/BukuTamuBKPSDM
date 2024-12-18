<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('status_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('id_dashboard_admin'); // Foreign key
            $table->string('username_admin'); // Nama admin yang melakukan perubahan
            $table->string('old_status')->nullable(); // Status sebelum diubah
            $table->string('new_status'); // Status setelah diubah
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->useCurrent(); // Waktu perubahan
        });
    }

    public function down()
    {
        Schema::dropIfExists('status_histories');
    }
}
