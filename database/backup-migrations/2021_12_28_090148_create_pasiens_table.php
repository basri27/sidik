<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('fakulta_id')->constrained();
            $table->foreignId('prodi_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->string('nama_pasien')->nullable();
            $table->string('jk_pasien')->nullable();
            $table->string('tempat_lhr_pasien')->nullable();
            $table->date('tgl_lhr_pasien')->nullable();
            $table->string('no_hp_pasien')->nullable();
            $table->string('alamat_pasien')->nullable();
            $table->string('foto_pasien')->nullable();
            $table->string('status_pasien')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasiens');
    }
}
