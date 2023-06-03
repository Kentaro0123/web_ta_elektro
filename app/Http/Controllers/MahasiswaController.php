<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }



    /**
     * Display the specified resource.
     */
    public function show()
    {
  
       
        // $mahasiswa= DB::table('mahasiswa')
        // ->join('users', 'mahasiswa.user_nip', '=', 'users.nip')
        // ->select('users.*', 'mahasiswa.*')
        // ->get();
        // dd(User::with('riwayat_mahasiswa')->has('mahasiswa')->get());
        return view('features.admin.list_mahasiswa',[
            "title" => 'mahasiswa proposal',
            "users" =>User::with('riwayat_mahasiswa')->has('mahasiswa')->get()
        ]);
    }
    public function show_akhir()
    {
  
       
        // $mahasiswa= DB::table('mahasiswa')
        // ->join('users', 'mahasiswa.user_nip', '=', 'users.nip')
        // ->select('users.*', 'mahasiswa.*')
        // ->get();
        // dd(User::with('riwayat_mahasiswa')->has('mahasiswa')->get());
        return view('features.admin.list_mahasiswa_akhir',[
            "title" => 'mahasiswa akhir',
            "users" =>User::with('riwayat_mahasiswa')->has('mahasiswa')->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMahasiswaRequest $request, Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }
}
