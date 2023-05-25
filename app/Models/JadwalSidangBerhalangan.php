<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalSidangBerhalangan extends Model
{
    use HasFactory;
    protected $guarded=["id"];
    protected $table = 'jadwal_sidang_berhalangan';

    public function user(){
        return $this->belongsTo(User::class,'nip','user_nip');

    }

}
