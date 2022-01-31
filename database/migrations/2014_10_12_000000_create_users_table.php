<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nik')->nullable();
            $table->string('pangkat')->nullable();
            $table->string('jabatan')->nullable();
            $table->integer('level')->nullable();
            $table->date('tgl_masuk_grup')->nullable();
            $table->date('tgl_masuk')->nullable();
            $table->string('tmpt_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->integer('usia')->nullable();
            $table->integer('status_kerja')->nullable();
            $table->date('habis_kontrak')->nullable();
            $table->date('reminder_habis_kontrak')->nullable();
            $table->integer('status_keluarga')->nullable();
            $table->enum('jenkel', ['l', 'p']);
            $table->string('pendidikan')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('sekolah')->nullable();
            $table->integer('npwp')->nullable();
            $table->integer('bpjs_tk')->nullable();
            $table->integer('bpjs_kes')->nullable();
            $table->string('email')->unique();
            $table->string('telepon')->nullable();
            $table->string('telepon_wa')->nullable();
            $table->string('alamat')->nullable();
            $table->string('alamat_ktp')->nullable();
            $table->string('rekening')->nullable();
            $table->integer('edukasi_pekanan')->nullable();
            $table->string('foto')->nullable();
            $table->integer('status')->default(1);
            $table->integer('cuti')->nullable();
            $table->integer('id_divisi');
            $table->string('username')->unique();
            $table->string('password');
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
