<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResepObatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resep_obats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obat_id')->constrained();
            $table->foreignId('rekam_medik_id')->constrained();
            $table->string('keterangan');
            $table->timestamp('resepobat_created_at');
            $table->timestamp('resepobat_updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resep_obats');
    }
}
