<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $incrementing = false;
    protected $primaryKey = 'nip';
    protected $keyType = 'string';
   protected $guarded=[];
   public function mahasiswa(){
    return $this->hasOne(Mahasiswa::class);
   }
   public function topik(){
    return $this->hasMany(Topik::class,'user_nip','nip');
   }
   public function riwayat_mahasiswa(){
    return $this->hasMany(RiwayatMahasiswa::class,'nip','nip');
   }

   
}
