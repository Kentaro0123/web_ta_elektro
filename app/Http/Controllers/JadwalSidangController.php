<?php

namespace App\Http\Controllers;

use App\Models\JadwalSidang;
use App\Http\Requests\StoreJadwalSidangRequest;
use App\Http\Requests\UpdateJadwalSidangRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Skripsi;
use App\Models\DosenSidang;
use App\Models\Topik;
use Illuminate\Support\Facades\Auth;

class JadwalSidangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $id){

        $skripsi=Skripsi::with('riwayat_mahasiswa')->find($id);
        $dosen=User::all()->where('role','=','2');

        // dd($dosen);
        
        return view('features.admin.post_penjadwalan_sidang',[
            "title"=>"Penjadwalan Sidang",
            "skripsi"=>$skripsi,
            "dosen"=>$dosen,
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
     * @param  \App\Http\Requests\StoreJadwalSidangRequest  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request){

        $request->validate([
            "judul_ta" => 'required',
            "id_skripsi"=>'required',
            "nama_mahasiswa" => 'required',
            "nip_mahasiswa" => 'required',
            "ipk" => "required",
            "dosen_penguji.*"=>"required",
            "dosen_pembimbing" => 'required',
            "hari_pelaksanaan" => 'required',
            "jam_pelaksanaan" => 'required',
            "jam_selesai" => 'required',
        ]);

       
        // dd($request->all());
        $jadwal_sidang= new JadwalSidang();

        $jadwal_sidang->id_skripsi=$request->id_skripsi;
        $jadwal_sidang->hari_pelaksanaan=$request->hari_pelaksanaan;
        $jadwal_sidang->jam_pelaksanaan=$request->jam_pelaksanaan;
        $jadwal_sidang->jam_selesai=$request->jam_selesai;
        $jadwal_sidang->save();

            
        $penguji=$request->dosen_penguji;

        foreach($penguji as $pj){
            
            $dosen_sidang= new DosenSidang();
            $dosen_sidang->id_jadwal_sidang=$jadwal_sidang->id;
            $dosen_sidang->id_dosen=strtok($pj,' -');
            $dosen_sidang->save();
            
        }

        return redirect('/get_skripsi_mahasiswa')->with("success","Topik $request->judul_ta Berhasil Dijadwalkan");
        // dd($request->all());
        
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JadwalSidang  $jadwalSidang
     * @return \Illuminate\Http\Response
     */
    public function show(JadwalSidang $jadwalSidang)
    {
        //
    }

    public function show_mahasiswa_dosen(DosenSidang $dosenSidang)
    {
        $jadwalSidangMahasiswaDosen=$dosenSidang->with('jadwal_sidang')->where('id_dosen','=',Auth::user()->nip)->get();
        $topikDosenSidang= Topik::with('riwayat_mahasiswa')->where('user_nip','=',Auth::user()->nip)->get();
       
        return view('features.dosen.get_jadwal_sidang_mahasiswa_dosen',
            [
                'title' => 'Jadwal Sidang',
                'jadwalSidangMahasiswaDosen' => $jadwalSidangMahasiswaDosen,
                'topikDosenSidang'  => $topikDosenSidang

                
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JadwalSidang  $jadwalSidang
     * @return \Illuminate\Http\Response
     */
    public function edit(JadwalSidang $jadwalSidang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJadwalSidangRequest  $request
     * @param  \App\Models\JadwalSidang  $jadwalSidang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJadwalSidangRequest $request, JadwalSidang $jadwalSidang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JadwalSidang  $jadwalSidang
     * @return \Illuminate\Http\Response
     */
    public function destroy(JadwalSidang $jadwalSidang)
    {
        //
    }
}
