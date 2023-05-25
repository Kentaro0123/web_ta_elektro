@extends('layouts.main')
@section('container')
<div class="container">
    <h1>Halaman {{ $title }} </h1> 
    <br>
    <br>

</div>




 @foreach ($user as $us )
    
    @foreach ($us->topik as $tp )
    <a type="button" class="btn btn-outline-success" href="/get_topik_detail/{{ $tp->id }}">Topik:{{ $tp->judul }}  <br>
        Kuota:{{ $tp->kuota}}</a>
    {{-- <li class="list-group-item">{{ $tp->judul }},{{ $tp->kuota}}</li> --}}
    @endforeach
     
 @endforeach

 
@endsection