<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalSidangAkhirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_sidang_akhir', function (Blueprint $table) {
            $table->id();
            $table->string('id_skripsi');
            $table->date('hari_pelaksanaan');
            $table->time('jam_pelaksanaan');
            $table->time('jam_selesai');
            $table->string('tempat_sidang')->nullable();

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
        Schema::dropIfExists('jadwal_sidang_akhir');
    }
}
