<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NakesController;


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

Auth::routes(); //Route bawaan laravel ui bootstrap --auth

//---------------------------Route Tampilan depan-----------------------------//
#Home
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

#Jadwal
Route::get('jadwalpraktek', [AdminController::class, 'show_jadwal'])->name('jadwal');

//-------------------------------Route Admin---------------------------------//
#Dahsboard admin
Route::get('admin/dashboard/', [AdminController::class, 'adm_dashboard'])->name('adm_dashboard');

#Profil admin
Route::get('admin/profil/{user_id}', [AdminController::class, 'adm_profil'])->name('adm_profil');

#Edit profil admin
Route::get('admin/edit/profil/{user_id}', [AdminController::class, 'adm_edit'])->name('adm_edit_profil');
Route::patch('admin/update/profil/{user_id}', [AdminController::class, 'adm_update'])->name('adm_update_profil');

#Edit username dan password
Route::get('admin/edit/userpw/{user_id}', [AdminController::class, 'adm_edit_userpw'])->name('adm_edit_userpw');
Route::patch('admin/update/userpw/{user_id}', [AdminController::class, 'adm_update_userpw'])->name('adm_update_userpw');

#Manajemen jadwal
Route::get('admin/jadwalpraktek', [AdminController::class, 'adm_jadwal'])->name('adm_jadwal');

#Edit jadwal
Route::get('admin/jadwalprakterk/edit/{id}', [AdminController::class, 'adm_jadwal_edit'])->name('adm_jadwal_edit');
Route::patch('admin/jadwalpraktek/update/{id}', [AdminController::class, 'adm_jadwal_update'])->name('adm_jadwal_update');

#Manajemen data 
Route::get('admin/manajemendata/pasien', [AdminController::class, 'adm_man_datapasien'])->name('adm_man_datapasien');
Route::get('admin/manajemendata/apoteker', [AdminController::class, 'adm_man_dataapoteker'])->name('adm_man_dataapoteker');
Route::get('admin/manajemendata/nakes', [AdminController::class, 'adm_man_datanakes'])->name('adm_man_datanakes');
Route::get('admin/manajemendata/rekammedik', [AdminController::class, 'adm_man_datarekammedik'])->name('adm_man_datarekammedik');

#Manajemen rekam medik
Route::post('admin/data/rekammedik/kirim/{id}', [AdminController::class, 'kirim_datarekammedik'])->name('kirim_datarekammedik');
Route::get('admin/detail/rekammedik/{id}', [AdminController::class, 'detail_datarekammedik'])->name('detail_datarekammedik');
Route::get('admin/editdata/rekammedik/{id}', [AdminController::class, 'edit_datarekammedik'])->name('edit_datarekammedik');

#Tambah data 
Route::get('admin/tambahdata/pasien', [AdminController::class, 'adm_man_datapasien_tambah'])->name('adm_man_datapasien_tambah');
Route::post('admin/adddata/pasien', [AdminController::class, 'adm_man_datapasien_add'])->name('adm_man_datapasien_add');
Route::get('admin/tambahdata/apoteker', [AdminController::class, 'adm_man_dataapoteker_tambah'])->name('adm_man_dataapoteker_tambah');
Route::post('admin/adddata/apoteker', [AdminController::class, 'adm_man_dataapoteker_add'])->name('adm_man_dataapoteker_add');
Route::get('admin/tambahdata/nakes', [AdminController::class, 'adm_man_datanakes_tambah'])->name('adm_man_datanakes_tambah');
Route::post('admin/adddata/nakes', [AdminController::class, 'adm_man_datanakes_add'])->name('adm_man_datanakes_add');
//Route::get('admin/tambahdata/rekammedik', [AdminController::class, 'adm_man_datarekammedik_tambah'])->name('adm_man_datarekammedik_tambah');

#Edit data 
Route::get('admin/editdata/pasien/{id}', [AdminController::class, 'adm_man_datapasien_edit'])->name('adm_man_datapasien_edit');
Route::patch('admin/updatedata/pasien/{id}', [AdminController::class, 'adm_man_datapasien_update'])->name('adm_man_datapasien_update');
Route::get('admin/editdata/apoteker/{id}', [AdminController::class, 'adm_man_dataapoteker_edit'])->name('adm_man_dataapoteker_edit');
Route::patch('admin/updatedata/apoteker/{id}', [AdminController::class, 'adm_man_dataapoteker_update'])->name('adm_man_dataapoteker_update');
Route::get('admin/editdata/nakes/{id}', [AdminController::class, 'adm_man_datanakes_edit'])->name('adm_man_datanakes_edit');
Route::patch('admin/updatedata/nakes/{id}', [AdminController::class, 'adm_man_datanakes_update'])->name('adm_man_datanakes_update');
//Route::get('admin/editdata/rekammedik/{id}', [AdminController::class, 'adm_man_datarekammedik_edit'])->name('adm_man_datarekammedik_edit');

#Delete data 
Route::delete('admin/deletedata/pasien/{id}', [AdminController::class, 'delete_datapasien'])->name('delete_datapasien');
Route::delete('admin/deletedata/apoteker/{id}', [AdminController::class, 'delete_dataapoteker'])->name('delete_dataapoteker');
Route::delete('admin/deletedata/nakes/{id}', [AdminController::class, 'delete_datanakes'])->name('delete_datanakes');
//Route::delete('admin/deletedata/rekammedik/{id}', [AdminController::class, 'delete_datarekammedik'])->name('delete_datarekammedik');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//----------------------------------Route Pasien----------------------------//
#Pasien isi bio ketika regist
Route::post('/add/bio', [PasienController::class, 'add_bio'])->name('add_bio');

//----------------------------------Route Nakes------------------------------//
Route::get('test', function() {
    event(new App\Events\MedicalRecordSent('Someone'));
    return "Medical Record has been sent!";
});

Route::get('nakes/dashboard/', [NakesController::class, 'nakes_dashboard'])->name('nakes_dashboard');
