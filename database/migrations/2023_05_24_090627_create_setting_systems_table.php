<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_system', function (Blueprint $table) {
            $table->id();
            $table->boolean('pemilihan_topik_dosen')->nullable();
            $table->boolean('pemilihan_topik_mahasiswa')->nullable();
            $table->date('pemilihan_topik_dosen_tanggal')->nullable();
            $table->date('pemilihan_topik_mahasiswa_tanggal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_system');
    }
}
