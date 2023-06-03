@extends('layouts.main')
@section('container')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="container">
        <h1>Halaman {{ $title }} </h1> 
    </div>
{{-- <button id="add_main"> Tambah Faktor</button>

<form action="format_penilaian" method="POST">
    @csrf
    <div class="container" id="table">


    </div>

    <button type="submit" class="btn btn-success">SUBMIT</button>
</form> --}}

<form action="format_penilaian_akhir" method="POST">
    @csrf
<div class="container mt-4">
    <div class="form-group">
      <input type="text" id="judul-nilai-input" class="form-control" placeholder="Masukkan judul nilai">
      <input type="number" id="judul-nilai-angka-input" class="form-control mt-2" placeholder="Masukkan bobot">
    </div>
    <a id="tambah-judul-nilai" class="btn btn-primary">Tambah Judul Nilai</a>

    <table class="table mt-4">
      <thead>
        <tr>
          <th>Judul Nilai</th>
          <th>Bobot</th>
          <th>Judul Sub Nilai</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="container"></tbody>
    </table>
  </div>
  <button type="submit" class="btn btn-success" id="submit-form">SUBMIT</button>
</form>
  <script>
$(document).ready(function() {
  var judulNilaiCount = 0; // menghitung jumlah judul nilai

  // Fungsi untuk menghitung total bobot
  function hitungTotalBobot() {
    var totalBobot = 0;
    $('input[name^="bobot_nilai"]').each(function() {
      var bobot = parseInt($(this).val());
      if (!isNaN(bobot)) {
        totalBobot += bobot;
      }
    });
    return totalBobot;
  }

  // Fungsi untuk menambahkan judul nilai
  function tambahJudulNilai(judulNilai, bobotNilai) {
    var totalBobot = hitungTotalBobot() + parseInt(bobotNilai);
    if (totalBobot > 100) {
      alert('Total bobot melebihi 100. Tidak dapat menambahkan judul nilai.');
      return;
    }

    judulNilaiCount++;
    var judulNilaiId = 'judul-nilai-' + judulNilaiCount;
    var html = '<tr data-judul-nilai-id="' + judulNilaiId + '">' +
      '<td><input type="text" name="judul_nilai[' + judulNilaiCount + ']" value="' + judulNilai + '"></td>' +
      '<td><input type="number" name="bobot_nilai[' + judulNilaiCount + ']" value="' + bobotNilai + '"></td>' +
      '<td>' +
      '<div class="judul-sub-nilai-container" data-judul-nilai-id="' + judulNilaiId + '"></div>' +
      '<div class="input-group mb-3">' +
      '<input type="text" class="form-control input-judul-sub-nilai" placeholder="Masukkan judul sub nilai">' +
      '<div class="input-group-append">' +
      '<button type="button" class="btn btn-success tambah-sub-judul" data-judul-nilai-id="' + judulNilaiId + '">Tambah</button>' +
      '</div>' +
      '</div>' +
      '</td>' +
      '<td>' +
      '<a href="#" class="btn btn-danger hapus-judul" data-judul-nilai-id="' + judulNilaiId + '">Hapus</a>' +
      '</td>' +
      '</tr>';

    $('#container').append(html);
  }

  // Fungsi untuk menambahkan judul sub nilai
  function tambahJudulSubNilai(judulNilaiId, judulSubNilai) {
    var judulSubNilaiContainer = $('div[data-judul-nilai-id="' + judulNilaiId + '"]');
    var judulSubNilaiCount = judulSubNilaiContainer.children().length;
    var html = '<div class="judul-sub-nilai">' +
      '<input type="text" name="judul_sub_nilai[' + judulNilaiCount + '][' + judulSubNilaiCount + ']" value="' + judulSubNilai + '"> ' +
      '<a href="#" class="btn btn-danger hapus-sub-judul" data-judul-sub-nilai-id="' + judulNilaiCount + '-' + judulSubNilaiCount + '">Hapus</a>' +
      '</div>';

    judulSubNilaiContainer.append(html);
  }

  // Fungsi untuk menghapus judul nilai beserta sub nilai yang terkait
  function hapusJudulNilai(judulNilaiId) {
    $('tr[data-judul-nilai-id="' + judulNilaiId + '"]').remove();
  }

  // Fungsi untuk menghapus judul sub nilai
  function hapusJudulSubNilai(judulSubNilaiId) {
    $('a[data-judul-sub-nilai-id="' + judulSubNilaiId + '"]').parent().remove();
  }

  // Tambahkan event listener untuk tombol "Tambah Judul Nilai"
  $('#tambah-judul-nilai').click(function() {
    var judulNilai = $('#judul-nilai-input').val();
    var bobotNilai = $('#judul-nilai-angka-input').val();
    if (judulNilai && bobotNilai) {
      tambahJudulNilai(judulNilai, bobotNilai);
      $('#judul-nilai-input').val('');
      $('#judul-nilai-angka-input').val('');
    }
  });

  // Tambahkan event listener untuk tombol "Hapus Judul"
  $(document).on('click', '.hapus-judul', function() {
    var judulNilaiId = $(this).data('judul-nilai-id');
    hapusJudulNilai(judulNilaiId);
  });

  // Tambahkan event listener untuk tombol "Tambah Judul Sub Nilai"
  $(document).on('click', '.tambah-sub-judul', function() {
    var judulNilaiId = $(this).data('judul-nilai-id');
    var judulSubNilai = $(this).closest('.input-group').find('.input-judul-sub-nilai').val();

    if (judulSubNilai) {
      tambahJudulSubNilai(judulNilaiId, judulSubNilai);
      $(this).closest('.input-group').find('.input-judul-sub-nilai').val('');
    }
  });

  // Tambahkan event listener untuk tombol "Hapus Sub Judul"
  $(document).on('click', '.hapus-sub-judul', function() {
    var judulSubNilaiId = $(this).data('judul-sub-nilai-id');
    hapusJudulSubNilai(judulSubNilaiId);
  });

  // Validasi saat mengubah bobot nilai
  $(document).on('change', 'input[name^="bobot_nilai"]', function() {
    var totalBobot = hitungTotalBobot();
    if (totalBobot > 100) {
      alert('Total bobot melebihi 100. Silakan ubah bobot nilai yang lain.');
      $(this).val('100'); // Set nilai maksimum menjadi 100
    }
  });

    // Event listener untuk tombol "Submit"
    $('#submit-form').click(function() {
    var totalBobot = hitungTotalBobot();
    if (totalBobot < 100) {
      alert('Total bobot belum mencapai 100. Silakan tambahkan bobot nilai yang lain.');
      return false; // Menghentikan pengiriman formulir
    }

    // Lanjutkan pengiriman formulir
    alert('Formulir berhasil dikirim.');
    // ... lakukan tindakan pengiriman formulir lainnya ...
  });
});
  </script>

<script>
    // Function to fade out the success message after 3 seconds
    setTimeout(function() {
        $('#success-message').fadeOut('slow', function() {
            $(this).remove();
        });
    }, 3000);
</script>
@endsection


