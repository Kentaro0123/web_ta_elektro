<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RiwayatMahasiswa extends Model
{

    use HasFactory;
    protected $table='riwayat_mahasiswa';

    public function user(){
        return $this->belongsTo(user::class,'nip','nip');
       }
    public function topik(){
        return $this->belongsTo(topik::class,'idTopik','id'); 
       }
    public function skripsi(){
        return $this->hasOne(skripsi::class,'id_riwayat_mahasiswa','id');
    }
    // public function jadwal_sidang(){
    //     return $this->hasOne(JadwalSidang::class,'id_skripsi','id');
    // }
    
}
