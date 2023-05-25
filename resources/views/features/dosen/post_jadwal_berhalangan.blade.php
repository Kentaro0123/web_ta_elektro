@extends('layouts.main')
@section('container')
<div class="container">
    <h1>Halaman {{ $title }} </h1> 
</div>


<br><br>
<h5>Tanggal yang berhalangan</h5>

<br>
 
<form action="/post_jadwal_sidang_berhalangan" method="POST"  >
    @csrf
    <div class="form-group row mt-2">
        <label for="hari_berhalangan" class="col-sm-2 col-form-label">hari berhalangan</label>
        <div class="col-sm-10">
          <input name="hari_berhalangan" type="date" class="form-control" id="hari_berhalangan" value="" placeholder="masukan judul topik ...">
        </div>
    </div>
    <div class="form-group row mt-2">
        <label for="jam_berhalangan" class="col-sm-2 col-form-label">jam berhalangan</label>
        <div class="col-sm-10">
          <input id="jam_berhalangan" list="times" type="time" name="jam_berhalangan"  step="1800" onkeydown="return false">
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary m-3">Submit</button>
</form>


<div>
    <h5>Hapus Jadwal dengan Menekan Jam di Bawah</h5>
    @foreach ($jadwal_sidang_berhalangan as $jsb)
        <a type="button" class="btn btn-danger m-3" href="destroy_jam_berhalangan/{{ $jsb->id }}" >{{ $jsb->hari }} <br>
            {{ $jsb->jam }}</a>
    @endforeach
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
                    <option value="0{{$hour}}:{{$minute}}:00">        
                @endif     
        @else
            <option value="{{$hour}}:00:00">
                @if ($hour != 12)
                    <option value="{{$hour}}:{{$minute}}:00">        
                @endif
        @endif
        @php
            $hour+=1;
        @endphp     
   @endwhile
</datalist>

@endsection