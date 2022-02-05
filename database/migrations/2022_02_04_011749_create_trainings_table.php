<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('partisipan');
            $table->string('tutor');
            $table->string('kompetensi');
            $table->integer('biaya')->nullable();
            $table->integer('durasi')->nullable();
            $table->integer('waktu')->nullable();
            $table->integer('tipe'); // 1 = intern , 2 = extern
            $table->integer('status'); // 0 = pending , 1 = setuju , 2 = tolak
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
        Schema::dropIfExists('trainings');
    }
}
