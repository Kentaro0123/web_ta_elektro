<?php

namespace App\Http\Controllers;

use App\Models\DosenPembimbingTambahan;
use App\Http\Requests\StoreDosenPembimbingTambahanRequest;
use App\Http\Requests\UpdateDosenPembimbingTambahanRequest;
use App\Models\Skripsi;
use App\Models\User;
use Illuminate\Http\Request;

class DosenPembimbingTambahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skripsi= new Skripsi();
        $dosen_user= new User();
        $dosen=$dosen_user->all()->where('role','=',2);
        // dd($dosen);
        
        return view('features.admin.get_skripsi_tambah_dosen_pembimbing',[
            'title' => 'Penambahan Dosen Pembimbing',
            'skripsi'=>$skripsi->get(),
            'dosen' => $dosen
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
     * @param  \App\Http\Requests\StoreDosenPembimbingTambahanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nip=strtok($request->dosen_tambahan,'-');
       $dpt= new DosenPembimbingTambahan();
       $dpt->user_nip=$nip;
       $dpt->id_skripsi=$request->id_skripsi;
        $dpt->save();

        return redirect()->back();
       

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DosenPembimbingTambahan  $dosenPembimbingTambahan
     * @return \Illuminate\Http\Response
     */
    public function show(DosenPembimbingTambahan $dosenPembimbingTambahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DosenPembimbingTambahan  $dosenPembimbingTambahan
     * @return \Illuminate\Http\Response
     */
    public function edit(DosenPembimbingTambahan $dosenPembimbingTambahan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDosenPembimbingTambahanRequest  $request
     * @param  \App\Models\DosenPembimbingTambahan  $dosenPembimbingTambahan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDosenPembimbingTambahanRequest $request, DosenPembimbingTambahan $dosenPembimbingTambahan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DosenPembimbingTambahan  $dosenPembimbingTambahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        DosenPembimbingTambahan::find($id)->delete();
        return redirect()->back();
        
    }
}
