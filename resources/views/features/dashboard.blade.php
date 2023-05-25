@extends('layouts.main')
@section('container')
<div class="container">
    <h1>Halaman {{ $title }} </h1> 
    <br>
    <br>
</div>


@auth

    <div class="container">
      @foreach ($pengumuman as $pg)
      <div class="card">
       <div class="card-header">
         {!! $pg->judul !!}
       </div>
       <div class="card-body">
           {!! $pg->catatan !!}
       </div>
     </div>     
     <br>
      @endforeach
    </div>
        
     


@endauth
@endsection