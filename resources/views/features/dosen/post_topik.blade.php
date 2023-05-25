@extends('layouts.main')
@section('container')
<div class="container">
    <h1>Halaman {{ $title }} </h1> 
</div>
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
   {{ session('success') }}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
     <span aria-hidden="true">&times;</span>
   </button>
 </div>     
@endif
 
{{-- <div class="container">
  
</div> --}}
      <div class="row mt-5" >
        <form action="/post_topik" method="post">
            @csrf
            <div class="form-group row">
              <label for="inputJudulTopik" class="col-sm-2 col-form-label">Judul Topik</label>
              <div class="col-sm-10">
                <input name="inputJudulTopik" type="text" class="form-control" id="inputJudulTopik" value="" placeholder="masukan judul topik ...">
              </div>
            </div>
            <br>
            <div class="form-group row">
                <label for="inputDeskripsiTopik" class="col-sm-2 col-form-label">Deskripsi Topik</label>
                <div class="col-sm-10">
                    <textarea name="inputDeskripsiTopik" rows='10' type="text" class="form-control" id="inputDeskripsiTopik" value="" placeholder="masukan deskripsi topik ..."></textarea>
                </div>
            </div>
            <br>

            <div class="form-group row">
                <label for="inputPersyaratanMahasiswa" class="col-sm-2 col-form-label">Persyaratan Mahasiswa</label>
                <div class="col-sm-10">
                    <textarea name="inputPersyaratanMahasiswa" rows='5' type="text" class="form-control" id="inputPersyaratanMahasiswa" value="" placeholder="masukan persyaratan untuk mengambil skripsi ini ..."></textarea>
                </div>
            </div>
            <br>

            <div class="form-group row">
                <label for="inputFasilitasYangDidapatkan" class="col-sm-2 col-form-label">Fasilitas yang Didapatkan</label>
                <div class="col-sm-10">
                    <textarea name="inputFasilitasYangDidapatkan" rows='5' type="text" class="form-control" id="inputFasilitasYangDidapatkan" value="" placeholder="masukan fasilitas yang di dapatkan mahasiswa ..."></textarea>
                </div>
            </div>
            <br>

            <div class="form-group row">
              <label for="inputKuota" class="col-sm-2 col-form-label">Kuota</label>
              <div class="col-sm-10">
                <input name="inputKuota" type="number" min="0" step="1" class="form-control" id="inputKuota" value="" placeholder="masukan kuota ...">
              </div>
            </div>
            <br>

            <div class="form-group row" hidden>
                <label for="inputUserNip" class="col-sm-2 col-form-label">User_Nip</label>
                <div class="col-sm-10">
                    <input name="inputUserNip" type="text" class="form-control" id="inputUserNip" value="{{ Auth::user()->nip }}" placeholder="masukan judul pengumuman ..." >
                </div>
            </div>
            <br>

            <button type="submit" class="btn btn-primary">Submit</button>
            
            
          </form>
      </div>


@endsection