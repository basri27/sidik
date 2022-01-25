<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTenkesehatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    protected $fillable = [
        'jadwal_id',
        'tenkesehatan_id',
    ];
    
    public function up()
    {
        Schema::create('jadwal_tenkesehatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_id')->constrained();
            $table->foreignId('tenkesehatan_id')->nullable()->constrained();
            $table->timestamp('jadwal_tenkes_created_at')->useCurrent();
            $table->timestamp('jadwal_tenkes_updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_tenkesehatan');
    }
}
