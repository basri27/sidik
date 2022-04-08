<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeluargaPasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluarga_pasiens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('pasien_id')->constrained();
            $table->string('nama_kel_pasien')->nullable();
            $table->string('jk_kel_pasien')->nullable();
            $table->string('kategori_kel_pasien');
            $table->string('tempat_lhr_kel_pasien')->nullable();
            $table->date('tgl_lhr_kel_pasien')->nullable();
            $table->string('no_hp_kel_pasien')->nullable();
            $table->string('alamat_kel_pasien')->nullable();
            $table->string('foto_kel_pasien')->nullable();
            $table->string('status_kel_pasien')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keluarga_pasiens');
    }
}
