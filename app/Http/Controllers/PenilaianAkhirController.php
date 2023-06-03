<?php

namespace App\Http\Controllers;

use App\Models\PenilaianAkhir;
use App\Http\Requests\StorePenilaianAkhirRequest;
use App\Http\Requests\UpdatePenilaianAkhirRequest;
use App\Models\Bobot;
use App\Models\FormatPenilaianAkhir;

use App\Models\Skripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $id)
    {


        $skripsi =  Skripsi::all()->find($id);
        $format_penilaian=FormatPenilaianAkhir::with('format_sub_penilaian_akhir')->get();
        return view('features.dosen.post_penilaian_dosen_akhir',[
            'title' => 'Penilaian Akhir',
            'skripsi'=>$skripsi,
            'format_penilaian' => $format_penilaian
        ]);

    }

    public function store_nilai_akhir(Request $request){

        // $format_penilaian
        // dd($request->all());

        foreach($request->id_nilai as $base => $key){
            foreach($request->id_sub_nilai[$base] as $base1 =>$key1){
                $penilaian= new PenilaianAkhir();
                $penilaian->user_id=Auth::user()->nip;
                $penilaian->skripsi_id=$request->id;
                $penilaian->format_penilaian_id=$key;
                $penilaian->format_sub_penilaian_id=$key1;
                $penilaian->point=$request->point[$base][$base1];
                $penilaian->sidang_proposal=1;
                $penilaian->save();
            }
        }
        return redirect('/get_jadwal_sidang_mahasiswa_dosen_akhir');
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
     * @param  \App\Http\Requests\StorePenilaianAkhirRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePenilaianAkhirRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PenilaianAkhir  $penilaianAkhir
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        $skripsi=Skripsi::whereHas('penilaian')->where('lulus_proposal','=',1)->get();
        $format_penilaian=FormatPenilaianAkhir::all();
        $bobot=Bobot::all()->first();
        return view('features.admin.get_penilaian_mahasiswa_akhir',[
            'title' => 'Nilai Mahasiswa Sidang Akhir',
            'skripsi' => $skripsi,
            'format_penilaian'=>$format_penilaian,
            'bobot'=>$bobot

            
        ]);
       
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PenilaianAkhir  $penilaianAkhir
     * @return \Illuminate\Http\Response
     */
    public function edit(PenilaianAkhir $penilaianAkhir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenilaianAkhirRequest  $request
     * @param  \App\Models\PenilaianAkhir  $penilaianAkhir
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenilaianAkhirRequest $request, PenilaianAkhir $penilaianAkhir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PenilaianAkhir  $penilaianAkhir
     * @return \Illuminate\Http\Response
     */
    public function destroy(PenilaianAkhir $penilaianAkhir)
    {
        //
    }
}
