@extends('layouts.main')
@section('container')
<div class="container">
    <h1>Halaman {{ $title }} </h1> 
    <br>
    <br>
</div>
{{-- ditakutkan jika ada sesutu yang mendadak sehigga bisa dibuka lagi sesinya --}}
{{-- {{ dd($setting) }} --}}
@if ($status == 0)

<form action="/setting_system" method="POST" data-toggle="validator">
  @csrf
  <div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="check1" name="pemberian_topik_dosen">
    <label class="form-check-label" for="check1">
      Pemberian Topik oleh Dosen
    </label>
</div>
<hr>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="check2" name="pemilihan_topik_mahasiswa">
    <label class="form-check-label" for="check2">
      Pemilihan Topik oleh Mahasiswa
    </label>
</div>
<button type="submit" class="btn btn-primary">Submit</button>

</form>

@else
<form action="/setting_system" method="POST" data-toggle="validator" >
  @csrf

  <div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" name="pemberian_topik_dosen" @if ($setting->pemberian_topik_dosen) checked  
    @endif>
    <label class="form-check-label" for="flexCheckChecked">
      Pemberian Topik oleh Dosen
    </label>
</div>
<hr>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="pemilihan_topik_mahasiswa" @if ($setting->pemilihan_topik_mahasiswa)
    checked
    @endif>
    <label class="form-check-label" for="flexCheckDefault">
      Pemilihan Topik oleh Mahasiswa
    </label>
</div>
<button type="submit" class="btn btn-primary">Submit</button>

</form>
@endif




@endsection