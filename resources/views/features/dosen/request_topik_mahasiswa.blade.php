@extends('layouts.main')
@section('container')
<div class="container">
    <h1>Halaman {{ $title }} </h1> 
</div>

<ul class="list-group list-group-flush">


    {{-- {{ dd($topik) }} --}}
 @foreach ($topik as $tp )
    
 <?php 
 $count=0;
 foreach ($tp->riwayat_mahasiswa as $key => $value) {
    if ($value->acc_topik == 1 ) {
        $count++;
        
    }
 }
//  dd($count);
$hasil= $tp->kuota - $count ;
  ?>
 <h5>{{ $tp->judul }} || Sisa Kuota : {{ $hasil}} </h5>
    <div class="container">

        @foreach ($tp->riwayat_mahasiswa as  $rm)

        @if ($rm->acc_topik == TRUE)
        <div class="row">
            <div class="col-11">
                <p class="text-primary">Mahasiswa:{{ $rm->user->nip}},{{$rm->user->nama}},TELAH DI ACC</p>
            </div>
          
         
        </div>

        @else
       
        <div class="row">
            <div class="col-7 ">
                <a type="button" class="btn btn-outline-success" href="/request_topik_mahasiswa_download/{{ $rm->id }}">Mahasiswa:{{ $rm->user->nip}},{{$rm->user->nama}}</a>
            </div>
            <div class="col-2 ">
                <a type="button" class="btn btn-outline-success" href="/request_topik_mahasiswa_download/{{ $rm->id }}">Download</a>
            </div>
            <div class="col-2">
                <a type="button" class="btn btn-outline-success" href="/request_topik_mahasiswa_acc/{{ $rm->id }}">ACC</a>
            </div>
        </div>
        @endif
       
    
            <hr>
        @endforeach
    </div>
 @endforeach
</ul>
 
@endsection