<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenkesehatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenkesehatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('kategori_tenkesehatan_id')->constrained();
            $table->string('nama_tenkes')->nullable();
            $table->string('jk_tenkes')->nullable();
            $table->string('tempat_lhr_tenkes')->nullable();
            $table->date('tgl_lhr_tenkes')->nullable();
            $table->string('nohp_tenkes')->nullable();
            $table->string('alamat_tenkes')->nullable();
            $table->string('foto_tenkes')->nullable();
            $table->string('status_tenkes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenkesehatans');
    }
}
