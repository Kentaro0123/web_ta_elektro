@extends('layouts.main')
@section('container')

<div class="container">
    <h1>Halaman {{ $title }} </h1> 
</div>
<br> 
<div class="row">
@foreach ($skripsi as $sk)


    <div class="col-3 m-1">
        <div class="card" >
            <div class="card-header">
              Judul Topik <h5 style="color:darkgreen">{{ $sk->judul }}</h5> 
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><i>Nama Mahasiswa :</i> <br> <b>{{ $sk->riwayat_mahasiswa->user->nama }}</b></li>
              <li class="list-group-item"><i>Pembimbing :</i> <br><b>{{ $sk->riwayat_mahasiswa->topik->user->nama }}</b> </li>
              @if ($sk->dosen_pembimbing_tambahan[0] ?? null)
                
                @foreach ($sk->dosen_pembimbing_tambahan as $item)
                <li class="list-group-item">  <i style="color: blue">Pembimbing-Tambahan :</i> <br><b>{{  $item->user->nama }}</b>  <a class="btn btn-primary" href="/destroy_skripsi_dosen_pembimbing_tambahan/{{ $item->id}}">x</a></li>
                @endforeach
            
              @endif

              <form action="/post_skripsi_dosen_pembimbing_tambahan" method="post">
                @csrf
                <li class="list-group-item"><select id="dosen-picker" class="selectpicker dosen-picker" data-live-search="true" name='dosen_tambahan'>

                    @foreach ($dosen as $item)
                    <option id="{{ $item->nip }}" ><p id="{{ $item->nip }}">{{ $item->nip }}-{{ $item->nama }}</p></option>
                    @endforeach
                    <input name="id_skripsi" style="display: none" value="{{ $sk->id }}">
                  </select><button type="submit" class="btn btn-primary" href="#" role="button"> Tambah Pembimbing</button></li>
                  
            </form>
              
              {{-- <li class="list-group-item">Vestibulum at eros</li> --}}
            </ul>
          </div>
    </div>


@endforeach
</div>
<script>
    $(document).ready(function()
    {
        $('.dosen-picker').selectize({
    sortField: 'text'
 });
    })

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
@endsection