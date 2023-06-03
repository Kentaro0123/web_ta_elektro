<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalSidangAkhir extends Model
{
    protected $table='jadwal_sidang_akhir';

    public function skripsi(){
        return $this->hasOne(Skripsi::class,'id','id_skripsi');
    }
    public function dosen_sidang_akhir(){
        return $this->hasMany(DosenSidangAkhir::class,'id_jadwal_sidang','id');
    }
    use HasFactory;
}
