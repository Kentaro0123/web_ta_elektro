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
    public function jadwal_sidang_akhir(){
        return $this->hasOne(JadwalSidangAkhir::class,'id_skripsi','id');
    }
    public function dosen_pembimbing_tambahan(){
        return $this->hasMany(DosenPembimbingTambahan::class,'id_skripsi','id');
    }
    public function penilaian(){
        return $this->hasMany(Penilaian::class,'skripsi_id','id');
    }

   
    // public function dosen_sidang(){
    //     return $this->hasMany(DosenSidang::class,'id_dosen','id');
    // }
    


  
}
