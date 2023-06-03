<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    protected $table='penilaian';

    public function user(){
        return $this->belongsTo(user::class,'user_id','nip');
    }
    public function format_penilaian(){
        return $this->belongsTo(FormatPenilaian::class ,'format_penilaian_id');
    }
    public function format_sub_penilaian(){
        return $this->belongsTo(SubFormat::class,'format_sub_penilaian_id');
    }
 
    public function skripsi(){
        return $this->belongsTo(Skripsi::class,'id_skripsi');
    }
}
