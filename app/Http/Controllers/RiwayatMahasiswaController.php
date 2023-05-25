<?php

namespace App\Http\Controllers;

use App\Models\RiwayatMahasiswa;
use App\Http\Requests\StoreRiwayatMahasiswaRequest;
use App\Http\Requests\UpdateRiwayatMahasiswaRequest;
use App\Models\Topik;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ZipArchive;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use PhpParser\Node\Stmt\Foreach_;

class RiwayatMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('features.dosen.request_topik_mahasiswa',[
                    "title"=> 'Request Mahasiswa',
                    "topik"=>Topik::with('riwayat_mahasiswa')->where('user_nip','=',Auth::user()->nip)->get()
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
     * @param  \App\Http\Requests\StoreRiwayatMahasiswaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $max=3;
        // dd($request->);
        $validatedData=$request->validate([
            'nip'=>'required','unique:users',
            'idTopik' => 'required',
            'judul_topik'=>'required',
            // 'acc_topik' => 'required',
            // 'acc_judul'=>'required',
            'file_path' => 'required',
            'file_path.*' => 'mimes:csv,txt,xlx,xls,pdf,docx'
        ]);

        


        $quantity=RiwayatMahasiswa::all()->where('nip','=',"$request->nip")->count();
     

        // dd($quantity);
        if ( $quantity < $max){
            if($request->hasFile('file_path')){
         
                foreach($request->file('file_path') as $key => $file){
                    $file->store("public/files/$request->nip/$request->idTopik");
                    // $file->getClientOriginalName();
    
                    // $insert[$key]['name']=$name;
                    // $insert[$key]['path']=$path;
    
                }
            }
    
            // RiwayatMahasiswa::insert($validatedData); // digunakan untuk multiple insert liat di atas ada  foreach loop
    
            $rm=new RiwayatMahasiswa();
            $rm->nip=$validatedData['nip'];
            $rm->idTopik=$validatedData['idTopik'];
            $rm->judul_topik=$validatedData['judul_topik'];
            $rm->acc_topik=false;
            $rm->acc_judul=false;
            $rm->file_path="public/files/$request->nip/$request->idTopik";
    
            $rm->save();
            
            return redirect('get_all_topik')->with('success','Request Berhasil !');
    
        }
        else{
            return redirect()->back()->with('fail',"GAGAL, anda sudah memilih $max judul Topik, kurangi topik anda !");
        
        }

      

       
         

      
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RiwayatMahasiswa  $riwayatMahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show_acc(Topik $topik)
    {

        $show_acc=$topik->with('user')->with('riwayat_mahasiswa')->where('user_nip','=',Auth::user()->nip)->get();
        
        foreach ($show_acc as $key => $sa) {
            foreach($sa->riwayat_mahasiswa as $key1 => $rm)

            if($rm->acc_topik == '0')
            {
            $show_acc[$key]->riwayat_mahasiswa->forget($key1);
            }

        }
    return view('features.dosen.post_judul_skripsi',[
            "title" => 'Pemberian Judul SubTopik',   
            "topik" => $show_acc
        ]);
        
    }

    public function download(string $id){

        //base code on https://stackoverflow.com/questions/51873115/creating-zip-of-multiple-files-and-download-in-laravel
        $rmarr=RiwayatMahasiswa::all()->where('id','=',$id);
        // dd($rm);
        ////this from my database
        $tmp=reset($rmarr);
        $rm=array_pop($tmp);
            
        $files = Storage::allFiles($rm->file_path);

        $zip = new \ZipArchive();
        $fileName = "$rm->nip,$rm->judul_topik.zip";
        $zip->open($fileName,\ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        // dd($files);
        foreach ($files as $file){
            // dd($file);
            $relativeName=basename($file);
            // dd(storage_path($file));
            $zip->addFile(storage_path("app\\".$file),$relativeName);
        }
        $zip->close();
        return response()->download($fileName);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatMahasiswa  $riwayatMahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatMahasiswa $riwayatMahasiswa)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRiwayatMahasiswaRequest  $request
     * @param  \App\Models\RiwayatMahasiswa  $riwayatMahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update_topik(string $id)
    {
        //jadi untuk acc judul nantinya akan masuk tercatat di database terpisah dengan status true nya tetap di riwayat mahasiswa
        
        
        $nip=RiwayatMahasiswa::find($id)->nip;
        RiwayatMahasiswa::where('id','=',$id)->update(['acc_topik' => TRUE]);
        $arrPath=RiwayatMahasiswa::all()->where('nip','=',$nip)->where('acc_topik','=','0');
        // dd($arrPath);
        foreach($arrPath as $path){
            
           
            if(Storage::deleteDirectory( $path->file_path)){
                $path->delete();
            }
            else{
                dd('fail');
            }
        }

        // dd($arrPath);
    //  $arrPath->delete();
   

    //    $tmp=reset($rmarr);
    //    $rm=array_pop($tmp);
    //    dd($rmarr);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatMahasiswa  $riwayatMahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatMahasiswa $riwayatMahasiswa,string $id)
    {
        $path=$riwayatMahasiswa->all()->find($id)->file_path;
        // dd($path);
       
        Storage::deleteDirectory($path);
        $riwayatMahasiswa->destroy($id);
        return redirect()->back();
    }
}
