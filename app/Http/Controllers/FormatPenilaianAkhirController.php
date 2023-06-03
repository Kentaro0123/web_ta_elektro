<?php

namespace App\Http\Controllers;

use App\Models\FormatPenilaianAkhir;
use App\Http\Requests\StoreFormatPenilaianAkhirRequest;
use App\Http\Requests\UpdateFormatPenilaianAkhirRequest;


use App\Models\SubFormatAkhir;
use App\Models\Penilaian;
use App\Models\PenilaianAkhir;
use Illuminate\Http\Request;

class FormatPenilaianAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('features.admin.post_format_penilaian_akhir',[
            'title' => 'Format Penilaian Akhir'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFormatPenilaianAkhirRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_nilai'=> 'required',
            'bobot_nilai'=> 'required',
            'judul_sub_nilai'=> 'required'
        ]);
        // dd($request->all());
        FormatPenilaianAkhir::truncate();
        SubFormatAkhir::truncate();
        PenilaianAkhir::truncate();  
        $judul_nilai=$request->judul_nilai;
        $bobot_nilai=$request->bobot_nilai;
        $judul_sub_nilai=$request->judul_sub_nilai;
        foreach($judul_nilai as $key => $item){
            $formatPenilaian=new FormatPenilaianAkhir();
            $formatPenilaian->judul_nilai=$judul_nilai[$key];
            $formatPenilaian->bobot_nilai=$bobot_nilai[$key];
            $formatPenilaian->save();
            foreach($judul_sub_nilai[$key] as $key1 => $item1){
                $subFormat=new SubFormatAkhir();
                $subFormat->format_penilaian_id=$formatPenilaian->id;
                $subFormat->judul_sub_format=$item1;
                $subFormat->save();
           
            }

        }
        // dd('selesai');
        return redirect()->back()->with('success','Format Berhasil di Uploud');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormatPenilaianAkhir  $formatPenilaianAkhir
     * @return \Illuminate\Http\Response
     */
    public function show(FormatPenilaianAkhir $formatPenilaianAkhir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormatPenilaianAkhir  $formatPenilaianAkhir
     * @return \Illuminate\Http\Response
     */
    public function edit(FormatPenilaianAkhir $formatPenilaianAkhir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFormatPenilaianAkhirRequest  $request
     * @param  \App\Models\FormatPenilaianAkhir  $formatPenilaianAkhir
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormatPenilaianAkhirRequest $request, FormatPenilaianAkhir $formatPenilaianAkhir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormatPenilaianAkhir  $formatPenilaianAkhir
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormatPenilaianAkhir $formatPenilaianAkhir)
    {
        //
    }
}
