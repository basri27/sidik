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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('jadwalpraktek', function() {
    return view('jadwal');
})->name('jadwal');

Route::post('/add/bio', [PasienController::class, 'add_bio'])->name('add_bio');

//-------------------------------Route Admin---------------------------------//
Route::get('admin/dashboard/', [AdminController::class, 'adm_dashboard'])->name('adm_dashboard');

#Profil admin
Route::get('admin/profil/{user_id}', [AdminController::class, 'adm_profil'])->name('adm_profil');

#Edit profil admin
Route::get('admin/edit/profil/{user_id}', [AdminController::class, 'adm_edit'])->name('admin_edit_profil');
Route::patch('admin/update/profil/{user_id}', [AdminController::class, 'adm_update'])->name('adm_update_profil');

#Edit username dan password
Route::get('admin/edit/userpw/{user_id}', [AdminController::class, 'adm_edit_userpw'])->name('adm_edit_userpw');
Route::patch('admin/update/userpw/{user_id}', [AdminController::class, 'adm_update_userpw'])->name('adm_update_userpw');

#Manajemen jadwal
Route::get('admin/jadwalpraktek', [AdminController::class, 'adm_jadwal'])->name('adm_jadwal');

Route::get('admin/manajemendata/pasien', function() {
    return view('admin.manajemen.man_datapasien');
})->name('admin_man_datapasien');

Route::get('admin/manajemendata/nakes', function() {
    return view('admin.manajemen.man_datanakes');
})->name('admin_man_datanakes');

Route::get('admin/manajemendata/apoteker', function() {
    return view('admin.manajemen.man_dataapoteker');
})->name('admin_man_dataapoteker');

Route::get('admin/manajemendata/rekammedik', function() {
    return view('admin.manajemen.man_rekammedik');
})->name('admin_man_datarekammedik');

Route::get('admin/edit/userpw', function() {
    return view('admin.edit.edit_userpw');
})->name('admin_edit_userpw');

Route::get('admin/edit/jadwalpraktek', function() {
    return view('admin.edit.edit_jadwal');
})->name('admin_edit_jadwal');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
