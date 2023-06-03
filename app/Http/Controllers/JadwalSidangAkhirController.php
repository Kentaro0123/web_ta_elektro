<?php

namespace App\Http\Controllers;

use App\Models\JadwalSidangAkhir;
use App\Http\Requests\StoreJadwalSidangAkhirRequest;
use App\Http\Requests\UpdateJadwalSidangAkhirRequest;

use App\Models\Skripsi;
use App\Models\User;
use App\Models\DosenPembimbingTambahan;

use App\Models\JadwalSidangBerhalangan;
use Illuminate\Http\Request;
use App\Models\DosenSidangAkhir;
use App\Models\Topik;
use Illuminate\Support\Facades\Auth;

class JadwalSidangAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $id)
    {
        $skripsi=Skripsi::with('riwayat_mahasiswa')->find($id);
        $dosen=User::all()->where('role','=','2');
        $dosen_pembimbing_tambahan=DosenPembimbingTambahan::all()->where('id_skripsi','=',$skripsi->id);

        $merge_berhalangan=[];
        // $merge_berhalangan=$dosen_pembimbing_tambahan->toBase()->
        
        $tmp=$skripsi->riwayat_mahasiswa->topik->user->jadwal_sidang_berhalangan;
        $merge_berhalangan = $tmp->toBase()->merge($merge_berhalangan);
        
        if($dosen_pembimbing_tambahan)
        foreach($dosen_pembimbing_tambahan as $item){

            // dd($item->user->jadwal_sidang_berhalangan);
        $merge_berhalangan = $item->user->jadwal_sidang_berhalangan->toBase()->merge($merge_berhalangan);
            
        }
        // dd($merge_berhalangan);
        
        return view('features.admin.post_penjadwalan_sidang_akhir',[
            "title"=>"Penjadwalan Sidang Akhir",
            "skripsi"=>$skripsi,
            "dosen"=>$dosen,
            "dosen_pembimbing_tambahan" => $dosen_pembimbing_tambahan,
            "merge_berhalangan" => $merge_berhalangan
        ]);
    }

    public function store(Request $request){

        
        // dd($request->all());
        $request->validate([
            "judul_ta" => 'required',
            "id_skripsi"=>'required',
            "nama_mahasiswa" => 'required',
            "nip_mahasiswa" => 'required',
            "ipk" => "required",
            "dosen_penguji.*"=>"required",
            "hari_pelaksanaan" => 'required',
            "jam_pelaksanaan" => 'required',
            "jam_selesai" => 'required',
        ]);

       
        // dd($request->all());
        $jadwal_sidang= new JadwalSidangAkhir();
        $jadwal_sidang->tempat_sidang=$request->tempat_sidang;
        $jadwal_sidang->id_skripsi=$request->id_skripsi;
        $jadwal_sidang->hari_pelaksanaan=$request->hari_pelaksanaan;
        $jadwal_sidang->jam_pelaksanaan=$request->jam_pelaksanaan;
        $jadwal_sidang->jam_selesai=$request->jam_selesai;
        $jadwal_sidang->save();

            
        $penguji=$request->dosen_penguji;
        //peguji di jadwalkan
        
            foreach($penguji as $pj){
            
                $dosen_sidang= new DosenSidangAkhir();
                $dosen_sidang->id_jadwal_sidang=$jadwal_sidang->id;
                $dosen_sidang->id_dosen=strtok($pj,' -');
                $dosen_sidang->save();
                
            }

        
       

        //sesi penambahan jam berhalangan 

        
        $jbs= explode(":",$request->jam_selesai);
        $jbm= explode(":",$request->jam_pelaksanaan);


        //Penguji Berhalangan di tambahkan
        
         foreach($penguji as $pj){

            $times=strtotime("$jbs[0]".":"."$jbs[1]");
            $timem=strtotime("$jbm[0]".":"."$jbm[1]");
            while (date("H:i",$timem) <= date("H:i",$times)){

                $jsb=new JadwalSidangBerhalangan();
                $jsb->hari=$request->hari_pelaksanaan;
                $jsb->jam=date("H:i",$timem);
                $jsb->user_nip=strtok($pj,' -');
                $jsb->save();
                $timem=strtotime('+30 minutes',$timem);
                
            }
         }
        
         //Pembimbing tambahan berhalangan di tambahkan 
         if ($request->dosen_pembimbing_tambahan ?? 0){
            foreach($request->dosen_pembimbing_tambahan as $pj){

                $times=strtotime("$jbs[0]".":"."$jbs[1]");
                $timem=strtotime("$jbm[0]".":"."$jbm[1]");
                while (date("H:i",$timem) <= date("H:i",$times)){

                    $jsb=new JadwalSidangBerhalangan();
                    $jsb->hari=$request->hari_pelaksanaan;
                    $jsb->jam=date("H:i",$timem);
                    $jsb->user_nip=$pj;
                    $jsb->save();
                    $timem=strtotime('+30 minutes',$timem);
                    
                }
            }
        }
            //Pembimnbing berhalangan di tambahkan

           

                $times=strtotime("$jbs[0]".":"."$jbs[1]");
                $timem=strtotime("$jbm[0]".":"."$jbm[1]");
                while (date("H:i",$timem) <= date("H:i",$times)){
    
                    $jsb=new JadwalSidangBerhalangan();
                    $jsb->hari=$request->hari_pelaksanaan;
                    $jsb->jam=date("H:i",$timem);
                    $jsb->user_nip=$request->dosen_pembimbing_id;
                    $jsb->save();
                    $timem=strtotime('+30 minutes',$timem);
                    
                }
            
         //

        return redirect('/get_skripsi_mahasiswa_lulus_proposal')->with("success","Topik $request->judul_ta Berhasil Dijadwalkan");
        // dd($request->all());
        
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
     * Display the specified resource.
     *
     * @param  \App\Models\JadwalSidangAkhir  $jadwalSidangAkhir
     * @return \Illuminate\Http\Response
     */
    public function show_mahasiswa_dosen(DosenSidangAkhir $dosenSidang)
    {
        $jadwalSidangMahasiswaDosen=DosenSidangAkhir::where('id_dosen',Auth::user()->nip)->with('penilaian')->whereHas('jadwal_sidang_akhir')->get();
        

        $topikDosenSidang= Topik::with('riwayat_mahasiswa')->where('user_nip','=',Auth::user()->nip)->get();
        $dosenPembimbingTambahan= DosenPembimbingTambahan::with('skripsi')->where('user_nip','=',Auth::user()->nip)->get();
        // $tmp=$jadwalSidangMahasiswaDosen->whereHas('penilaian')->user;
    //    dd($jadwalSidangMahasiswaDosen);
        return view('features.dosen.get_jadwal_sidang_mahasiswa_dosen_akhir',
            [
                'title' => 'Jadwal Sidang Akhir',
                'jadwalSidangMahasiswaDosen' => $jadwalSidangMahasiswaDosen,
                'topikDosenSidang'  => $topikDosenSidang,
                'dosenPembimbingTambahan' => $dosenPembimbingTambahan

                
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JadwalSidangAkhir  $jadwalSidangAkhir
     * @return \Illuminate\Http\Response
     */
    public function edit(JadwalSidangAkhir $jadwalSidangAkhir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJadwalSidangAkhirRequest  $request
     * @param  \App\Models\JadwalSidangAkhir  $jadwalSidangAkhir
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJadwalSidangAkhirRequest $request, JadwalSidangAkhir $jadwalSidangAkhir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JadwalSidangAkhir  $jadwalSidangAkhir
     * @return \Illuminate\Http\Response
     */
    public function destroy(JadwalSidangAkhir $jadwalSidangAkhir)
    {
        //
    }
}
