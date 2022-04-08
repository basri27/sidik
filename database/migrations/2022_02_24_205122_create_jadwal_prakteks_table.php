<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalPrakteksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_prakteks', function (Blueprint $table) {
            // $table->id();
            // $table->string('hari');
            // $table->string('pagi');
            // $table->string('siang');
            // $table->unsignedBigInteger('nakes_1');
            // $table->foreign('nakes_1')->references('id')->on('tenkesehatans');
            // $table->unsignedBigInteger('nakes_2');
            // $table->foreign('nakes_2')->references('id')->on('tenkesehatans');
            $table->id();
            $table->string('hari_jadwal');
            $table->string('waktu1');
            $table->unsignedBigInteger('tenkes1');
            $table->foreign('tenkes1')->references('id')->on('tenkesehatans');
            $table->string('waktu2');
            $table->unsignedBigInteger('tenkes2');
            $table->foreign('tenkes2')->references('id')->on('tenkesehatans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_prakteks');
    }
}
