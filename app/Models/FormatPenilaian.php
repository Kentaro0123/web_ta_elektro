<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormatPenilaian extends Model
{
    protected $table='format_penilaian';

    public function format_sub_penilaian(){
        return $this->hasMany(SubFormat::class,'format_penilaian_id','id');
    }
    use HasFactory;
}
