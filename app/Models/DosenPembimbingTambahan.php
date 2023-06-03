<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenPembimbingTambahan extends Model
{
    protected $guarded=["id"];
    protected $table = 'dosen_pembimbing_tambahan';

    public function user(){
        return $this->belongsTo(User::class,'user_nip','nip');
    }
    public function skripsi(){
        return $this->belongsTo(Skripsi::class,'id_skripsi','id');
    }
    public function penilaian(){
        return $this->hasMany(Penilaian::class,'user_nip','user_id');
    }
}
