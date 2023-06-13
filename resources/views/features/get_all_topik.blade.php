@extends('layouts.main')
@section('container')


@if ($title == 'ACC')
<style>
    .card {
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
}
</style>

<div class="card  d-flex justify-content-center" style="top:50% ;width:27rem  ;-ms-transform: translateY(-50%);
transform: translateY(-50%);">
    <div class="card-body">
      <h3 class="card-title">!! Selamat !!</h3>
      <h6 class="card-subtitle mb-2 text-muted">Topik Anda terkait: <h5>{{ $acc->topik->judul }}</h5></h6>
      <h6 class="card-subtitle mb-2 text-muted">Judul Anda terkait: 
         {{-- @if ( $acc->skripsi->judul ?? null) --}}
      <h6>{{ $acc->skripsi->judul ?? 'Belum ada judul'  }}</h6>  
        {{-- @else
        Belum Diberikan
      @endif --}}</h6>
      <p class="card-text">Telah di ACC, Silahkan Hubungi Bpk/Ibu: {{ $acc->topik->user->nama }}</p>
      <a href="#" class="card-link btn btn-success">jadwal sidang Proposal =>{{ $jadwal_sidang->hari_pelaksanaan ?? 'tunggu jadwal' }} -> {{ $jadwal_sidang->jam_pelaksanaan  ?? ''}} </a>
      <br><p>Tempat Sidang -> {{ $jadwal_sidang->tempat_sidang  ?? ''}}</p>
      
      {{-- @if ($acc->skripsi->lulus_proposal ?? null)
      <p>Lulus  </p>
          
      @endif --}}
      <p></p>
      <hr>
      <a href="#" class="card-link btn btn-success">jadwal sidang Akhir =>{{ $jadwal_sidang_akhir->hari_pelaksanaan ?? 'tunggu jadwal' }} -> {{ $jadwal_sidang_akhir->jam_pelaksanaan  ?? ''}} </a>
      <p>Tempat Sidang Akhir -> {{ $jadwal_sidang_akhir->tempat_sidang ?? '' }}</p>
      {{-- <a href="#" class="card-link">Another link</a> --}}
    </div>
  </div>
{{-- <div class="d-flex justify-content-center">

</div>  --}}


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
              <?php $count=0 ?>
               @foreach ($tp->riwayat_mahasiswa as $rm )
              <?php $count++ ?>
                   
               @endforeach
              <?php $kuota=$tp->kuota - $count?>
              @if ($kuota <= 0)
                    <a type="button" class="btn btn-outline-success m-1" href="" disabled>Topik:{{ $tp->judul }},Kuota:Habis</a>  

              @else
                    <a type="button" class="btn btn-outline-success m-1" href="/get_topik_detail/{{ $tp->id }}">Topik:{{ $tp->judul }},Kuota:{{ $kuota}}</a>
                      
                  
              @endif

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