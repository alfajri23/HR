<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeyResultUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('key_result_users', function (Blueprint $table) {
            $table->id();
            // $table->string('username')->nullable();
            $table->integer('tahun')->nullable();
            $table->integer('id_user')->nullable();;
            $table->string('kode_key');
            $table->string('target_1')->nullable();
            $table->integer('bobot');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('key_result_users');
    }
}
