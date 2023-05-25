<?php

namespace App\Http\Controllers;

use App\Models\setting_system;
use App\Http\Requests\Storesetting_systemRequest;
use App\Http\Requests\Updatesetting_systemRequest;
use Illuminate\Http\Request;

class SettingSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // dd(setting_system::all()[0]);
        $tmp=setting_system::all()[0];
        if( sizeof(setting_system::all()))
        {
            return view('features.admin.setting_system',[
                'title' => 'setting system',
                'setting'=> $tmp,
                'status'=>'1'
            ]);
        }
        return view('features.admin.setting_system',[
            'title' => 'setting system',
            'status'=>'0'
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
        // dd($request->all());
        setting_system::truncate();
        $tmp= new setting_system();
        $tmp->pemberian_topik_dosen=array_key_exists("pemberian_topik_dosen",$request->all()) ;
        $tmp->pemilihan_topik_mahasiswa=array_key_exists("pemilihan_topik_mahasiswa",$request->all()) ;
        $tmp->save();
        return view('features.admin.setting_system',[
            'title' => 'setting system',
            'setting'=> $tmp,
            'status'=>'1'
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
