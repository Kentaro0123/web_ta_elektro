<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalSidang extends Model
{
    protected $guarded=["id"];
    protected $table = 'jadwal_sidang';

    public function skripsi(){
        return $this->hasOne(Skripsi::class,'id','id_skripsi');
    }
    public function dosen_sidang(){
        return $this->hasMany(DosenSidang::class,'id_jadwal_sidang','id');
    }

}
