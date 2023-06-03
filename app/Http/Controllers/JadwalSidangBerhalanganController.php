<?php

namespace App\Http\Controllers;

use App\Models\JadwalSidangBerhalangan;
use App\Http\Requests\StoreJadwalSidangBerhalanganRequest;
use App\Http\Requests\UpdateJadwalSidangBerhalanganRequest;
use DateTime;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public function get_all(string $jam_pelaksanaan,string $jam_selesai,string $hari_pelaksanaan)
    {
        $jsb=new JadwalSidangBerhalangan();
        $jam_pelaksanaan=$_GET['jam_pelaksanaan'];
        $jam_selesai=$_GET['jam_selesai'];
        $hari_pelaksanaan=$_GET['hari_pelaksanaan'];
        
        // $jadwal_sidang_berhalangan= DB::table('jadwal_sidang_berhalangan')->where('hari'=);
        $jadwal_sidang_berhalangan=$jsb->all()->where('hari','=',$hari_pelaksanaan)->whereBetween('jam',[date(("H:i:s"),strtotime('-1 minutes',strtotime($jam_pelaksanaan))),date(('H:i'),strtotime('+1 minutes',strtotime($jam_selesai)))])->unique('user_nip')->values()->all();

        // $nip=array_map(function($jadwal_sidang_berhalangan){
        //     return $jadwal_sidang_berhalangan->nip;
        // },$jadwal_sidang_berhalangan->toArray());
        return response()->json([
            // 'jsb' => $jadwal_sidang_berhalangan,
            'jsb' => $jadwal_sidang_berhalangan,
            // 'jsb'=> date(("H:i"),strtotime('-1 minutes',strtotime($jam_pelaksanaan))),
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
        // dd($request->all());
        $request->validate([
            "hari_berhalangan" => 'required',
            "jam_berhalangan_mulai"=>'required'
        ]);

        if(($request->jam_berhalangan_selesai ?? '' )== ''){
            $jsb=new JadwalSidangBerhalangan();
            $jsb->hari=$request->hari_berhalangan;
            $jsb->jam=$request->jam_berhalangan_mulai;
            $jsb->user_nip=Auth::user()->nip;
            $jsb->save();
        }
        else{
           $jbs= explode(":",$request->jam_berhalangan_selesai);
           $jbm= explode(":",$request->jam_berhalangan_mulai);

            $times=strtotime("$jbs[0]".":"."$jbs[1]");
            $timem=strtotime("$jbm[0]".":"."$jbm[1]");
            while (date("H:i:s",$timem) <= date("H:i:s",$times)){

                $jsb=new JadwalSidangBerhalangan();
                $jsb->hari=$request->hari_berhalangan;
                $jsb->jam=date("H:i",$timem);
                $jsb->user_nip=Auth::user()->nip;
                $jsb->save();
                $timem=strtotime('+30 minutes',$timem);
                
            }
        }
   
        

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
    public function destroy_unit(string $id)
    {
        JadwalSidangBerhalangan::destroy($id) ;

        return redirect()->back();
    }
    public function destroy_multiple_units(string $hari)
    {
       $hari_berhalangan= JadwalSidangBerhalangan::all()->where('hari','=',$hari)->where('user_nip','=',Auth::user()->nip) ;
       foreach($hari_berhalangan as $hb){
        JadwalSidangBerhalangan::destroy($hb->id);
       }
        // dd($hari_berhalangan);
        return redirect()->back();
    }
}
