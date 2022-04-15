<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NakesController;
use App\Http\Controllers\ApotekerController;
use App\Http\Controllers\ChartController;
use App\Events\MedicalRecordSent;


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
Route::get('/', [HomeController::class, 'index'])->name('home');

#Jadwal
Route::get('jadwalpraktek', [HomeController::class, 'show_jadwal'])->name('jadwal');

//-------------------------------Route Admin---------------------------------//
#Dahsboard admin
Route::get('admin/dashboard', [AdminController::class, 'adm_dashboard'])->name('adm_dashboard');

#Profil admin
Route::get('admin/profil/{user_id}', [AdminController::class, 'adm_profil'])->name('adm_profil');

#Edit profil admin
Route::get('admin/edit/profil/{user_id}', [AdminController::class, 'adm_edit'])->name('adm_edit_profil');
Route::patch('admin/update/profil/{user_id}', [AdminController::class, 'adm_update'])->name('adm_update_profil');
Route::patch('admin/reset/foto/{user_id}', [AdminController::class, 'admResetFoto'])->name('adm_reset_foto');
#Edit username dan password
Route::get('admin/edit/userpw/{user_id}', [AdminController::class, 'adm_edit_userpw'])->name('adm_edit_userpw');
Route::patch('admin/update/userpw/{user_id}', [AdminController::class, 'adm_update_userpw'])->name('adm_update_userpw');
Route::patch('admin/update/username/{user_id}', [AdminController::class, 'updateUsername'])->name('adm_update_username');
Route::patch('admin/update/password/{user_id}', [AdminController::class, 'updatePassword'])->name('adm_update_password');

#Manajemen jadwal
Route::get('admin/jadwalpraktek', [AdminController::class, 'adm_jadwal'])->name('adm_jadwal');

#Edit jadwal
Route::get('admin/jadwalprakterk/edit/{id}', [AdminController::class, 'adm_jadwal_edit'])->name('adm_jadwal_edit');
Route::patch('admin/jadwalpraktek/update/{id}', [AdminController::class, 'adm_jadwal_update'])->name('adm_jadwal_update');

#Rekap rekam medik
Route::get('admin/rekaprekammedik', [AdminController::class, 'adm_rekap_rekam_medik'])->name('adm_rekap_rekam_medik');
Route::post('filterrekammedik', [AdminController::class, 'filterRekamMedik'])->name('filterRekamMedik');
Route::get('admin/rekaprekammedik/{year}/{month}', [AdminController::class, 'get_freq_diagnoses'])->name('get_freq_diagnoses');

#Manajemen data 
Route::get('admin/manajemen/data/pasien', [AdminController::class, 'adm_man_datapasien'])->name('adm_man_datapasien');
Route::get('admin/manajemen/data/apoteker', [AdminController::class, 'adm_man_dataapoteker'])->name('adm_man_dataapoteker');
Route::get('admin/manajemen/data/nakes', [AdminController::class, 'adm_man_datanakes'])->name('adm_man_datanakes');
Route::get('admin/manajemen/data/rekammedik', [AdminController::class, 'adm_man_datarekammedik'])->name('adm_man_datarekammedik');
Route::get('admin/manajemen/data/diagnosa', [AdminController::class, 'admManDataDiagnosa'])->name('adm_man_datadiagnosa');

#Manajemen rekam medik
Route::post('admin/data/rekammedik/kirim/{id}', [AdminController::class, 'kirim_datarekammedik'])->name('kirim_datarekammedik');
Route::post('admin/data/rekammedik/keluarga/kirim/{id}', [AdminController::class, 'kirimRekamMedikKeluarga'])->name('kirim_datarekammedikkeluarga');
Route::get('admin/filterrekammedik/pasien', [AdminController::class, 'filterRekamMedikPasien'])->name('filter_rekammedik');
Route::get('admin/detail/rekammedik/{id}', [AdminController::class, 'detail_datarekammedik'])->name('detail_datarekammedik');
Route::get('admin/editdata/rekammedik/{id}', [AdminController::class, 'edit_datarekammedik'])->name('edit_datarekammedik');
Route::get('admin/editdata/rekammedik/keluarga/{id}', [AdminController::class, 'editRekamMedikKeluarga'])->name('edit_datarekammedikkeluarga');
Route::get('getProdi/{id}', function ($id) {
	$prodi = App\Models\Prodi::where('fakulta_id', $id)->get();
	return response()->json($prodi);
});

#Tambah data 
Route::get('admin/tambahdata/pasien', [AdminController::class, 'adm_man_datapasien_tambah'])->name('adm_man_datapasien_tambah');
Route::post('admin/add/data/pasien', [AdminController::class, 'adm_man_datapasien_add'])->name('adm_man_datapasien_add');
Route::get('admin/tambahdata/apoteker', [AdminController::class, 'adm_man_dataapoteker_tambah'])->name('adm_man_dataapoteker_tambah');
Route::post('admin/add/data/apoteker', [AdminController::class, 'adm_man_dataapoteker_add'])->name('adm_man_dataapoteker_add');
Route::get('admin/tambahdata/nakes', [AdminController::class, 'adm_man_datanakes_tambah'])->name('adm_man_datanakes_tambah');
Route::post('admin/add/data/nakes', [AdminController::class, 'adm_man_datanakes_add'])->name('adm_man_datanakes_add');
Route::post('admin/add/data/diagnosa', [AdminController::class, 'admAddDiagnosa'])->name('adm_add_diagnosa');
//Route::get('admin/tambahdata/rekammedik', [AdminController::class, 'adm_man_datarekammedik_tambah'])->name('adm_man_datarekammedik_tambah');

#Edit data 
Route::get('admin/editdata/pasien/{id}', [AdminController::class, 'adm_man_datapasien_edit'])->name('adm_man_datapasien_edit');
Route::patch('admin/updatedata/pasien/{id}', [AdminController::class, 'adm_man_datapasien_update'])->name('adm_man_datapasien_update');
Route::get('admin/editdata/apoteker/{id}', [AdminController::class, 'adm_man_dataapoteker_edit'])->name('adm_man_dataapoteker_edit');
Route::patch('admin/updatedata/apoteker/{id}', [AdminController::class, 'adm_man_dataapoteker_update'])->name('adm_man_dataapoteker_update');
Route::get('admin/editdata/nakes/{id}', [AdminController::class, 'adm_man_datanakes_edit'])->name('adm_man_datanakes_edit');
Route::patch('admin/updatedata/nakes/{id}', [AdminController::class, 'adm_man_datanakes_update'])->name('adm_man_datanakes_update');
Route::patch('admin/update/data/diagnosa/{id}', [AdminController::class, 'admEditDiagnosa'])->name('adm_edit_diagnosa');
//Route::get('admin/editdata/rekammedik/{id}', [AdminController::class, 'adm_man_datarekammedik_edit'])->name('adm_man_datarekammedik_edit');

#Delete data 
Route::patch('admin/deletedata/pasien/{id}', [AdminController::class, 'delete_datapasien'])->name('delete_datapasien');
Route::patch('admin/deletedata/apoteker/{id}', [AdminController::class, 'delete_dataapoteker'])->name('delete_dataapoteker');
Route::patch('admin/deletedata/nakes/{id}', [AdminController::class, 'delete_datanakes'])->name('delete_datanakes');
Route::patch('admin/delete/data/diagnosa/{id}', [AdminController::class, 'admDeleteDiagnosa'])->name('adm_delete_diagnosa');
//Route::delete('admin/deletedata/rekammedik/{id}', [AdminController::class, 'delete_datarekammedik'])->name('delete_datarekammedik');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//----------------------------------Route Pasien----------------------------//
#Pasien isi bio ketika regist
Route::get('/bio', [PasienController::class, 'viewBio']);
Route::post('/add/bio', [PasienController::class, 'add_bio'])->name('add_bio');
Route::get('pasien/profil/{id}', [PasienController::class, 'profilPasien'])->name('profil_pasien');
Route::get('pasien/edit/profil/{id}', [PasienController::class, 'editProfilPasien'])->name('pasien_edit_profil');
Route::get('pasien/edit/userpw/{id}', [PasienController::class, 'editUserPw'])->name('pasien_edit_userpw');
Route::patch('pasien/update/profil/{id}', [PasienController::class, 'updateProfilPasien'])->name('pasien_update_profil');
Route::patch('pasien/update/username/{id}', [PasienController::class, 'updateUsername'])->name('pasien_update_username');
Route::patch('pasien/update/password/{id}', [PasienController::class, 'updatePassword'])->name('pasien_update_password');
Route::patch('pasien/reset/foto/{id}', [PasienController::class, 'resetFotoPasien'])->name('pasien_reset_foto');
Route::patch('pasien/update/userpw/{id}', [PasienController::class, 'pasienUpdateUserPw'])->name('pasien_update_userpw');
Route::get('pasien/jadwalpraktek/{id}', [PasienController::class, 'jadwalPraktik'])->name('pasien_jadwal_praktik');
Route::get('pasien/kartuberobat/{id}', [PasienController::class, 'kartuBerobat'])->name('kartu_berobat');
Route::get('pasien/print/kartuberobat/{id}', [PasienController::class, 'printKartuBerobat'])->name('print_kartu_berobat');
Route::get('pasien/keluarga/{id}', [PasienController::class, 'keluargaPasien'])->name('keluarga_pasien');
Route::post('pasien/add/keluarga/{id}', [PasienController::class, 'addKeluarga'])->name('add_keluarga');
Route::get('pasien/riwayatberobat/{id}', [PasienController::class, 'riwayatBerobat'])->name('riwayat_berobat');

//----------------------------------Route Nakes------------------------------//
Route::get('nakes/dashboard/{id}', [NakesController::class, 'nakesDashboard'])->name('nakes_dashboard');
Route::get('nakes/profil/{id}', [NakesController::class, 'nakesProfil'])->name('nakes_profil');
Route::get('nakes/profil/edit/{id}', [NakesController::class, 'nakesEditProfil'])->name('nakes_edit_profil');
Route::patch('nakes/profil/update/{id}', [NakesController::class, 'nakesUpdateProfil'])->name('nakes_update_profil');
Route::get('nakes/usernamepassword/edit/{id}', [NakesController::class, 'nakesEditUserPw'])->name('nakes_edit_userpw');
Route::patch('nakes/usernamepassword/update/{id}', [NakesController::class, 'nakesUpdateUserPw'])->name('nakes_update_userpw');
Route::patch('nakes/reset/foto/{id}', [NakesController::class, 'nakesResetFoto'])->name('nakes_reset_foto');
Route::get('nakes/data/edit/rekammedik/{id}', [NakesController::class, 'nakesEditRekamMedik'])->name('nakes_edit_rekammedik');
Route::get('nakes/data/edit/rekammedik/resepobat/{id}', [NakesController::class, 'editRekamMedikLast'])->name('nakes_edit_rekammedik_last');
Route::post('nakes/resepobat/add/{id}', [NakesController::class, 'addResepObat'])->name('add_resep_obat');
Route::delete('nakes/resepobat/delete/{id}/{notif}', [NakesController::class, 'deleteResepObat'])->name('delete_resep_obat');
Route::post('nakes/data/rekammedik/kirim/{id}', [NakesController::class, 'nakesKirimDataRekamMedik'])->name('nakes_kirim_datarekammedik');
Route::post('nakes/kirim/rekammedik/{id}', [NakesController::class, 'kirimRekamMedik'])->name('nakes_kirim_rekammedik');

//----------------------Route Apoteker----------------------//
Route::get('apoteker/dashboard/{id}', [ApotekerController::class, 'apotekerDashboard'])->name('apoteker_dashboard');
Route::get('apoteker/profil/{id}', [ApotekerController::class, 'apotekerProfil'])->name('apoteker_profil');
Route::get('apoteker/profil/edit/{id}', [ApotekerController::class, 'apotekerEditProfil'])->name('apoteker_edit_profil');
Route::patch('apoteker/profil/update/{id}', [ApotekerController::class, 'apotekerUpdateProfil'])->name('apoteker_update_profil');
Route::get('apoteker/usernamepassword/edit/{id}', [ApotekerController::class, 'apotekerEditUserPw'])->name('apoteker_edit_userpw');
Route::patch('apoteker/usernamepassword/update/{id}', [ApotekerController::class, 'apotekerUpdateUserPw'])->name('apoteker_update_userpw');
Route::patch('apoteker/reset/foto/{id}', [ApotekerController::class, 'apotekerResetFoto'])->name('apoteker_reset_foto');
Route::get('apoteker/dataobat/{id}', [ApotekerController::class, 'apotekerDataObat'])->name('apoteker_data_obat');
Route::post('apoteker/dataobat/add/{id}', [ApotekerController::class, 'addObat'])->name('apoteker_add_obat');
Route::patch('apoteker/dataobat/edit/{id}{user_id}', [ApotekerController::class, 'editObat'])->name('apoteker_edit_obat');
Route::patch('apoteker/dataobat/delete/{id}{user_id}', [ApotekerController::class, 'deleteObat'])->name('apoteker_delete_obat');
Route::patch('apoteker/pengobatanselesai/{id}{user_id}', [ApotekerController::class, 'pengobatanSelesai'])->name('pengobatan_selesai');
#Obat pasien
Route::get('apoteker/obat/{id}', [ApotekerController::class, 'apotekerObatPasien'])->name('apoteker_obat_pasien');