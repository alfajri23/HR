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

        Route::middleware('role:admin')->prefix('dashboard/adm')->group(function(){
            Route::get('/',[Controllers\Admin\DashboardController::class,'index'])->name('dashboardAdmin');
        });

        Route::prefix('karyawan')->group(function(){
            Route::get('/',[Controllers\KaryawanController::class,'index'])->name('karyawanAdmin');
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
            Route::get('detail/{id}/{m}',[Controllers\TrackController::class,'user'])->name('trackUser');
            Route::get('divisi/{id}',[Controllers\TrackController::class,'divisi'])->name('trackDivisi');
            Route::post('/add',[Controllers\TrackController::class,'create'])->name('trackStore');
            Route::post('update',[Controllers\TrackController::class,'update'])->name('trackUpdate');
            Route::get('/get',[Controllers\TrackController::class,'show'])->name('trackShow');
            Route::get('delete/{id}',[Controllers\TrackController::class,'destroy'])->name('trackDelete');   
        });

    //});

    Route::get('dashboard',[Controllers\User\DashboardController::class,'index'])->name('dashboardUser');
    Route::get('saya',[Controllers\KaryawanController::class,'show_me'])->name('detailMe');
    

});

//Route::livewire('/', 'post.index')->name('post.index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/oscar', function(){
    return view('layouts.apps');
})->name('home');
