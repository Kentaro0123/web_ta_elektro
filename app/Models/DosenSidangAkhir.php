<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenSidangAkhir extends Model
{
    use HasFactory;

    protected $guarded=["id"];
    protected $table = 'dosen_sidang_akhir';

    public function jadwal_sidang_akhir(){
        return $this->hasOne(JadwalSidangAkhir::class,'id','id_jadwal_sidang');
    }
    public function user(){
        return $this->hasOne(User::class,'nip','id_dosen');
    }
    public function penilaian(){
        return $this->hasMany(PenilaianAkhir::class,'user_id','id_dosen');
    }
 
   
}
