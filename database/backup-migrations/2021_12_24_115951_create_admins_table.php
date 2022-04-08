<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('nama_admin')->nullable();
            $table->string('jk_admin')->nullable();
            $table->string('tempat_lhr_admin')->nullable();
            $table->date('tgl_lhr_admin')->nullable();
            $table->string('no_hp_admin')->nullable();
            $table->string('alamat_admin')->nullable();
            $table->string('foto_admin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
