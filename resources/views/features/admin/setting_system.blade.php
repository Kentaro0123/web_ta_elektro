@extends('layouts.main')
@section('container')
<div class="container">
    <h1>Halaman {{ $title }} </h1> 
    <br>
    <br>
</div>
{{-- ditakutkan jika ada sesutu yang mendadak sehigga bisa dibuka lagi sesinya --}}
{{-- {{ dd($setting) }} --}}




<h5>Sesi Rentang Waktu</h5>
<form action="/setting_system" method="POST" data-toggle="validator" >
  @csrf
  <div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="pemilihan_topik_mahasiswa" @if ($setting->pemilihan_topik_mahasiswa ?? 0)
    checked 
    @endif disabled>
    <label class="form-check-label" for="flexCheckDefault">
      Sesi Mahasiswa Melakukan Pemilihan Topik yang di ajukan dosen 
    </label>
</div>
<hr>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" name="pemilihan_topik_dosen" @if ($setting->pemilihan_topik_dosen ?? 0) checked  
    @endif disabled>
    <label class="form-check-label" for="flexCheckChecked">
      Sesi Dosen untuk memilih Mahasiswa terkait Topik yang diajukan
    </label>
</div>
<hr>

{{-- <button type="submit" class="btn btn-primary">Submit</button> --}}

</form>

<br><br>
<form action="/setting_system_tanggal" method="POST" data-toggle="validator">
  @csrf

<div class="form-group">
    <input class="form-control" type="date" value="{{ $setting->pemilihan_topik_mahasiswa_tanggal_mulai ?? ''  }}" id="check2" name="pemilihan_topik_mahasiswa_tanggal_mulai">
    <label class="form-check-label" for="check2">
      Sesi Mahasiswa Melakukan Pemilihan Topik yang di ajukan dosen -> Mulai
    </label>
</div>
<div class="form-group">
    <input class="form-control" type="date" value="{{ $setting->pemilihan_topik_mahasiswa_tanggal_selesai ?? ''  }}" id="check2" name="pemilihan_topik_mahasiswa_tanggal_selesai">
    <label class="form-check-label" for="check2">
      Sesi Mahasiswa Melakukan Pemilihan Topik yang di ajukan dosen -> Selesai
    </label>
</div>

<hr>

<div class="form-group">
  <input class="form-control" type="date" value="{{ $setting->pemilihan_topik_dosen_tanggal_mulai ?? '' }}" id="check1" name="pemilihan_topik_dosen_tanggal_mulai">
  <label class="form-check-label" for="check1">
    Sesi Dosen untuk memilih Mahasiswa terkait Topik yang diajukan -> Mulai
  </label>
</div>
<div class="form-group">
  <input class="form-control" type="date" value="{{ $setting->pemilihan_topik_dosen_tanggal_selesai ?? '' }}" id="check1" name="pemilihan_topik_dosen_tanggal_selesai">
  <label class="form-check-label" for="check1">
    Sesi Dosen untuk memilih Mahasiswa terkait Topik yang diajukan -> Selesai
  </label>
</div>

<button type="submit" class="btn btn-primary">Submit</button>

</form>

<hr>
<hr>
<br>
<h5>Bobot Penilaian </h5>
<form action="/setting_bobot" method="POST">
@csrf
  <div>
    <label for="box1">Pembimbing</label>
    <input type="number" id="box1" class="box" min="0" max="100" name="pembimbing" value="{{ $bobot->pembimbing ?? ''}}">
  </div>
  <div>
    <label for="box2">Penguji</label>
    <input type="number" id="box2" class="box" min="0" max="100" name="penguji" value="{{ $bobot->penguji ?? ''}}">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>

</form>

<script>
  var box1 = document.getElementById('box1');
  var box2 = document.getElementById('box2');

  box1.addEventListener('input', updateTotal);
  box2.addEventListener('input', updateTotal);

  function updateTotal() {
    var total = parseInt(box1.value || 0) + parseInt(box2.value || 0);

    if (total > 100) {
      alert('Total cannot exceed 100!');
      this.value = '';
    }
    if (total < 0) {
      alert('Total cannot be less than 0!');
      this.value = '';
    }
  }
</script>
@endsection