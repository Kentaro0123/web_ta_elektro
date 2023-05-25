@extends('layouts.main')
@section('container')
<div class="container">
   <!-- Latest compiled and minified CSS -->
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"> --}}


<meta name="csrf-token" content="{{ csrf_token() }}">
    
   <h1>Halaman {{ $title }}</h1>    
    
  
    
   <div class="row mt-5">
      <form action="/post_penjadwalan_sidang" method="POST">
         @csrf
         <div class="form-group row"> 
            <label for="judulTA" class="col-sm-2 col-form-label">JUDUL TA</label>
            <div class="col-sm-10">
               <input type="text" name="judul_ta" class="form-control" id="judulTA" value="{{ $skripsi->judul }}" placeholder="masukan judul pengumuman ..." readonly>
            </div>
         </div>
         <div class="form-group row" style="display: none"> 
            <label for="idSkripsi" class="col-sm-2 col-form-label" >ID</label>
            <div class="col-sm-10">
               <input type="text" name="id_skripsi" class="form-control" id="idSkripsi" value="{{ $skripsi->id }}" placeholder="masukan judul pengumuman ..." readonly>
            </div>
         </div>
         <div class="form-group row mt-3">
            <label for="namaMahasiswa" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
            <div class="col-sm-10">
               <input type="text" name="nama_mahasiswa" class="form-control" id="namaMahasiswa" value="{{ $skripsi->riwayat_mahasiswa->user->nama }}" placeholder="masukan judul pengumuman ..." readonly>
            </div>
         </div>
         <div class="form-group row mt-3">
            <label for="nipMahasiswa" class="col-sm-2 col-form-label">NIP</label>
            <div class="col-sm-10">
               <input type="text" name="nip_mahasiswa" class="form-control" id="nipMahasiswa" value="{{$skripsi->riwayat_mahasiswa->user->nip}}" placeholder="masukan judul pengumuman ..." readonly>
            </div>
         </div>
         <div class="form-group row mt-3">
            <label for="ipk" class="col-sm-2 col-form-label">IPK</label>
            <div class="col-sm-10">
               <input type="text" name="ipk" class="form-control" id="ipk" value="{{ $skripsi->riwayat_mahasiswa->user->mahasiswa->ipk }}" placeholder="masukan judul pengumuman ..." readonly>
            </div>
         </div>
         <div class="form-group row mt-3">
            <label for="dosenPembimbing" class="col-sm-2 col-form-label">Dosen Pembimbing</label>
            <div class="col-sm-10">
               <input type="text" name="dosen_pembimbing" class="form-control" id="dosenPembimbing" value="{{ $skripsi->riwayat_mahasiswa->topik->user->nama }}" placeholder="masukan judul pengumuman ..." readonly>
            </div>
         </div>

{{-- example --}}
<select id="dosen-picker" class="selectpicker" data-live-search="true">

   @foreach ($dosen as $item)
   <option id="{{ $item->nip }}" ><p id="{{ $item->nip }}">{{ $item->nip }} - {{ $item->nama }}</p></option>
   @endforeach
   
 </select>

 <button id="add" class="btn btn-secondary" type="button">add</button>


  
 <div name="berisi" id="dosen-list" >

 </div>
{{-- example --}}

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js">
</script>
{{-- <script src="jquery-3.6.4.min.js"></script> --}}

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>



         <button id="test" class="btn btn-secondary" type="button">test</button>
         <div class="form-group row mt-3">
            <label for="hariPelaksanaan" class="col-sm-2 col-form-label">Hari Pelaksanaan</label>
            <div class="col-sm-10">
               <input name="hari_pelaksanaan" type="date" class="form-control" id="hariPelaksanaan" value="" placeholder="masukan judul pengumuman ...">
            </div>
         </div>
         <div class="form-group row mt-3">
            <label for="jamPelaksanaan" class="col-sm-2 col-form-label">Jam Pelaksanaan</label>
            <div class="col-sm-10">
               <input name="jam_pelaksanaan" list="times" type="time" class="form-control" id="jamPelaksanaan" value="" placeholder="masukan judul pengumuman ..." onkeydown="return false">
            </div>
         </div>
         <div class="form-group row mt-3">
            <label for="jamSelesai" class="col-sm-2 col-form-label">Jam Selesai</label>
            <div class="col-sm-10">
               <input name="jam_selesai" list="times" type="time" class="form-control" id="jamSelesai" value="" placeholder="masukan judul pengumuman ..." onkeydown="return false">
            </div>
         </div>

         <button type="submit" class="btn btn-primary">Submit</button>
         
      </form>
   </div>
</div>

<datalist id="times">

   @php
   $hour=1;
   $minute=30;
   @endphp
      @while ($hour < 24)
           @if ($hour<10)
               <option value="0{{$hour}}:00:00">
                   @if ($hour != 12)
                       <option value="0{{$hour}}:{{$minute}}:00" >        
                   @endif     
           @else
               <option value="{{$hour}}:00:00">
               {{-- <option value="{{$hour}}:00:00" style="display: none" disabled> --}}
                   {{-- @if ($hour != 12) --}}
                       <option value="{{$hour}}:{{$minute}}:00">        
                   {{-- @endif --}}
           @endif
           @php
               $hour+=1;
           @endphp     
      @endwhile
   </datalist>

   {{-- Script Logika Jam & Dosen --}}
   <script>
      $(document).ready(function(){
        // $("#add").hide();
        var intId=0;
        var array_dosen=[];
        // var dosen_count=[];
  
       
          
           $("#add").click(function(){
              var lastField= $("#dosen-list div");
              var dosen_picker=$("#dosen-picker").val();
              var pattern = /[^ -]*/;
              var id_dosen_picker=dosen_picker.match(pattern);
              
       
  
              if(lastField.length <= 3  &&  !array_dosen["n-"+id_dosen_picker]){
  
                 var value=$("#dosen-picker").val();
                 var id=value.match(pattern);
                 intId= intId+1 ;
                 var fieldWrapper = $("<div class=\"fieldwrapper\" id=\"" + id + "\"/>");
                 var list=$("<input name=\"dosen_penguji["+intId+"]\" class=\"remove\" value=\""+value+"\" readonly>");
                 var removeButton = $("<input type=\"button\" class=\"btn btn-danger m-2\" value=\"X\" />");
                 removeButton.click(function(){
                    var deletethis=$(this).parent()[0].id;
                    delete array_dosen["n-"+deletethis];
                    console.log(deletethis)
                    $(this).parent().remove();
                    
                    reload_dosen_berhalangan()
  
  
                 });
                 fieldWrapper.append(list);
                 fieldWrapper.append(removeButton);
                 $("#dosen-list").append(fieldWrapper);      
  
                 $.ajax({
                 headers: {
                    'X-CSRF-TOKEN': $('meta[name="X-CSRF-Token"]').attr('content')
                       },
                 contentType:'json',
                 dataType: "json",
                 url : '/jadwal_berhalangan_id/{id}',
                 data:{id:id},
                 type : 'GET',
                 success: function(response) {  
                    
                   
                    array_dosen["n-"+id]=response.jsb;     
  
                    
                    // dosen_count["n-"+id]=response;
                   
  
                    console.log(array_dosen);
                    // console.log(response.jsb.length);
                    reload_dosen_berhalangan()
                    
                     
                 },
                 error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.responseText);
                    // console.log(thrownError);
                    },
                 });
              }
              console.log($("#dosen-list")[0].innerHTML)
              
           });
  
           function ajax_array_dosen(id){
              
           }
           $("#hariPelaksanaan").change(
              function(){
                 reload_dosen_berhalangan()
  
              }
  
           )
  
           function reload_dosen_berhalangan(){
             
  
              var date=$("#hariPelaksanaan").val();
              var datelist=$("#times option");
  
              for(const disable in datelist){   
               datelist[disable].disabled=false;
              //  console.log(datelist[disable]);
              }
              // console.log (array_dosen);
              for (const property in array_dosen) {
                 // console.log(`${property}: ${array_dosen[property]}`);
                 // console.log(array_dosen[property][property1][0].hari)
                 for(const property1 in array_dosen[property]){
                    // console.log(`${property1}: ${array_dosen[property][property1][0].hari}`); jangan di hapus
                    
                       if(array_dosen[property][property1].hari == date ){
                          // console.log(array_dosen[property][property1][0].hari);
                          // console.log(array_dosen[property][property1][0].jam);
                          // console.log(datelist[20].value);
                          // datelist.filter(function(index){
                          //    return $(this).attr("value") === date 
                          // }).attr('disabled')
              
                          
                          for(const disable in datelist){
                  
                                if(array_dosen[property][property1].length != 0){
                             
                                   // console.log(array_dosen[property][property1].hari);
                                   if(datelist[disable].value==array_dosen[property][property1].jam){
                                   datelist[disable].disabled=true;
  
                                   console.log(datelist[disable]);
                                   }
                                }
                                
  
                                
                                // console.log(datelist[disable].value)
  
                                
                          }
                         
                       }
  
                    
  
  
                 }
              }
              
              // console.log(date);
           }
          
        
        });
   </script>
{{-- Scipt Logika Jam + 30 Menit --}}
   <script>
      $(document).ready(function(){
         $('#jamPelaksanaan').change(function(){
            var jamPelaksanaan=$('#jamPelaksanaan')[0].value;
            var t = jamPelaksanaan.split(/[:]/);
            var jam_akhir= new Date();
            jam_akhir.setHours(t[0])
            jam_akhir.setMinutes(parseInt(t[1])+30)
            jam_akhir.setSeconds(0)
           
            // var diff=30;
            // var newDateObj = new Date(oldDateObj.getTime() + diff*60000)
            $('#jamSelesai')[0].value=jam_akhir.toLocaleTimeString('it-IT');
            console.log(jam_akhir.toLocaleTimeString('it-IT'));
         })
      });
   </script>
  

@endsection