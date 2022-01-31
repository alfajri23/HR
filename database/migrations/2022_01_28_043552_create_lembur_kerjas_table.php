<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLemburKerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lembur_kerjas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('alasan')->nullable();
            $table->integer('bulan');
            $table->date('hari');
            $table->integer('jam');
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
        Schema::dropIfExists('lembur_kerjas');
    }
}
