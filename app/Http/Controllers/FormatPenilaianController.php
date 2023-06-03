<?php

namespace App\Http\Controllers;

use App\Models\FormatPenilaian;
use App\Http\Requests\StoreFormatPenilaianRequest;
use App\Http\Requests\UpdateFormatPenilaianRequest;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use App\Models\SubFormat;

class FormatPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('features.admin.post_format_penilaian',[
            'title' => 'Format Penilaian Proposal'
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
     * @param  \App\Http\Requests\StoreFormatPenilaianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'judul_nilai'=> 'required',
            'bobot_nilai'=> 'required',
            'judul_sub_nilai'=> 'required'
        ]);
        // dd($request->all());
        FormatPenilaian::truncate();
        SubFormat::truncate();
        Penilaian::where('sidang_proposal','=', '1')->delete();  
        $judul_nilai=$request->judul_nilai;
        $bobot_nilai=$request->bobot_nilai;
        $judul_sub_nilai=$request->judul_sub_nilai;
        foreach($judul_nilai as $key => $item){
            $formatPenilaian=new FormatPenilaian();
            $formatPenilaian->judul_nilai=$judul_nilai[$key];
            $formatPenilaian->bobot_nilai=$bobot_nilai[$key];
            $formatPenilaian->save();
            foreach($judul_sub_nilai[$key] as $key1 => $item1){
                $subFormat=new SubFormat();
                $subFormat->format_penilaian_id=$formatPenilaian->id;
                $subFormat->judul_sub_format=$item1;
                $subFormat->save();
           
            }

        }
        // dd('selesai');
        return redirect()->back()->with('success','Format Berhasil di Uploud');

    }



    public function show()
    {
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormatPenilaian  $formatPenilaian
     * @return \Illuminate\Http\Response
     */
    public function edit(FormatPenilaian $formatPenilaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFormatPenilaianRequest  $request
     * @param  \App\Models\FormatPenilaian  $formatPenilaian
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormatPenilaianRequest $request, FormatPenilaian $formatPenilaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormatPenilaian  $formatPenilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormatPenilaian $formatPenilaian)
    {
        //
    }
}
