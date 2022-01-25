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
            $table->string('nama_admin');
            $table->string('jk_admin');
            $table->string('tempat_lhr_admin');
            $table->date('tgl_lhr_admin');
            $table->string('no_hp_admin');
            $table->string('alamat_admin');
            $table->timestamp('admin_created_at')->useCurrent();
            $table->timestamp('admin_updated_at')->useCurrent();
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
