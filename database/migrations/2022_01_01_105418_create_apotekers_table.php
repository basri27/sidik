<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApotekersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apotekers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('nama_apoteker')->nullable();
            $table->string('jk_apoteker')->nullable();
            $table->string('tempat_lhr_apoteker')->nullable();
            $table->date('tgl_lhr_apoteker')->nullable();
            $table->string('nohp_apoteker')->nullable();
            $table->string('alamat_apoteker')->nullable();
            $table->string('foto_apoteker')->nullable();
            $table->string('status_apoteker')->nullable();
            $table->timestamp('apoteker_created_at')->useCurrent();
            $table->timestamp('apoteker_updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apotekers');
    }
}
