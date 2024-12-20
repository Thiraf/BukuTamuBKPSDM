<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('status_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('id_dashboard_admin');
            $table->string('username_admin');
            $table->string('old_status')->nullable();
            $table->string('new_status');
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('status_histories');
    }
}
