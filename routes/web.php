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
use App\Models\JadwalSidang;
use App\Models\JadwalSidangBerhalangan;
use App\Models\Mahasiswa;
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
            Route::get('/get_skripsi_mahasiswa',[SkripsiController::class,'show']);
            Route::get('/penjadwalan/{id}',[JadwalSidangController::class,'index']);
            Route::post('/post_penjadwalan_sidang',[JadwalSidangController::class,'store']);   
            Route::get('/setting_system',[SettingSystemController::class,'index']);
            Route::post('/setting_system',[SettingSystemController::class,'storeAndReplace']);

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
              
        });
        //ajax
        Route::get('/jadwal_berhalangan_id/{id}',[JadwalSidangBerhalanganController::class,'show_user']);
        Route::get('/setting_system_navbar',[SettingSystemController::class,'update_navbar']);

    
        
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

Route::post('/login',[LoginController::class,'authenticate']);

Route::get('/auth/redirect',[LoginController::class,'redirect']);
Route::get('/auth/callback', [LoginController::class,'callback']);

Route::post('/register_mahasiswa',[RegisterController::class,'store']);
