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
            $table->foreignId('kategori_tenkes_id')->references('id')->on('kategori_tenkesehatan');
            $table->string('nama')->nullable();
            $table->string('jk')->nullable();
            $table->string('tempat_lhr')->nullable();
            $table->date('tgl_lhr')->nullable();
            $table->string('nohp')->nullable();
            $table->string('alamat')->nullable();
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
        Schema::dropIfExists('tenkesehatans');
    }
}
