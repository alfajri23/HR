<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBobotMultiOkrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bobot_multi_okrs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user')->nullable();
            $table->integer('bulan')->nullable();
            $table->integer('id_sub')->nullable();
            $table->string('subdivisi')->nullable();
            $table->integer('bobot')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bobot_multi_okrs');
    }
}
