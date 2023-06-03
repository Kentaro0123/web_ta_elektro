<?php

namespace App\Http\Controllers;

use App\Models\Skripsi;
use App\Http\Requests\StoreSkripsiRequest;
use App\Http\Requests\UpdateSkripsiRequest;
use App\Models\RiwayatMahasiswa;
use Illuminate\Http\Request;

class SkripsiController extends Controller
{
    
    public function lulus_proposal(string $id){

        $skripsi=Skripsi::find($id);
        $skripsi->lulus_proposal=1;
        $skripsi->save();
        return redirect()->back(); 
    }
    public function cancel_lulus_proposal(string $id){

        $skripsi=Skripsi::find($id);
        $skripsi->lulus_proposal=0;
        $skripsi->save();
        return redirect()->back(); 
    }
    public function lulus_skripsi(string $id){

        $skripsi=Skripsi::find($id);
        $skripsi->lulus_skripsi=1;
        $skripsi->save();
        return redirect()->back(); 
    }
    public function cancel_lulus_skripsi(string $id){

        $skripsi=Skripsi::find($id);
        $skripsi->lulus_skripsi=0;
        $skripsi->save();
        return redirect()->back(); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * @param  \App\Http\Requests\StoreSkripsiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_skripsi'=>'required',
            'id_riwayat_mahasiswa' => 'required',
        ]);
        // dd("helo");

        //update Riwayat_Mahasiswa
        $cek_skripsi=Skripsi::where('judul','=',$request->judul_skripsi)->get()->count();

        if($cek_skripsi){
      
            return redirect()->back();
        }
        else{
            $rm=RiwayatMahasiswa::find($request->id_riwayat_mahasiswa);
            $rm->acc_judul=TRUE;
            $rm->save();
    
    
    
            //store skripsi
    
    
            $skripsi=new Skripsi();
            // dd($skripsi->all());
            $skripsi->judul=$request->judul_skripsi;
            $skripsi->id_riwayat_mahasiswa=$request->id_riwayat_mahasiswa;
            $skripsi->lulus_proposal= false;
            $skripsi->lulus_skripsi= false;
            $skripsi->save();
            return redirect()->back();
        }
        
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skripsi  $skripsi
     * @return \Illuminate\Http\Response
     */
    public function show(Skripsi $skripsi)
    {

        $skripsi=$skripsi::with('riwayat_mahasiswa')->doesntHave('jadwal_sidang')->get();
        $terjadwalkan=Skripsi::with('riwayat_mahasiswa')->has('jadwal_sidang')->get();


        // dd($skripsi);
        
        return view('features.admin.get_skripsi_mahasiswa',[
            'title' => 'List Skripsi Penjadwalan Proposal',
            'skripsi' => $skripsi,
            'terjadwalkan' => $terjadwalkan
        ]);
    }

    public function show_mahasiswa_lulus_proposal(Skripsi $skripsi){
        $skripsi=$skripsi::with('riwayat_mahasiswa')->doesntHave('jadwal_sidang_akhir')->where('lulus_proposal','=','1')->get();
        $terjadwalkan=Skripsi::with('riwayat_mahasiswa')->has('jadwal_sidang_akhir')->where('lulus_proposal','=','1')->get();


        // dd($skripsi);
        
        return view('features.admin.get_skripsi_mahasiswa_akhir',[
            'title' => 'List Penjadwalan Sidang Akhir',
            'skripsi' => $skripsi,
            'terjadwalkan' => $terjadwalkan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skripsi  $skripsi
     * @return \Illuminate\Http\Response
     */
    public function edit(Skripsi $skripsi, Request $request)
    {
        $cek_skripsi=Skripsi::where('judul','=',$request->judul_skripsi)->get()->count();

        if( $cek_skripsi){
            return redirect()->back();
        }
        else{
            $skripsi->find($request->id_skripsi)->update(['judul'=> $request->judul_skripsi]);
            // dd($request->id_riwayat_mahasiswa);
    
            return redirect()->back()->with("success_change_$request->id_riwayat_mahasiswa" ,'Berhasil di Ubah');
        }
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSkripsiRequest  $request
     * @param  \App\Models\Skripsi  $skripsi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSkripsiRequest $request, Skripsi $skripsi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skripsi  $skripsi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skripsi $skripsi)
    {
        //
    }
    public function get_list_mahasiswa_lulus(){

        $skripsi=Skripsi::all();
        return view('features.admin.get_list_mahasiswa_lulus',[
            'title'=> 'Daftar Mahasiswa yang Lulus Proposal atau Final',
            'skripsi' =>$skripsi
        ]);
    }
}
