<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skripsi extends Model
{
    protected $guarded=["id"];
    protected $table = 'skripsi';

    public function riwayat_mahasiswa(){ 
       return $this->hasOne(RiwayatMahasiswa::class,'id','id_riwayat_mahasiswa');
    }
    public function jadwal_sidang(){
        return $this->hasOne(JadwalSidang::class,'id_skripsi','id');
    }


  
}
