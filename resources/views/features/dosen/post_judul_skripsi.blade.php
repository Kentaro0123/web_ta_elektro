@extends('layouts.main')
@section('container')
<div class="container">
    <h1>Halaman {{ $title }} </h1> 
</div>

<ul class="list-group list-group-flush">


 @foreach ($topik as $tp )

    <h5> {{ $tp->judul}}</h5>

    @foreach ($tp->riwayat_mahasiswa as $rm)
    
   
       @if ($rm->acc_judul == false)
        <form action="judul_skripsi" class="form-inline" method="POST">
            @csrf
            {{ $rm->user->nama }} / {{ $rm->nip }} /
            <input name="judul_skripsi" type="text" placeholder="Masukan Judul">
            <input name="id_riwayat_mahasiswa" value="{{ $rm->id }}" style="display: none">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
       @else

       <form action="judul_skripsi" class="form-inline" method="POST">
        <input type="hidden" name="_method" value="PUT">
         <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        {{ $rm->user->nama }} / {{ $rm->nip }} /
        <input name="judul_skripsi" type="text" value="{{  $rm->skripsi->judul }}" placeholder="Masukan Judul">
        <input name="id_riwayat_mahasiswa" value="{{ $rm->id }}" style="display: none">
        <input type="hidden" name="id_skripsi" value="{{ $rm->skripsi->id }}">
        <button type="submit" class="btn btn-warning">Edit</button>

       
        @if (session()->has("success_change_$rm->id"))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
         {{ session("success_change_$rm->id") }}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>     
      @endif
    </form>
       {{-- <p>{{ $rm->user->nama }} / {{ $rm->nip }} / {{ $rm->skripsi->judul }}</p> --}}
       @endif
       
   
        
    @endforeach
    {{-- <li class="list-group-item">{{ $tp->judul }},{{ $tp->kuota}}</li> --}}     
 @endforeach
</ul>
 
@endsection