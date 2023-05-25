<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topik extends Model
{
    protected $guarded=["id"];
    protected $table = 'topik';
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function riwayat_mahasiswa(){
        return $this->hasMany(RiwayatMahasiswa::class,'idTopik','id');
    }
    // public function jadwal_sidang(){
    //     return $this->hasOne(JadwalSidang::class,'id_skripsi','id');
    // }
}
