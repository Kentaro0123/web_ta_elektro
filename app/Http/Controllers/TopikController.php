<?php

namespace App\Http\Controllers;

use App\Models\RiwayatMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Topik;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Mahasiswa;

class TopikController extends Controller
{
    public function index(){
        return view('features.dosen.post_topik',[
            'title' => 'Topik'
        ]);
    }

    public function store(Request $request){
       
        
        $request->validate([

            'inputJudulTopik' => 'required|unique:topik,judul',
            'inputDeskripsiTopik'=>'required',
            'inputKuota' => 'required',
            'inputPersyaratanMahasiswa' =>'required',
            'inputFasilitasYangDidapatkan' => 'required',

               
        ]);
        $topik= new Topik();
        $topik->judul=$request->input('inputJudulTopik');
        $topik->deskripsi=$request->input('inputDeskripsiTopik');
        $topik->persyaratan_mahasiswa=$request->input('inputPersyaratanMahasiswa');
        $topik->fasilitas_diperoleh=$request->input('inputFasilitasYangDidapatkan');
        $topik->kuota=$request->input('inputKuota');
        $topik->user_nip=$request->input('inputUserNip');
       
        $topik->save();
        // if ($validatedData['role']== 2){
        //     $mahasiswa =$request->only(['user_nip', 'konsentrasi','ipk']);
        // }
   
        // $mahasiswa['ipk']=number_format($mahasiswa['ipk'],2);
       
        // $request->flash('success','Registration Success');

        return redirect('/post_topik')->with('success','Registration Success');
    }
    public function show_auth(){

        return view('features.dosen.get_topik',[
            'title' => 'Topik',
            'user'=> User::with('topik')->where('nip','=',Auth::user()->nip)->get()
        ]);
        
    }
    public function show(){
        


        $arrayRiwayatTopik=RiwayatMahasiswa::all()->where('nip','=',Auth::user()->nip);
        
        $jadwal_sidang='';
        $jadwal_sidang_akhir='';
        if($arrayRiwayatTopik->first()->skripsi->jadwal_sidang->jam_pelaksanaan?? 0  ){
            $jadwal_sidang=$arrayRiwayatTopik->first()->skripsi->jadwal_sidang;
            $jadwal_sidang_akhir=$arrayRiwayatTopik->first()->skripsi->jadwal_sidang_akhir;
        }  
        else{
            $jadwal_sidang='Tunggu Jadwal Sidang';
        }

        // dd($arrayRiwayatTopik->first()->acc_topik );
        if(sizeof($arrayRiwayatTopik) == 1 &&  $arrayRiwayatTopik->first()->acc_topik == 1 ){
            // dd($arrayRiwayatTopik->first()->jadwal_sidang);
           return view('features.get_all_topik',[
                'title' => 'ACC',
                'acc'=>  $arrayRiwayatTopik->first(),
                'jadwal_sidang' => $jadwal_sidang,
                'jadwal_sidang_akhir' => $jadwal_sidang_akhir
            ]);
        }
        $user=User::with('topik')->get();

        foreach($user as $key1 => $item){
            foreach($item->topik as $key2 => $tp){

               foreach($arrayRiwayatTopik as $art)
               {

                if($tp->id==$art->idTopik){

                   unset($user[$key1]->topik[$key2]);
                }

               }
            }
        }

        return view('features.get_all_topik',[
            'title' => 'Topik',
            'user'=> $user,
            'added_topik'=>$arrayRiwayatTopik
        ]);
        
    }
    public function show_detail(string $id){


        // dd($topikarr);
        // $topik=$topikarr[1];
        $topikarr= Topik::all()->where('id','=',$id);
        $topik=reset($topikarr);
        $final=array_pop($topik);
        return view('features.detail_topik',[

            'title' => 'Detail Topik',
            // 'topik'=> head( Topik::all()->where('id','=',$id))
            'topik'=>$final

        ]);

    }
}
