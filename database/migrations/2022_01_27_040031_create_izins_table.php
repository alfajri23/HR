<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIzinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('izins', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('hari');
            $table->string('tipe');
            $table->string('alasan');
            $table->string('bukti')->nullable();
            $table->integer('bulan');
            $table->enum('setengah_hari', [1,0]);
            $table->enum('ganti_jam', [1,0]);
            $table->enum('dinas', [1,0]);
            $table->integer('jam')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir')->nullable();
            $table->integer('status')->default(0); 
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
        Schema::dropIfExists('izins');
    }
}
