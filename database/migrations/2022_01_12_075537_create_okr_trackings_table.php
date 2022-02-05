<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOkrTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('okr_trackings', function (Blueprint $table) {
            $table->id();
            // $table->string('username')->nullable();
            $table->integer('bulan');
            $table->string('multi')->nullable();
            $table->integer('id_user')->nullable();
            $table->string('kode_key');
            $table->integer('target');
            $table->integer('bobot');
            $table->integer('start')->default(0);
            $table->string('week_1')->nullable();
            $table->float('total')->nullable();
            $table->float('progres')->nullable();
            $table->string('status')->nullable();
            $table->string('evaluasi')->nullable();
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
        Schema::dropIfExists('okr_trackings');
    }
}
