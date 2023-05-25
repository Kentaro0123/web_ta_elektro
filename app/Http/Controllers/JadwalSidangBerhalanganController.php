<?php

namespace App\Http\Controllers;

use App\Models\JadwalSidangBerhalangan;
use App\Http\Requests\StoreJadwalSidangBerhalanganRequest;
use App\Http\Requests\UpdateJadwalSidangBerhalanganRequest;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class JadwalSidangBerhalanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jsb=new JadwalSidangBerhalangan();

        
       $jadwal_sidang_berhalangan= $jsb->all()->where('user_nip' ,'=',Auth::user()->nip);

       return view('features.dosen.post_jadwal_berhalangan',[
                'title'=> 'Pengajuan Jadwal Berhalangan',
                'jadwal_sidang_berhalangan'=> $jadwal_sidang_berhalangan,
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
     * @param  \App\Http\Requests\StoreJadwalSidangBerhalanganRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            "hari_berhalangan" => 'required',
            "jam_berhalangan"=>'required'
        ]);

   
        $jsb=new JadwalSidangBerhalangan();
        $jsb->hari=$request->hari_berhalangan;
        $jsb->jam=$request->jam_berhalangan;
        $jsb->user_nip=Auth::user()->nip;
        $jsb->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JadwalSidangBerhalangan  $jadwalSidangBerhalangan
     * @return \Illuminate\Http\Response
     */
    public function show(JadwalSidangBerhalangan $jadwalSidangBerhalangan)
    {
       
    }

    public function show_user(){
        $id=$_GET['id'];
        $jsb=JadwalSidangBerhalangan::all()->where('user_nip','=',$id[0]);
        return response()->json([
            'jsb' => $jsb
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JadwalSidangBerhalangan  $jadwalSidangBerhalangan
     * @return \Illuminate\Http\Response
     */
    public function edit(JadwalSidangBerhalangan $jadwalSidangBerhalangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJadwalSidangBerhalanganRequest  $request
     * @param  \App\Models\JadwalSidangBerhalangan  $jadwalSidangBerhalangan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJadwalSidangBerhalanganRequest $request, JadwalSidangBerhalangan $jadwalSidangBerhalangan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JadwalSidangBerhalangan  $jadwalSidangBerhalangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(JadwalSidangBerhalangan $jadwalSidangBerhalangan)
    {
        //
    }
}
