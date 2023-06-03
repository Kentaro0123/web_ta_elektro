<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Http\Requests\StorePenilaianRequest;
use App\Http\Requests\UpdatePenilaianRequest;
use App\Models\Bobot;
use App\Models\FormatPenilaian;
use App\Models\Skripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $id)
    {


        $skripsi =  Skripsi::all()->find($id);
        $format_penilaian=FormatPenilaian::with('format_sub_penilaian')->get();
        return view('features.dosen.post_penilaian_dosen',[
            'title' => 'Penilaian',
            'skripsi'=>$skripsi,
            'format_penilaian' => $format_penilaian
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
     * @param  \App\Http\Requests\StorePenilaianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }
    public function store_nilai_proposal(Request $request){

        // $format_penilaian
        // dd($request->all());

        foreach($request->id_nilai as $base => $key){
            foreach($request->id_sub_nilai[$base] as $base1 =>$key1){
                $penilaian= new Penilaian();
                $penilaian->user_id=Auth::user()->nip;
                $penilaian->skripsi_id=$request->id;
                $penilaian->format_penilaian_id=$key;
                $penilaian->format_sub_penilaian_id=$key1;
                $penilaian->point=$request->point[$base][$base1];
                $penilaian->sidang_proposal=1;
                $penilaian->save();
            }
        }
        return redirect('/get_jadwal_sidang_mahasiswa_dosen');
    }
  
    public function show()
    {

        $skripsi=Skripsi::whereHas('penilaian')->get();
        $format_penilaian=FormatPenilaian::all();
        $bobot=Bobot::all()->first();
        // dd($skripsi);
        return view('features.admin.get_penilaian_mahasiswa',[
            'title' => 'Nilai Mahasiswa Proposal',
            'skripsi' => $skripsi,
            'format_penilaian'=>$format_penilaian,
            'bobot'=>$bobot   
            
        ]);
       
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function edit(Penilaian $penilaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenilaianRequest  $request
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenilaianRequest $request, Penilaian $penilaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penilaian $penilaian)
    {
        //
    }
}
