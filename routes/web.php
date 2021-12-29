<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PasienController;


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
    return view('home');
})->name('home');

Route::get('jadwalpraktek', function() {
    return view('jadwal');
})->name('jadwal');

Route::post('/add/bio', [PasienController::class, 'add_bio'])->name('add_bio');

//Route Admin
Route::get('admin/profil', function() {
    return view('admin.admin');
})->name('admin_profil');

Route::get('admin/jadwalpraktek', function() {
    return view('admin.admin_jadwal');
})->name('admin_jadwal');

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

//Edit Admin
Route::get('admin/edit/profil', function() {
    return view('admin.edit.edit_profil');
})->name('admin_edit_profil');

Route::get('admin/edit/userpw', function() {
    return view('admin.edit.edit_userpw');
})->name('admin_edit_userpw');

Route::get('admin/edit/jadwalpraktek', function() {
    return view('admin.edit.edit_jadwal');
})->name('admin_edit_jadwal');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
