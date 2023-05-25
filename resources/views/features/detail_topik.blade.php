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

@if (session()->has('fail'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
   {{ session('fail') }}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
     <span aria-hidden="true">&times;</span>
   </button>
 </div>     
@endif
<div class="row mt-5">
    <form >

        <div class="form-group row">
          <label for="inputJudulTopik" class="col-sm-2 col-form-label">JUDUL TOPIK</label>
          <div class="col-sm-10">
            <input name="inputJudulTopik" type="text" class="form-control" id="inputJudul" value="{{ $topik->judul }}" placeholder="masukan judul pengumuman ..." disabled>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputCatatanTopik" class="col-sm-2 col-form-label">Deskripsi topik</label>
          <div class="col-sm-10">
            <textarea name="inputCatatanTopik" rows=10 class="form-control" id="inputCatatanTopik"  placeholder="masukan catatan ..." disabled>{{ $topik->deskripsi }}</textarea>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPersyaratanMahasiswa" class="col-sm-2 col-form-label">Persyaratan Mahasiswa</label>
          <div class="col-sm-10">
            <textarea name="inputPersyaratanMahasiswa" rows=3 class="form-control" id="inputPersyaratanMahasiswa"  placeholder="masukan catatan ..." disabled>{{ $topik->persyaratan_mahasiswa }}</textarea>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputFasilitasYangDidapatkan" class="col-sm-2 col-form-label">Fasilitas yang Didapatkan</label>
          <div class="col-sm-10">
            <textarea name="inputFasilitasYangDidapatkan" rows=3 class="form-control" id="inputFasilitasYangDidapatkan"  placeholder="masukan catatan ..." disabled>{{ $topik->fasilitas_diperoleh }}</textarea>
          </div>
        </div>

        <div class="form-group row">
            <label for="inputKuota" class="col-sm-2 col-form-label">KUOTA</label>
            <div class="col-sm-10">
              <input name="inputKuota" type="text" class="form-control" id="inputJudul" value="{{ $topik->kuota }}" placeholder="masukan judul pengumuman ..." disabled>
            </div>
          </div>
      </form>

      @if (Auth::user()->role == 1)
      <form action="/get_topik_detail/acc_topik" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
        @csrf
        <div style="display: none"> 
          <input type="text" name="nip" value="{{ Auth::user()->nip }}">
          <input type="text" name="idTopik" value="{{ $topik->id }}">
          <input type="text" name="judul_topik" value="{{ $topik->judul }}">
          {{-- <input type="" name="acc_topik" value="false"> --}}
        </div>
      
        <br>
        <div class="input-group mb-3">
          
          <input type="file" name="file_path[]" placeholder="Uploud File Kemampuan" multiple style="display: block" id="inputGroupFile02" class="form-control" >
          <label class="input-group-text" for="inputGroupFile02">Uploud File Kemampuan</label>
        </div>
        <button type="submit" class="btn btn-primary" style="display: block">Submit</button>
      
        
      </form>
      @endif

    
</div>




@endsection