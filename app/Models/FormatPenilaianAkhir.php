<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormatPenilaianAkhir extends Model
{
    protected $table='format_penilaian_akhir';
    public function format_sub_penilaian_akhir(){
        return $this->hasMany(SubFormatAkhir::class,'format_penilaian_id','id');
    }
    use HasFactory;
}
