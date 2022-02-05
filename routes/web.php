<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire;
use App\Http\Controllers;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Route::prefix('karyawan')->group(function () {
    //     Route::get('/',Livewire\Karyawan::class)->name('karyawanIndex');
    //     Route::get('/datatabel',[Livewire\Karyawan::class,'datatable'])->name('karyawanDT');
    // });
    //Route::prefix('admin')->group(function(){

        // Route::middleware('role:admin')->prefix('dashboard/adm')->group(function(){
        //     Route::get('/',[Controllers\Admin\DashboardController::class,'index'])->name('dashboardAdmin');
        // });

        Route::prefix('karyawan')->group(function(){
            Route::get('/',[Controllers\KaryawanController::class,'index'])->name('karyawanAdmin');
            Route::get('profile/me',[Controllers\KaryawanController::class,'profile'])->name('karyawanProfile');
            Route::get('/detail/{id}',[Controllers\KaryawanController::class,'show'])->name('karyawanDetail');
            Route::post('/add',[Controllers\KaryawanController::class,'store'])->name('karyawanStore');
            Route::post('/update',[Controllers\KaryawanController::class,'update'])->name('karyawanUpdate');
            Route::get('/delete/{id}',[Controllers\KaryawanController::class,'destroy'])->name('karyawanDelete');
        });

        Route::middleware('role:admin')->prefix('divisi')->group(function(){
            Route::get('/',[Controllers\DivisiController::class,'index'])->name('divisiAdmin');
            Route::get('/detail/{id}',[Controllers\DivisiController::class,'detail'])->name('divisiDetail');
            Route::post('/add',[Controllers\DivisiController::class,'create'])->name('divisiStore');
            Route::get('/get',[Controllers\DivisiController::class,'show'])->name('divisiShow');
            Route::get('/delete/{id}',[Controllers\DivisiController::class,'destroy'])->name('divisiDelete');
        });

        Route::prefix('objective')->group(function(){
            Route::post('/add',[Controllers\ObjectiveController::class,'create'])->name('objStore');
            Route::get('/get',[Controllers\ObjectiveController::class,'show'])->name('objShow');
            Route::get('delete/{id}',[Controllers\ObjectiveController::class,'destroy'])->name('objDelete');   
        });

        Route::middleware('role:admin')->prefix('key')->group(function(){ 
            Route::post('/add',[Controllers\KeyResultController::class,'create'])->name('keyStore');
            Route::get('/get',[Controllers\KeyResultController::class,'show'])->name('keyShow');
            Route::get('delete',[Controllers\KeyResultController::class,'destroy'])->name('keyDelete');   
        });

        Route::prefix('track')->group(function(){ 
            Route::get('admin/{id}/{m}',[Controllers\TrackController::class,'user'])->name('trackUser');
            Route::get('divisi/{id}',[Controllers\TrackController::class,'divisi'])->name('trackDivisi');
            Route::get('divisi/{id}/{m}',[Controllers\TrackController::class,'divisiMount'])->name('trackDivisiMount');
            
            Route::get('user/{m}',[Controllers\TrackController::class,'user_track'])->name('trackKaryawan');
            Route::get('riwayat',[Controllers\TrackController::class,'histori_track_user'])->name('trackHistoriUser');

            Route::get('list',[Controllers\TrackController::class,'list'])->name('trackList');
            Route::post('/add',[Controllers\TrackController::class,'create'])->name('trackStore');
            Route::post('update',[Controllers\TrackController::class,'update'])->name('trackUpdate');
            Route::get('/get',[Controllers\TrackController::class,'show'])->name('trackShow');
            Route::get('delete/{id}',[Controllers\TrackController::class,'destroy'])->name('trackDelete');   
        });

        Route::prefix('absen')->group(function(){ 
            Route::post('store',[Controllers\AbsensiController::class,'store'])->name('absenStore');
        });

        Route::prefix('result')->group(function(){ 
            Route::get('key/{id}',[Controllers\KeyResultUserController::class,'show'])->name('resultDetail');
            Route::get('list',[Controllers\KeyResultUserController::class,'list'])->name('resultList');
        });

        Route::prefix('rank')->group(function(){ 
            Route::get('list',[Controllers\DashboardController::class,'list_histori'])->name('rankList');
            Route::get('/{id}',[Controllers\DashboardController::class,'histori_rank'])->name('rankDetail');
            Route::get('detail/{m}',[Controllers\DashboardController::class,'detail'])->name('dashboardDetail');
        });

        Route::prefix('izin')->group(function(){ 
            Route::get('admin',[Controllers\IzinController::class,'admin'])->name('izinAdmin');
            Route::get('sakit/adm',[Controllers\IzinController::class,'admin_sakit'])->name('izinAdminSakit');
            Route::get('main',[Controllers\IzinController::class,'index'])->name('izinIndex');
            Route::get('sakit',[Controllers\IzinController::class,'sakit'])->name('izinSakit');
            Route::get('histori',[Controllers\IzinController::class,'histori'])->name('izinHistori');
            Route::post('/',[Controllers\IzinController::class,'request'])->name('izinReq');
            Route::get('show',[Controllers\IzinController::class,'show'])->name('izinShow');
            Route::get('delete',[Controllers\IzinController::class,'delete'])->name('izinDelete');
            
            Route::get('accept',[Controllers\IzinController::class,'accept'])->name('izinAcc');
            Route::get('reject',[Controllers\IzinController::class,'reject'])->name('izinRej');
        });

        Route::prefix('cuti')->group(function(){ 
            Route::get('admin',[Controllers\CutiController::class,'admin'])->name('cutiAdmin');
            Route::get('/',[Controllers\CutiController::class,'index'])->name('cutiIndex');
            Route::get('histori',[Controllers\CutiController::class,'histori'])->name('cutiHistori');
        });

        Route::prefix('ganti_jam')->group(function(){ 
            Route::get('admin',[Controllers\GantiJamController::class,'admin'])->name('gantiAdmin');
            Route::get('/',[Controllers\GantiJamController::class,'index'])->name('gantiIndex');
            Route::get('histori',[Controllers\GantiJamController::class,'histori'])->name('gantiHistori');
            Route::get('show',[Controllers\GantiJamController::class,'show'])->name('gantiShow');
            Route::post('store',[Controllers\GantiJamController::class,'store'])->name('gantiStore');
            Route::get('delete',[Controllers\GantiJamController::class,'delete'])->name('gantiDelete');
        });

        Route::prefix('lembur')->group(function(){ 
            Route::get('admin',[Controllers\LemburController::class,'admin'])->name('lemburAdmin');
            Route::get('/',[Controllers\LemburController::class,'index'])->name('lemburIndex');
            Route::get('histori',[Controllers\LemburController::class,'histori'])->name('lemburHistori');
            Route::get('show',[Controllers\LemburController::class,'show'])->name('lemburShow');
            Route::post('store',[Controllers\LemburController::class,'store'])->name('lemburStore');
            Route::get('delete',[Controllers\LemburController::class,'delete'])->name('lemburDelete');
        });

        //notifikasi
        Route::get('list',[Controllers\NotifikasiController::class,'baca'])->name('notiBaca');


        //ibadah master
        Route::prefix('ibadah')->group(function(){
            Route::get('input',[Controllers\ListIbadahUserController::class,'index'])->name('ibadahInput');
            Route::post('store',[Controllers\ListIbadahUserController::class,'store'])->name('ibadahInputStore');
            Route::post('update',[Controllers\ListIbadahUserController::class,'update'])->name('ibadahUpdate');

            Route::get('edit',[Controllers\ListIbadahUserController::class,'edit'])->name('ibadahEdit');
            Route::get('history',[Controllers\ListIbadahUserController::class,'history'])->name('ibadahHistory');
            Route::get('listMaster',[Controllers\ListIbadahController::class,'index'])->name('ibadahList');
            Route::get('showMaster',[Controllers\ListIbadahController::class,'show'])->name('ibadahShow');
            Route::post('storeMaster',[Controllers\ListIbadahController::class,'create'])->name('ibadahStore');
            Route::get('deleteMaster',[Controllers\ListIbadahController::class,'destroy'])->name('ibadahDelete');
        });
    //});
        
        Route::prefix('dashboard')->group(function(){
            Route::get('/',[Controllers\DashboardController::class,'index'])->name('dashboard');
           
        });

        Route::prefix('subdivisi')->group(function(){
            Route::get('/',[Controllers\SubdivisiController::class,'index'])->name('subdivIndex');
            Route::get('show',[Controllers\SubdivisiController::class,'show'])->name('subdivShow');
            Route::get('delete/{id}',[Controllers\SubdivisiController::class,'destroy'])->name('subdivDelete');
            Route::post('store',[Controllers\SubdivisiController::class,'store'])->name('subdivStore');
        });

    
    Route::get('saya',[Controllers\KaryawanController::class,'input_okr'])->name('detailMe');
    

});


