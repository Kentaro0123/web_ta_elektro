<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->string('idTopik');
            $table->string('judul_topik');
            $table->boolean('acc_topik')->default(false);
            $table->boolean('acc_judul')->default(false);
            $table->string('file_path');
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
        Schema::dropIfExists('riwayat_mahasiswas');
    }
}
