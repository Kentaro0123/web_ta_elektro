<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function index(){
        return view('features.admin.post_pengumuman',[
            "title"=>"Pengumuman"
        ]);
    }

    public function store(Request $request){
        $request->validate([

            'inputJudulPengumuman' => 'required',
            'inputCatatanPengumuman'=>'required',
               
        ]);
        $pengumuman= new Pengumuman();
        $pengumuman->judul=$request->input('inputJudulPengumuman');
        $pengumuman->catatan=$request->input('inputCatatanPengumuman');

       
        $pengumuman->save();

        return redirect('/post_pengumuman')->with('success','Registration Success');
    }
}
