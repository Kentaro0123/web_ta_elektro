@extends('layouts.main')
@section('container')
<div class="container">
    <h1>Halaman {{ $title }} </h1> 
</div>
{{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
{{-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script> --}}

<style>
.filterable {
    margin-top: 15px;
}
.filterable .panel-heading .pull-right {
    margin-top: 20px;
}
.filterable .filters input[disabled] {
    background-color: transparent;
    border: none;
    cursor: auto;
    box-shadow: none;
    padding: 0;
    height: auto;
}
.filterable .filters input[disabled]::-webkit-input-placeholder {
    color: #333;
}
.filterable .filters input[disabled]::-moz-placeholder {
    color: #333;
}
.filterable .filters input[disabled]:-ms-input-placeholder {
    color: #333;
}

</style>
{{-- <link href="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table.min.css" rel="stylesheet">

<script src="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.21.4/dist/extensions/print/bootstrap-table-print.min.js"></script> --}}

<style>
    @media print{
        /* hide every other element */
        body * {
            visibility: hidden;
        }
        .print-container, .print-container * {
            visibility: visible;
        }
        .print-container{
            position: absolute;
            left: 0;
            top:0; 
        }
    }
    ::placeholder{
        font-weight: 700;
    }
</style>
<button onclick="window.print()">Print</button>
    <div class="row " >
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Users</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter btn-info"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>
            </div>
            {{-- <button onclick="printData()">print</button> --}}
            <table class="table print-container"   >
                <thead>
                    <tr class="filters ">
                        {{-- <th><input type="text" class="form-control" placeholder="#" disabled></th> --}}
                        {{-- <th><input type="text" class="form-control" placeholder="NRP" disabled></th> --}}
                        <th><input type="text" class="form-control" placeholder="NRP-Nama" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Topik - SubTopik" disabled></th>
                        {{-- <th><input type="text" class="form-control" placeholder="Skripsi" disabled></th> --}}
                        <th><input type="text" class="form-control" placeholder="Dosen Pembimbing 1" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Dosen Pembimbing Tambahan" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Dosen Penguji" disabled></th>
                        <th><input type="text" class="form-control" placeholder="tgl sidang Proposal" disabled></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)

                    <tr>
                        <td>{{ $user->nip }}-{{ $user->nama }}</td>
                        <td>
                            @if ( !isset($user->riwayat_mahasiswa->first()->acc_topik) )
                            X
                            @else
                                @if ($user->riwayat_mahasiswa->first()->acc_topik == 0)
                                X 
                                @else
                               
                                {{  $user->riwayat_mahasiswa->first()->judul_topik }} - 

                                            @if (!isset($user->riwayat_mahasiswa->first()->skripsi) || !isset($user->riwayat_mahasiswa->first()->acc_judul) )
                                            X
                                            @else
                                            {{ $user->riwayat_mahasiswa->first()->skripsi->judul}}
                                            @endif 


                                @endif
                            @endif 
                        
                        </td>
                        {{-- <td>
                            @if (!isset($user->riwayat_mahasiswa->first()->skripsi) || !isset($user->riwayat_mahasiswa->first()->acc_judul) )
                            X
                            @else
                            {{ $user->riwayat_mahasiswa->first()->skripsi->judul}}
                            @endif 
                        </td> --}}
                        <td>
                            @if ( !isset($user->riwayat_mahasiswa->first()->acc_topik) )
                            X
                            @else
                                    @if ($user->riwayat_mahasiswa->first()->acc_topik == 0)
                                    X 
                                    
                                    @else
                                    {{  $user->riwayat_mahasiswa->first()->topik->user->nama}}

                                    @endif

                            @endif
                        </td> 
                        <td>
                          @if ( ($user->riwayat_mahasiswa->first()->skripsi ?? 0))
                                @if ($user->riwayat_mahasiswa->first()->skripsi->dosen_pembimbing_tambahan->first()->user->nama ?? 0)
                                    @foreach ($user->riwayat_mahasiswa->first()->skripsi->dosen_pembimbing_tambahan as $item)
                                        {{ $item->user->nama }} <hr>
                                    @endforeach
                                @else
                                X
                                @endif
                                
                              @else
                              X
                          @endif  
                        </td>
                        <td>
                            @if ($user->riwayat_mahasiswa->first()->skripsi ?? 0)
                                @if ($user->riwayat_mahasiswa->first()->skripsi->jadwal_sidang->dosen_sidang ?? 0)

                                    @foreach ($user->riwayat_mahasiswa->first()->skripsi->jadwal_sidang->dosen_sidang as $item)
                                        {{ $item->user->nama }} <hr>
                                    @endforeach
                                    
                                @else
                                    X
                                @endif
                             @else
                             X   
                            @endif

                        </td>
                        <td>
                            @if ( !isset($user->riwayat_mahasiswa->first()->skripsi->jadwal_sidang->jam_pelaksanaan) )
                            X
                            @else
                                    {{ $user->riwayat_mahasiswa->first()->skripsi->jadwal_sidang->hari_pelaksanaan }}
                                    <br>
                                    {{ $user->riwayat_mahasiswa->first()->skripsi->jadwal_sidang->jam_pelaksanaan }}-
                                    {{ $user->riwayat_mahasiswa->first()->skripsi->jadwal_sidang->jam_selesai}}
                        
                                
                            @endif
                        </td>

                    </tr>
                        
                    @endforeach
                    {{-- <tr>
                        <td>1</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>

<script>
    /*
Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
*/

function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}
$(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
});
</script>
@endsection