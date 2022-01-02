<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenkes1_id')->references('id')->on('tenkesehatans');
            $table->foreignId('tenkes2_id')->references('id')->on('tenkesehatans');
            $table->string('hari')->nullable();
            $table->time('pagi_s')->nullable();
            $table->time('pagi_n')->nullable();
            $table->time('siang_s')->nullable();
            $table->time('siang_n')->nullable();
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
        Schema::dropIfExists('jadwals');
    }
}
