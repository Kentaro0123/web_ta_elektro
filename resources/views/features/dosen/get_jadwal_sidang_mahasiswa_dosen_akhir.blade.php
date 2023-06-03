@extends('layouts.main')
@section('container')
<div class="container">
    <h1>Halaman {{ $title }} </h1> 
</div>
<br>
<ul class="list-group list-group-flush">



    
 <div class="container">
    <div class="row">
        <div class="col">
            <h5>Sebagai Penguji</h5>
                       
                   
                    @foreach ($jadwalSidangMahasiswaDosen as $key => $jsmd)
                         
                        <div>
                            {{-- @if ($jsmd->jadwal_sidang_akhir->hari_pelaksanaan ?? 0) --}}
                            Hari:{{ $jsmd->jadwal_sidang_akhir->hari_pelaksanaan }} <br>
                            Jam:{{ $jsmd->jadwal_sidang_akhir->jam_pelaksanaan }} <br>
                            Pelaksanaan:{{ $jsmd->jadwal_sidang_akhir->tempat_sidang }} <br>
                            Skripsi:{{ $jsmd->jadwal_sidang_akhir->skripsi->judul  }}
                            {{-- {{ dd($jsmd->penilaian); }} --}}
                            
                                <?php $yes=false ?>
                                @foreach ($jsmd->penilaian  as $item)
                                    @if ($item->skripsi_id == $jsmd->jadwal_sidang_akhir->skripsi->id) 
                                      <?php $yes=true ?>
                                    @endif
                                @endforeach
                                    @if($yes)
                                        <a href="" class="btn btn-warning">Edit</a>
                                        
                                                
                                        @else
                                        <a href="nilai_sidang_akhir\{{ $jsmd->jadwal_sidang_akhir->skripsi->id }}" class="btn btn-success">Nilai</a>  

                                        @endif
                            
                            {{-- @endif --}}
                        

                            
                        </div>
                           

                        <hr>
           
                    
                    @endforeach
           

                
               
           
            
        </div>
        <div class="col">

            <h5>Sebagai Pembimbing</h5>

            

                @foreach ($topikDosenSidang as $key => $tds)

                    <h6>{{ $tds->judul }}</h6>
                    @foreach ($tds->riwayat_mahasiswa as $rm )

                        @if(isset($rm->skripsi->jadwal_sidang_akhir->hari_pelaksanaan))
                            <div class="bg-success text-white">
                                Hari:{{ $rm->skripsi->jadwal_sidang_akhir->hari_pelaksanaan}} <br>
                                Jam:{{ $rm->skripsi->jadwal_sidang_akhir->jam_pelaksanaan}} <br>
                                Pelaksanaan:{{ $rm->skripsi->jadwal_sidang_akhir->tempat_sidang}} <br>
                                Skripsi:{{ $rm->skripsi->judul}}<br>
                                Mahasiswa:{{ $rm->user->nama }}
                            </div>
                            <br>

                            {{-- @if ($rm->skripsi->penilaian->first()->skripsi_id ?? 0)
                                @if (!is_null($rm->skripsi->penilaian))
                         
                                <a href="" class="btn btn-warning">Edit</a>
                                @endif     
                                        
                            @else
                            <a href="nilai_proposal\{{ $rm->skripsi->id }}" class="btn btn-success">Nilai</a>  
                            @endif --}}
                            
                                        
                                            <?php $yes=false ?>
                                                    @foreach ($rm->topik->user->penilaian_akhir as $item)
                                                        @if ($item->skripsi_id == $rm->skripsi->jadwal_sidang_akhir->skripsi->id) 
                                                        <?php $yes=true ?>
                                                        @endif
                                                    @endforeach
                                                    @if($yes)
                                                        <a href="" class="btn btn-warning">Edit</a>
                                                    
                                                            
                                                    @else
                                                        <a href="nilai_sidang_akhir\{{ $rm->skripsi->id }}" class="btn btn-success">Nilai</a>    
                                                    @endif

                                       
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
        <div class="col">
            <h5>Sebagai Pembimbing Tambahan</h5>
            @if ($dosenPembimbingTambahan->first()->skripsi->jadwal_sidang_akhir->hari_pelaksanaan ?? 0)
                @foreach ($dosenPembimbingTambahan as $item)
                    Hari:{{ $item->skripsi->jadwal_sidang_akhir->hari_pelaksanaan }} <br>
                    Jam:{{ $item->skripsi->jadwal_sidang_akhir->jam_pelaksanaan}} <br>
                    Pelaksanaan:{{ $item->skripsi->jadwal_sidang_akhir->tempat_sidang}} <br>
                    Skripsi:{{ $item->skripsi->jadwal_sidang_akhir->skripsi->judul }}
                    <br>
                    {{-- @if ($item->skripsi->penilaian->first()->skripsi_id ?? 0)
                        @if (!is_null($item->skripsi->penilaian))
                        {{ $jsmd->jadwal_sidang->skripsi->penilaian->first()->skripsi_id}}
                
                    
                        {{ $jsmd->user->penilaian->first()->id }}
                        <a href="" class="btn btn-warning">Edit</a>
                        @endif     
                            
                    @else
                    <a href="nilai_proposal\{{ $item->skripsi->id }}" class="btn btn-success">Nilai</a>  
                    @endif --}}

                   
                            <?php $yes=false ?>
                            @foreach ($item->user->penilaian_akhir as $item1)
                                @if ($item1->skripsi_id == $item->skripsi->jadwal_sidang_akhir->skripsi->id) 
                                <?php $yes=true ?>
                                @endif
                            @endforeach
                                @if($yes)
                                    <a href="" class="btn btn-warning">Edit</a>
                                
                                        
                                @else
                                    <a href="nilai_sidang_akhir\{{ $item->skripsi->id }}" class="btn btn-success">Nilai</a>    
                                @endif

                    
                    <hr>
                @endforeach
            @endif
               
        </div>
    </div>
 </div>


</ul>

@endsection