@extends('layouts.main')
@section('container')


@if ($title == 'ACC')

<h2>!! Selamat !! Topik Anda terkait:</h2> 
<h3> {{ $acc->topik->judul }}</h3> 
<h2>Telah di ACC, Silahkan Hubungi Bpk/Ibu: {{ $acc->topik->user->nama }}</h2>       
<h3> {{ $jadwal_sidang }}</h3>
@else


<div class="container">
    
    <h1>Halaman {{ $title }} </h1> 
</div>


 
{{-- 
<ul class="list-group list-group-flush"> --}}

    <br>
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
            <h3>TOPIK TERSEDIA</h3>
            @foreach ($user as $us )
        


            @if ($us->role == 2)
            
            <h5>{{ $us->nama }}</h5>
           
            @foreach ($us->topik as $tp )
            <a type="button" class="btn btn-outline-success m-1" href="/get_topik_detail/{{ $tp->id }}">Topik:{{ $tp->judul }},Kuota:{{ $tp->kuota}}</a>  
            @endforeach
            
            <br> <br>
            @endif

        @endforeach
        </div>

        <div class="col">
            
            <h3>TOPIK TERPILIH</h3>
            <br>
            @foreach ($added_topik as $at )
            <div class="panel panel-default">
                <div id="destroy_topik" class="panel-body">Topik:{{ $at->judul_topik }} <a id="destroy_topik" type="button" class="panel-body btn btn-outline-success" href="/get_riwayat_destroy_id/{{ $at->id }}">X</a></div>
            </div>
            <br>
           
                
            @endforeach
        </div>
    </div>
</div>
{{-- </ul> --}}

@endif

 
@endsection