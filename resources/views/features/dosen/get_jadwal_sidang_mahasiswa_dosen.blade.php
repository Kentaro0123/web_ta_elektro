@extends('layouts.main')
@section('container')
<div class="container">
    <h1>Halaman {{ $title }} </h1> 
</div>

<ul class="list-group list-group-flush">



    
 <div class="container">
    <div class="row">
        <div class="col">
            <h5>Sebagai Penguji</h5>
           
                    @foreach ($jadwalSidangMahasiswaDosen as $key => $jsmd)
                         
                        <div>
                            Hari:{{ $jsmd->jadwal_sidang->hari_pelaksanaan }} <br>
                            Jam:{{ $jsmd->jadwal_sidang->jam_pelaksanaan}} <br>
                            Skripsi:{{ $jsmd->jadwal_sidang->skripsi->judul }}
                        </div>
                           

                        <hr>
           
                    
                    @endforeach
           

                
               
           
            
        </div>
        <div class="col">

            <h5>Sebagai Pembimbing</h5>

            

                @foreach ($topikDosenSidang as $key => $tds)

                    <h6>{{ $tds->judul }}</h6>
                    @foreach ($tds->riwayat_mahasiswa as $rm )

                        @if(isset($rm->skripsi->jadwal_sidang->hari_pelaksanaan))
                            <div class="bg-success text-white">
                                Hari:{{ $rm->skripsi->jadwal_sidang->hari_pelaksanaan}} <br>
                                Jam:{{ $rm->skripsi->jadwal_sidang->jam_pelaksanaan}} <br>
                                Skripsi:{{ $rm->skripsi->judul}}<br>
                                Mahasiswa:{{ $rm->user->nama }}
                            </div>
                            <hr>
                        
                        @elseif ($rm->acc_judul)
                            <div class="bg-danger text-white">
                                Hari:-<br>
                                Jam:-<br>
                                Skripsi:{{ $rm->skripsi->judul}}<br>
                                Mahasiswa:{{ $rm->user->nama }}
                            </div>
                            <hr>
                    
                        @elseif ($rm->acc_topik)

                        <div class="bg-warning text-dark">
                            Hari:- <br>
                            Jam:- <br>
                            Skripsi:-<br>
                            Mahasiswa:{{ $rm->user->nama }}
                        </div>
                        
                    
                        @endif
                    
                        
                    @endforeach
            

            
                @endforeach
            

        </div>
    </div>
 </div>


</ul>

@endsection