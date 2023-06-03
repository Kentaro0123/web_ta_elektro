@extends('layouts.main')
@section('container')
<form action="/post_nilai_akhir" method="POST">
@csrf
    <div class="container">
        <h2>Form Skripsi</h2>
       
          <div class="form-group">
            <label for="judul">Judul Skripsi:</label>
            <input type="text" class="form-control" id="judul" placeholder="Masukkan judul skripsi" readonly value="{{ $skripsi->judul }}">
          </div>
          <div class="form-group">
            <label for="nama">Nama Mahasiswa:</label>
            <input type="text" class="form-control" id="nama" placeholder="Masukkan nama mahasiswa" readonly value="{{ $skripsi->riwayat_mahasiswa->user->nama }}">
          </div>
          {{-- <div class="form-group" style="display: none">
            <label for="id">id</label>
            <input type="text" class="form-control" id="id" placeholder="Masukkan nama mahasiswa" readonly value="{{ $skripsi->id}}">
          </div> --}}
          <div class="form-group" style="display: none">
            <label for="id">id</label>
            <input type="text" class="form-control" id="id" placeholder="Masukkan nama mahasiswa" readonly value="{{ $skripsi->id}}" name="id">
          </div>
        
    </div>

    <table class="table">
        <thead>
          <tr>
            <th>Penilaian</th>
            <th>Bobot</th>
            <th>Sub Penilaian</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($format_penilaian as $key => $col) 
    
            
                <tr>
                    <td>
                    <input type="text" class="form-control" name="judul_nilai[{{ $key }}]" value="{{ $col->judul_nilai }}" readonly>
                    <input type="text" class="form-control" name="id_nilai[{{ $key }}]" value="{{ $col->id }}" readonly style="display: none">
                    </td>
                    <td>
                    <div class="form-group">
                        <input type="text" class="form-control" name="bobot_nilai[{{ $key }}]" value="{{ $col->bobot_nilai }}" readonly>
                        
                    </div>
                    </td>
                    <td>
                        @foreach ($col->format_sub_penilaian_akhir as $key1 => $item)
                            <div class="form-group">
                                <label for="sub_penilaian{{ $key }}_{{ $key1 }}">{{ $item->judul_sub_format }}</label>
                                <input type="number" class="form-control" id="sub_penilaian{{ $key }}_{{ $key1 }}" name="point[{{ $key }}][{{ $key1 }}]" placeholder="masukan nilai antar 1-100" oninput="validateSubPenilaian(this)" required>
                                <input type="text" class="form-control" name="id_sub_nilai[{{ $key }}][{{ $key1 }}]" value="{{ $item->id }}" readonly style="display: none">
                                
                            </div>
                         
                        @endforeach

                    </td>
                </tr>
            @endforeach
          <!-- Tambahkan baris di atas sesuai kebutuhan -->
        </tbody>
    </table>

    <button type="submit" class="btn btn-success" >SUBMIT</button>

</form>
<script>
    function validateSubPenilaian(input) {
      var value = parseInt(input.value);
      if (isNaN(value) || value < 0 || value > 100) {
        input.value = ''; // Mengosongkan nilai jika tidak valid
        input.classList.add('is-invalid'); // Menandai input sebagai tidak valid
      } else {
        input.classList.remove('is-invalid'); // Menghapus tanda tidak valid jika valid
      }
    }
  </script>

      
@endsection