<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekamMediksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    protected $fillable = [
        'user_id',
        'tenkesehatan_id',
        'diagnosa',

    ];

    public function up()
    {
        Schema::create('rekam_mediks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->nullable()->constrained();
            $table->foreignId('keluarga_pasien_id')->nullable()->constrained();
            $table->foreignId('tenkesehatan_id')->nullable()->constrained();
            $table->foreignId('diagnosa_id')->nullable()->constrained();
            $table->string('suhu')->nullable();
            $table->string('siastol')->nullable();
            $table->string('diastol')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('keluhan')->nullable();
            $table->string('status_rekam_medik')->nullable();
            $table->timestamp('rekammedik_created_at')->useCurrent();
            $table->timestamp('rekammedik_updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekam_mediks');
    }
}
