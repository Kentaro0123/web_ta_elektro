<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalSidangBerhalanganController;
use App\Http\Controllers\JadwalSidangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PenjadwalanSidangController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RiwayatMahasiswaController;
use App\Http\Controllers\SettingSystemController;
use App\Http\Controllers\SkripsiController;
use App\Http\Controllers\TopikController;
use App\Http\Controllers\DosenPembimbingTambahanController;
use App\Http\Controllers\FormatPenilaianAkhirController;
use App\Http\Controllers\FormatPenilaianController;
use App\Http\Controllers\JadwalSidangAkhirController;
use App\Http\Controllers\PenilaianAkhirController;
use App\Http\Controllers\PenilaianController;
use App\Models\FormatPenilaianAkhir;
use App\Models\JadwalSidang;
use App\Models\JadwalSidangBerhalangan;
use App\Models\Mahasiswa;
use App\Models\Penilaian;
use App\Models\PenilaianAkhir;
use App\Models\RiwayatMahasiswa;
use App\Models\setting_system;
use App\Models\Skripsi;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/






Route::middleware(['auth'])->group(function(){


    //GENERAL

    Route::get('/dashboard', [DashboardController::class,'index']);
    Route::get('/logout',[LoginController::class,'logout']);


        //ADMIN
        Route::group(['middleware' => 'ceklevel:3'], function(){
            
            Route::get('/post_pengumuman',[PengumumanController::class,'index'] );
            Route::post('/post_pengumuman',[PengumumanController::class,'store'] );
            Route::get('/register',[RegisterController::class,'index']);
            Route::post('/register',[RegisterController::class,'store']);
            Route::get('/list_mahasiswa',[MahasiswaController::class,'show']);
            Route::get('/list_mahasiswa_akhir',[MahasiswaController::class,'show_akhir']);
            Route::get('/get_skripsi_mahasiswa',[SkripsiController::class,'show']);
            Route::get('/get_skripsi_mahasiswa_lulus_proposal',[SkripsiController::class,'show_mahasiswa_lulus_proposal']);
            Route::get('/get_skripsi_dosen_pembimbing_tambahan',[DosenPembimbingTambahanController::class,'index']);
            Route::post('/post_skripsi_dosen_pembimbing_tambahan',[DosenPembimbingTambahanController::class,'store']);
            Route::get('/destroy_skripsi_dosen_pembimbing_tambahan/{id}',[DosenPembimbingTambahanController::class,'destroy']);
            Route::get('/penjadwalan/{id}',[JadwalSidangController::class,'index']);
            Route::get('/penjadwalan_sidang_akhir/{id}',[JadwalSidangAkhirController::class,'index']);
            Route::post('/post_penjadwalan_sidang',[JadwalSidangController::class,'store']);   
            Route::post('/post_penjadwalan_sidang_akhir',[JadwalSidangAkhirController::class,'store']);   
            Route::get('/setting_system',[SettingSystemController::class,'index']);
            Route::post('/setting_system',[SettingSystemController::class,'storeAndReplace']);
            Route::post('/setting_system_tanggal',[SettingSystemController::class,'storeAndReplace_tanggal']);
            Route::post('/setting_bobot',[SettingSystemController::class,'bobot']);
            Route::get('/format_penilaian',[FormatPenilaianController::class,'index']);
            Route::post('/format_penilaian',[FormatPenilaianController::class,'store']);
            Route::get('/format_penilaian_akhir',[FormatPenilaianAkhirController::class,'index']);
            Route::post('/format_penilaian_akhir',[FormatPenilaianAkhirController::class,'store']);
            Route::get('/get_penilaian_mahasiswa',[PenilaianController::class,'show']);
            Route::get('/get_penilaian_mahasiswa_akhir',[PenilaianAkhirController::class,'show']);
            Route::get('/lulus_proposal/{id}',[SkripsiController::class,'lulus_proposal']);
            Route::get('/cancel_lulus_proposal/{id}',[SkripsiController::class,'cancel_lulus_proposal']);
            Route::get('/lulus_skripsi/{id}',[SkripsiController::class,'lulus_skripsi']);
            Route::get('/cancel_lulus_skripsi/{id}',[SkripsiController::class,'cancel_lulus_skripsi']);
            Route::get('/get_list_mahasiswa_lulus',[SkripsiController::class,'get_list_mahasiswa_lulus']);
            

        });   


        //DOSEN
        Route::group(['middleware'=>'ceklevel:2'], function(){
            Route::get('/post_topik',[TopikController::class,'index']);
            Route::post('/post_topik',[TopikController::class,'store']);
            Route::get('/get_topik_user',[TopikController::class,'show_auth']);
            Route::get('/get_topik_users',[TopikController::class,'show']);
            Route::get('/request_topik_mahasiswa',[RiwayatMahasiswaController::class,'index']);
            Route::get('/request_topik_mahasiswa_download/{id}',[RiwayatMahasiswaController::class,'download']);
            Route::get('/request_topik_mahasiswa_acc/{id}',[RiwayatMahasiswaController::class,'update_topik']);
            Route::get('/show_acc',[RiwayatMahasiswaController::class,'show_acc']);
            Route::post('/judul_skripsi',[SkripsiController::class,'store']);
            Route::put('/judul_skripsi',[SkripsiController::class,'edit']);
            Route::get('/post_jadwal_sidang_berhalangan',[JadwalSidangBerhalanganController::class,'index']);
            Route::post('/post_jadwal_sidang_berhalangan',[JadwalSidangBerhalanganController::class,'store']); 
            Route::get('/get_jadwal_sidang_mahasiswa_dosen',[JadwalSidangController::class,'show_mahasiswa_dosen']);
            Route::get('/get_jadwal_sidang_mahasiswa_dosen_akhir',[JadwalSidangAkhirController::class,'show_mahasiswa_dosen']);
            Route::get('/destroy_jam_berhalangan/{id}',[JadwalSidangBerhalanganController::class,'destroy_unit']);
            Route::get('/destroy_jam_berhalangan_multiple/{hari}',[JadwalSidangBerhalanganController::class,'destroy_multiple_units']);
            Route::get('/nilai_proposal/{id}',[PenilaianController::class,'index']);
            Route::get('/nilai_sidang_akhir/{id}',[PenilaianAkhirController::class,'index']);
            Route::post('/post_nilai_proposal',[PenilaianController::class,'store_nilai_proposal']);
            Route::post('/post_nilai_akhir',[PenilaianAkhirController::class,'store_nilai_akhir']);


              
        });
        //ajax
        Route::get('/jadwal_berhalangan_id/{id}',[JadwalSidangBerhalanganController::class,'show_user']);
        Route::get('/setting_system_navbar',[SettingSystemController::class,'update_navbar']);
        Route::get('/jadwal_berhalangan_all/{jam_pelaksanaan}/{jam_selesai}/{hari_pelaksanaan}',[JadwalSidangBerhalanganController::class,'get_all']);

    
        
        //MAHASISWA
        Route::group(['middleware'=>'ceklevel:1'],function(){
            Route::get('/get_all_topik',[TopikController::class,'show']);
            Route::get('/get_riwayat_destroy_id/{id}',[RiwayatMahasiswaController::class,'destroy']);
        });
       

        Route::group(['middleware'=>'ceklevel:1,2'],function(){
            Route::get('/get_topik_detail/{id}',[TopikController::class,'show_detail']);
            Route::post('/get_topik_detail/acc_topik',[RiwayatMahasiswaController::class,'store']);
        });
        

});
//LOGIN 
Route::get('/login',[LoginController::class,'index'])->name('login')->middleware('guest');
Route::get('/',[LoginController::class,'index'])->name('login')->middleware('guest');
//LOGIN GOOGLE AUTH
Route::post('/login',[LoginController::class,'authenticate']);
//HANDLE REDIRECT AND CALL BACK GOOGLE
Route::get('/auth/redirect',[LoginController::class,'redirect']);
Route::get('/auth/callback', [LoginController::class,'callback']);

Route::post('/register_mahasiswa_store',[RegisterController::class,'store_mahasiswa']);
