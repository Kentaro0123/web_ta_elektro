@extends('layouts.main')
@section('container')

<div class="container">

   <h1>Halaman {{ $title }}</h1>  
   <div class="row mt-5">

      @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
         {{ session('success') }}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>     
      @endif
      <form action="/register" method="post">
         @csrf
   
   
         <div class="form-group row mt-3">
            <label for="nip" class="col-sm-2 col-form-label">NIP</label>
            <div class="col-sm-10">
               <input name="nip" type="text" class="form-control @error('nip')is-invalid @enderror" id="nip" placeholder="nip..." autocomplete="false" >
            @error('nip')
            <div class="invalid-feedback">
               {{ $message }}
            </div>
            @enderror
            
            </div>
         </div>
   
         <div class="form-group row mt-3">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
               <input name="nama" type="text" class="form-control @error('nama')is-invalid @enderror" id="nama" value="" placeholder="nama..." autocomplete="false"  >
            @error('nama')
            <div class="invalid-feedback">
               {{ $message }}
            </div>
            @enderror
            
            </div>
         </div>
         <div class="form-group row mt-3">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
               <input name="email" type="email" class="form-control @error('email')is-invalid @enderror" id="email" value="" placeholder="email..."   onchange="emailToNip()" autofocus >
            @error('email')
            <div class="invalid-feedback">
               {{ $message }}
            </div>
            @enderror
            
            </div>
         </div>
          
           <div class="form-group row mt-3">
              <label for="password" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                 <input name="password" type="password" class="form-control @error('password')is-invalid @enderror" id="password" value="123" placeholder="password..."  >
                 @error('password')
                 <div class="invalid-feedback">
                    {{ $message }}
                 </div>
                 @enderror
               </div>
           </div> 
     
           <div id="mahasiswa" >
            <br>  
            <div class="form-group row mt-3" style="display: none">
               <label for="user_nip" class="col-sm-2 col-form-label">User NIP</label>
                  <div class="col-sm-10">
                   <input name="user_nip" type="text" class="form-control @error('user_nip')is-invalid @enderror" id="user_nip" value="" placeholder="user_nip..." autocomplete="off"  >
                     @error('user_nip')
                        <div class="invalid-feedback">
                      {{ $message }}
                        </div>
                     @enderror
               
                  </div>
               </div>
      
               <div class="form-group row mt-3">
                  <label for="konsentrasi" class="col-sm-2 col-form-label">Konsentrasi</label>
                     <div class="col-sm-10">
                      <input name="konsentrasi" type="text" class="form-control @error('konsentrasi')is-invalid @enderror" id="konsentrasi" value="" placeholder="konsentrasi..." autocomplete="false"  >
                        @error('konsentrasi')
                           <div class="invalid-feedback">
                         {{ $message }}
                           </div>
                        @enderror
                  
                     </div>
                  </div>
      
                  
               <div class="form-group row mt-3">
                  <label for="ipk" class="col-sm-2 col-form-label">IPK</label>
                     <div class="col-sm-10">
                      <input name="ipk" type="number" step="0.01" class="form-control @error('ipk')is-invalid @enderror" id="ipk" value="" placeholder="ipk..." autocomplete="false"  >
                        @error('ipk')
                           <div class="invalid-feedback">
                         {{ $message }}
                           </div>
                        @enderror
                  
                     </div>
                  </div>
      
           </div>
            
           <div class="form-group row mt-3">
            <label for="role" class="col-sm-2 col-form-label">Role </label>
            <select class="form-select" aria-label="Default select example" id="role" name="role"  onchange="isMahasiswa()">
               <option selected value="1">Mahasiswa</option>
               <option value="2">Dosen</option>
            </select>
            @error('role')
            <div class="invalid-feedback">
               {{ $message }}
            </div>
            @enderror
            </div> 
   
            
            <br><br> 
           <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      
        
   
        {{-- <div class="form-group row mt-3">
         <label for="nrp" class="col-sm-2 col-form-label">NRP</label>
         <div class="col-sm-10">
            <input type="text" class="form-control" id="nrp" value="" placeholder="nrp..." >
         </div> --}}
      </div>
        
    </div>
   
</div>

<h1>Halaman {{ $title }}</h1>    

 <script>
   function emailToNip(){
      var emailField = document.getElementById('email');
      var nipField = document.getElementById('nip');
      var user_nip = document.getElementById('user_nip');
      let text = emailField.value;
      let pattern = /[^@]*/;
     
      let result=text.match(pattern)

      nipField.value=result;
      user_nip.value=result;
   }
   function isMahasiswa() {
 
   $selected=document.getElementById("role").value;
   var mahasiswa=document.getElementById('mahasiswa');
  if ($selected == 1){
    mahasiswa.style.display = "block";
  } else {
     mahasiswa.style.display = "none";
  }
   }
 </script>


@endsection