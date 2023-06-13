<?php

namespace App\Http\Controllers;

use App\Models\setting_system;
use App\Http\Requests\Storesetting_systemRequest;
use App\Http\Requests\Updatesetting_systemRequest;
use App\Models\Bobot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class SettingSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      
        $tmp=setting_system::all()[0] ?? '';
     
        $bobot=Bobot::all()->first();
        return view('features.admin.setting_system',[
            'title' => 'setting system',
            'setting'=>$tmp,
            'bobot'=>$bobot
        ]);

        //
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
     * @param  \App\Http\Requests\Storesetting_systemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storesetting_systemRequest $request)
    {
        //
    }
    public function storeAndReplace(Request $request)
    {
        // $tmp= new setting_system();
        // // dd($request->all());
        // $tmp_1=$tmp::all()[0];

        // setting_system::truncate();
        
        // $tmp->pemilihan_topik_dosen=array_key_exists("pemberian_topik_dosen",$request->all()) ;
        // $tmp->pemilihan_topik_mahasiswa=array_key_exists("pemilihan_topik_mahasiswa",$request->all()) ;
        // $tmp->pemilihan_topik_dosen_tanggal=$tmp_1->pemilihan_topik_dosen_tanggal ;
        // $tmp->pemilihan_topik_mahasiswa=$tmp_1->pemilihan_topik_mahasiswa ;
        // $tmp->save();
        // return view('features.admin.setting_system',[
        //     'title' => 'setting system',
        //     'setting'=> $tmp,
            
        // ]);
    }
    public function bobot (Request $request){
        
        Bobot::truncate();
        $bobot = new Bobot();
        $bobot->pembimbing=$request->pembimbing;
        $bobot->penguji=$request->penguji;
        $bobot->save();
        return redirect('/setting_system');
    }
    public function storeAndReplace_tanggal(Request $request)
    {
        // dd($request->all());
        $tmp= new setting_system();
        setting_system::truncate();

        
        $tmp->pemilihan_topik_dosen_tanggal_mulai=$request->pemilihan_topik_dosen_tanggal_mulai ;
        $tmp->pemilihan_topik_mahasiswa_tanggal_mulai=$request->pemilihan_topik_mahasiswa_tanggal_mulai ;
        $tmp->pemilihan_topik_dosen_tanggal_selesai=$request->pemilihan_topik_dosen_tanggal_selesai ;
        $tmp->pemilihan_topik_mahasiswa_tanggal_selesai=$request->pemilihan_topik_mahasiswa_tanggal_selesai ;
       
      
        if($tmp->pemilihan_topik_dosen_tanggal_mulai > date('Y-m-d') || $tmp->pemilihan_topik_dosen_tanggal_selesai < date('Y-m-d')){
            $tmp->pemilihan_topik_dosen= 0 ;
        }
        else{
            $tmp->pemilihan_topik_dosen= 1 ;
        }
        if($tmp->pemilihan_topik_mahasiswa_tanggal_mulai > date('Y-m-d') || $tmp->pemilihan_topik_mahasiswa_tanggal_selesai < date('Y-m-d')){
            $tmp->pemilihan_topik_mahasiswa= 0 ;
            
        }
        else{
            $tmp->pemilihan_topik_mahasiswa= 1; 

        }
        // dd($tmp);
        $tmp->save();
        return view('features.admin.setting_system',[
            'title' => 'setting system',
            'setting'=> $tmp,

            
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\setting_system  $setting_system
     * @return \Illuminate\Http\Response
     */
    public function show(setting_system $setting_system)
    {
        //
    }
    public function update_navbar(setting_system $setting_system)
    {
        return response()->json([
            'ss' => $setting_system->all()
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\setting_system  $setting_system
     * @return \Illuminate\Http\Response
     */
    public function edit(setting_system $setting_system)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatesetting_systemRequest  $request
     * @param  \App\Models\setting_system  $setting_system
     * @return \Illuminate\Http\Response
     */
    public function update(Updatesetting_systemRequest $request, setting_system $setting_system)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\setting_system  $setting_system
     * @return \Illuminate\Http\Response
     */
    public function destroy(setting_system $setting_system)
    {
        //
    }
}
