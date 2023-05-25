@extends('layouts.main')
@section('container')
<div class="container">

    <div class="row fw-bold">
   <h1> Halaman {{ $title }}</h1>
    </div>
    
    
    <div class="row mt-5">
        <form method="post" action="/post_pengumuman" >
          @csrf
            <div class="form-group row">
              <label for="inputJudulPengumuman" class="col-sm-2 col-form-label">JUDUL PENGUMUMAN</label>
              <div class="col-sm-10">
                <input name="inputJudulPengumuman" type="text" class="form-control" id="inputJudul" value="" placeholder="masukan judul pengumuman ...">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputCatatanPengumuman" class="col-sm-2 col-form-label">CATATAN</label>
              <div class="col-sm-10">
                <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

                <script>
                tinymce.init({
                    selector: 'textarea#inputCatatanPengumuman',
                    skin: 'bootstrap',
                    plugins: 'lists, link, image, media',
                    toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
                    menubar: false,
                });
                </script>
                <textarea name="inputCatatanPengumuman" rows=20 class="form-control" id="inputCatatanPengumuman" placeholder="masukan catatan ..."></textarea>
              </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
   

</div>

@endsection