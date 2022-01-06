<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\AdminController;


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
Route::get('admin/manajemendata/rekammedik', [AdminController::class, 'adm_man_datamrekammedik'])->name('adm_man_datarekammedik');

#Tambah data 
Route::get('admin/tambahdata/pasien', [AdminController::class, 'adm_man_datapasien_tambah'])->name('adm_man_datapasien_tambah');
Route::post('admin/adddata/pasien', [AdminController::class, 'adm_man_datapasien_add'])->name('adm_man_datapasien_add');

#Edit data 
Route::get('admin/editdata/pasien/{id}', [AdminController::class, 'adm_man_datapasien_edit'])->name('adm_man_datapasien_edit');
Route::patch('admin/updatedata/pasien/{id}', [AdminController::class, 'adm_man_datapasien_update'])->name('adm_man_datapasien_update');

#Delete data 
Route::delete('admin/deletedata/pasien/{id}', [AdminController::class, 'delete_datapasien'])->name('delete_datapasien');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//----------------------------------Route Pasien----------------------------//
#Pasien isi bio ketika regist
Route::post('/add/bio', [PasienController::class, 'add_bio'])->name('add_bio');
