@extends('layouts.main')
@section('container')
<div class="container">
    <h1>Halaman {{ $title }} </h1> 
</div>

<style>
hr {
  border-top: 4px solid black;
  height: 10px;
}</style>
<br><br>
<?php 
  function division($dividend, $divisor) {
                if ($divisor == 0) {
                    $result = 0;
                } else {
                    $result = $dividend / $divisor;
                }
                return $result;
            } ?>

<h3>Ketentuan indikator warna</h3>
<ul>
  <li>Dosen Pembimbing Topik : <div class="text-success"><b>Hijau Muda</b> </div></li>
  <li>Dosen Pembimbing Tambahan : <div style="color: rgb(139, 139, 38)"><b>Hijau Tua</b> </div></li>
  <li>Dosen Penguji : <div class="text-danger"> <b>Merah</b></div></li>
</ul>

<div class="container">
    


    <div class="container">
        
   
      <div class="row ">
        @foreach ($skripsi as $item)
          <?php $total_nilai_per_mahasiswa_pembimbing=0 ?>
          <?php $count_pembimbing=1 ?>
          <?php $total_nilai_per_mahasiswa_penguji=0 ?>
          <?php $count_penguji=0 ?>
          
          <h4> {{ $item->judul }}</h4>
          <h4> {{ $item->riwayat_mahasiswa->user->nama }}</h4>

        
       
            <div class="col-md-4">        
                
              <a class="card bg-success text-white btn">
              
                <div class="card-body">
                   
                  <p class="card-text"><b>{{ $item->riwayat_mahasiswa->topik->user->nama }}</b></p>
                  <?php
                    $array_tmp=[]; 
                  ?>
                      @foreach ($item->riwayat_mahasiswa->topik->user->penilaian as $nilai)
                          @if ($nilai->skripsi_id == $item->id)
                            @foreach ($format_penilaian as $fp)
                              @if ($fp->id == $nilai->format_penilaian_id)
                                  <?php 
                                  if (!isset($array_tmp[$fp->id])) {
                                    $array_tmp[$fp->id]=$nilai->point;
                                  }
                                  else {
                                    
                                  $array_tmp[$fp->id]+=$nilai->point;
                                  // echo $fp->id;
                                  // echo $array_tmp[$fp->id];
                                  // echo $array_tmp[$fp->id];
                                    
                                  }
                                  ?>
                              @endif
                              
                            @endforeach
                       
                      {{-- {{ $nilai->point}} {{ $nilai->format_penilaian_id }} --}}
                          
                        @endif
                      @endforeach
                  {{-- {{ sizeof($array_tmp)}} --}}
                  <?php 
                    // echo(sizeof($array_tmp));
                    $total=0;
                    foreach ($array_tmp as $key => $value) {
                        foreach ($format_penilaian as $fp) {
                          if($fp->id ==  $key){
                            $array_tmp[$key] = ($fp->bobot_nilai*$array_tmp[$key] / 100)/ sizeof($fp->format_sub_penilaian);

                          }
                          
                          
                        }
                      //  echo $array_tmp[$key]  ,'  ';
                      // echo "  ";
                      }
                    foreach ($array_tmp as $key => $value) {
                      $total +=$value;
                    }
                      echo $total;
                      $total_nilai_per_mahasiswa_pembimbing +=$total;

                  ?>
                
                  {{-- <p class="card-text"><b>{{ $item->riwayat_mahasiswa->topik->user->penilaian->first() }}</b></p> --}}
                  
                  <input type="number" value="{{ $total }}" style="display: none">
                 
                </div>
              </a>
            </div>
            
            @foreach ($item->dosen_pembimbing_tambahan as $item1)
            
              <div class="col-md-4">        
                    
                <a class="card text-white btn" style="background-color:rgb(139, 139, 38)">
                
                  <div class="card-body">
                    <?php
                      $count_pembimbing++;
                      $array_tmp=[]; 
                    ?>
                    <p class="card-text"> <b>{{ $item1->user->nama }}</b></p>
                    {{-- <p class="card-text">{{ $item1->user->nama }}</p> --}}
                    @foreach ($item1->user->penilaian as $nilai)
                      @if ($nilai->skripsi_id == $item->id)
                        @foreach ($format_penilaian as $fp)
                          @if ($fp->id == $nilai->format_penilaian_id)
                              <?php 
                              if (!isset($array_tmp[$fp->id])) {
                                $array_tmp[$fp->id]=$nilai->point;
                              }
                              else {
                                
                              $array_tmp[$fp->id]+=$nilai->point;
                              // echo $fp->id;
                              // echo $array_tmp[$fp->id];
                              // echo $array_tmp[$fp->id];
                                
                              }
                              ?>
                          @endif
                          
                        @endforeach
                  
                          {{-- {{ $nilai->point}} {{ $nilai->format_penilaian->bobot_nilai}} --}}
                      
                      @endif
                    @endforeach
                    <?php 
                      // echo(sizeof($array_tmp));
                      $total=0;
                      foreach ($array_tmp as $key => $value) {
                          foreach ($format_penilaian as $fp) {
                            if($fp->id ==  $key){
                              $array_tmp[$key] = ($fp->bobot_nilai*$array_tmp[$key] / 100)/ sizeof($fp->format_sub_penilaian);

                            }
                            
                            
                          }
                        //  echo $array_tmp[$key]  ,'  ';
                        // echo "  ";
                        }
                      foreach ($array_tmp as $key => $value) {
                        $total +=$value;
                      }
                        echo $total;
                        $total_nilai_per_mahasiswa_pembimbing +=$total;

                    ?>
                    
                    <input type="number" value="{{ $total }}" style="display: none">
                  
                  </div>
                </a>
              </div>
            @endforeach


            @foreach ($item->jadwal_sidang->dosen_sidang as $item2)
              <div class="col-md-4">        
                    
                <a class="card text-white bg-danger btn" >
                
                  <div class="card-body">
                    <?php
                      $array_tmp=[]; 
                      $count_penguji++;
                    ?>
                    <p class="card-text"> <b>{{ $item2->user->nama }}</b></p>
                    {{-- <p class="card-text">{{ $item->riwayat_mahasiswa->topik->user->nama }}</p> --}}
                    @foreach ($item2->user->penilaian as $nilai)
                      @if ($nilai->skripsi_id == $item->id)
                        @foreach ($format_penilaian as $fp)
                          @if ($fp->id == $nilai->format_penilaian_id)
                              <?php 
                              if (!isset($array_tmp[$fp->id])) {
                                $array_tmp[$fp->id]=$nilai->point;
                              }
                              else {
                                
                              $array_tmp[$fp->id]+=$nilai->point;
                              // echo $fp->id;
                              // echo $array_tmp[$fp->id];
                              // echo $array_tmp[$fp->id];
                                
                              }
                              ?>
                          @endif
                          
                        @endforeach
                  
                          {{-- {{ $nilai->point}} {{ $nilai->format_penilaian->bobot_nilai}} --}}
                      
                      @endif
                    @endforeach
                    <?php 
                      // echo(sizeof($array_tmp));
                      $total=0;
                        foreach ($array_tmp as $key => $value) {
                            foreach ($format_penilaian as $fp) {
                              if($fp->id ==  $key){
                                $array_tmp[$key] = ($fp->bobot_nilai*$array_tmp[$key] / 100)/ sizeof($fp->format_sub_penilaian);

                              }
                              
                              
                            }
                          //  echo $array_tmp[$key]  ,'  ';
                          // echo "  ";
                          }
                        foreach ($array_tmp as $key => $value) {
                          $total +=$value;
                        }
                          echo $total;
                          $total_nilai_per_mahasiswa_penguji +=$total;

                    ?>
                    <input type="number" value="{{ $total }}" style="display: none">
                  </div>
                </a>
              </div>
            @endforeach
          <p></p>
              @if ($item->lulus_proposal == 1)
              
                <a type="button" href="cancel_lulus_proposal/{{$item->id}}" class="btn btn-danger">Cancel</a>
                  
              @else
                <a type="button" href="lulus_proposal/{{$item->id}}" class="btn btn-success">Lulus</a>

              @endif
          <p></p>
         
            <?php 
          
            $Total= ((division($total_nilai_per_mahasiswa_pembimbing,$count_pembimbing))*($bobot->pembimbing/100)) + 
            ((division($total_nilai_per_mahasiswa_penguji,$count_penguji)) )*($bobot->penguji/100) 
           ?>
              <p>TOTAL NILAI = {{  $Total }}</p>
        
         <p></p>
         <p></p>
          <hr>
          <hr>
          
        @endforeach
        
      </div>
   
        
@endsection