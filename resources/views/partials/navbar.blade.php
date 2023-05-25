{{-- <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script> --}}

<?php 
use App\Models\setting_system;
$active= setting_system::all()[0];
?>

<?php
use App\Models\RiwayatMahasiswa;

$mahasiswa= new RiwayatMahasiswa();

$acc=$mahasiswa->where('nip','=',Auth::user()->nip)->first();
// dd($acc);
?>
    <div class="row flex-nowrap m-0 p-0 sticky-top">

        <div class="col-auto bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline"><h3> Skripsi Elektro</h3></span>
                    
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start link-light  " id="menu">
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link align-middle px-0 text-white ">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                        </a>
                    </li>

                    {{-- admin --}}
                  @if (Auth::user()->role == 3)
  
                  <li class="nav-item">
                      <a href="/post_pengumuman" class="nav-link align-middle px-0 text-white ">
                          <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Tambah Pengumuman</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="/register" class="nav-link align-middle px-0 text-white">
                          <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Register Mahasiswa</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="/list_mahasiswa" class="nav-link align-middle px-0 text-white">
                          <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">List Mahasiswa</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="/get_skripsi_mahasiswa" class="nav-link align-middle px-0 text-white">
                          <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Penjadwalan</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="/setting_system" class="nav-link align-middle px-0 text-white">
                          <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Setting System</span>
                      </a>
                  </li>
                  
                  @endif
                  {{-- dosen --}}
                  @if (Auth::user()->role == 2)
                 
                  
                  <li class="nav-item" id="mahasiswa_request" @if ($active->pemberian_topik_dosen==0) hidden
                      
                  @endif>
                      <a href="/request_topik_mahasiswa" class="nav-link align-middle px-0 text-white">
                          <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Mahasiswa Request</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="/post_jadwal_sidang_berhalangan" class="nav-link align-middle px-0 text-white">
                          <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Daftar Jadwal Berhalangan</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="/show_acc" class="nav-link align-middle px-0 text-white">
                          <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Buat Judul SubTopik</span>
                      </a>
                  </li>
                 
                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                            <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Topik</span> </a>
                        <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="/post_topik" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline ">Item</span> Tambah Topik </a>
                            </li>
                            <li>
                                <a href="/get_topik_user" class="nav-link px-0 text-white" > <span class="d-none d-sm-inline ">Item</span> List Topik </a>
                            </li>
                        </ul>
                    </li>
  
                    <li class="nav-item">
                      <a href="/get_jadwal_sidang_mahasiswa_dosen" class="nav-link align-middle px-0 text-white">
                          <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Jadwal Sidang </span>
                      </a>
                  </li>
                    
                    @endif
  
                    @if (Auth::user()->role==1)

                 
                    
                          <li class="nav-item">
                      <a href="/get_all_topik" class="nav-link align-middle px-0 text-white" @if ($active->pemilihan_topik_mahasiswa==0) hidden
                      
                        @endif>
                          <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">@if ($acc->acc_topik ?? false) <b> Topik Sudah di ACC</b> @else Cari Topik @endif</span>
                      </a>
                  </li>
                    @endif
                    {{-- <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Orders</span></a>
                    </li>
                    <li>
                        <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                            <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">Bootstrap</span></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Products</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 1</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 2</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 3</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 4</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span> </a>
                    </li> --}}
                </ul>
                <hr>
                <div class="btn-group dropup">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="" alt="hugenerd" width="30" height="30" class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1">{{ Auth::user()->nama}}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Propfile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="/logout">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
<script>


    // $(document).ready(function(){
    //     $.ajax({
    //              headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="X-CSRF-Token"]').attr('content')
    //                    },
    //              contentType:'json',
    //              dataType: "json",
    //              url : '/setting_system_navbar',
    //              type : 'GET',
    //              success: function(response) {
    //                 // console.log(response.ss[0]);
    //                 if(response.ss[0].pemberian_topik_dosen == 0){
    //                     var mahasiswa_request= $('#mahasiswa_request');
    //                     // console.log(mahasiswa_request);

    //                     mahasiswa_request.hide();

    //                 }
    //                 }
    //             })
        
    // })
   
</script>
