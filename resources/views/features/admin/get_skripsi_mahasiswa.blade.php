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

<br> 
 <div class="container">

    
    <div class="row">
        <div class="col">
            <h5>Perlu Di Jadwalkan</h5>
            @foreach ($skripsi as $si )
                <a type="button"  class="row btn btn-outline-success" href="/penjadwalan/{{ $si->id }}">{{ $si->judul }},{{ $si->riwayat_mahasiswa->nip}},{{ $si->riwayat_mahasiswa->user->nama }}
                {{-- <a type="button" class="btn btn-outline-success" href="/penjadwalan/{{ $si->id }}">Jadwalkan</a> --}}
                </a> 
                <hr>
            @endforeach
        </div>

        <div class="col">
            <h5>Terjadwalkan </h5>

            @foreach ($terjadwalkan as $tj)
                <div class="row">
                    {{ $tj->judul }}
                </div>
                <hr>
            @endforeach
        </div>
        
    </div>

    
   




 </div>



 
@endsection