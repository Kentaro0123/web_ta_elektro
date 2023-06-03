<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenSidang extends Model
{
    protected $guarded=["id"];
    protected $table = 'dosen_sidang';

    public function jadwal_sidang(){
        return $this->hasOne(JadwalSidang::class,'id','id_jadwal_sidang');
    }
    public function user(){
        return $this->hasOne(User::class,'nip','id_dosen');
    }
    public function penilaian(){
        return $this->hasMany(Penilaian::class,'user_id','id_dosen');
    }
    
}
