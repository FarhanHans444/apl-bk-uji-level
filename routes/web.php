<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SeminarController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JenisKerawananController;
use App\Http\Controllers\KonsulingBKController;
use App\Http\Controllers\TempatController;
use App\Http\Controllers\LayananBKController;
use App\Http\Controllers\PetakerawananController;
use App\Http\Controllers\WalasController;

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landingpage');
});
Route::get('/landingpage', function () {
    return view('landingpage');
});

Route::get('/inputpage', function () {
    return view('inputpage');
});
Route::get('/petakerawanan/{id}', [PetakerawananController::class, 'create'])->name('petakerawanan');
Route::post('/petakerawanan/{id}', [PetakerawananController::class, 'store']);
Route::get('/petakerawanan/hasil/{id}', [PetakerawananController::class, 'createHasil']);
Route::post('/petakerawanan/hasil/{id}', [PetakerawananController::class, 'storeHasil']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin|bk|walas'
])->group(function () {

    Route::get('/siswa/{id}', [SiswaController::class, 'show']);
    Route::get('/guru/edit/{id}', [GuruController::class, 'edit']);
    Route::put('/guru/{id}', [GuruController::class, 'update']);
    Route::get('/bk/konseling/detail/{id}',[KonsulingBKController::class, 'detailKonsul']);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin'
])->group(function () {
    // JURUSAN
    Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan');
    Route::get('/jurusan/create', [JurusanController::class, 'create']);
    Route::post('/jurusan/create', [JurusanController::class, 'store']);
    Route::delete('/jurusan/delete/{id}', [JurusanController::class, 'destroy']);
    Route::get('/jurusan/edit/{id}', [JurusanController::class, 'edit']);
    Route::put('/jurusan/edit/{id}', [JurusanController::class, 'update']);
    Route::get('/jurusan/show{id}', [JurusanController::class, 'show']);

    // KELAS
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas');
    Route::get('/kelas/create', [KelasController::class, 'create']);
    Route::delete('/kelas/delete/{id}', [KelasController::class, 'destroy']);
    Route::post('/kelas/create', [KelasController::class, 'store']);
    Route::get('/kelas/edit/{id}', [KelasController::class, 'edit']);
    Route::put('/kelas/edit/{id}', [KelasController::class, 'update']);
    Route::get('/kelas/{id}', [KelasController::class, 'show']);

    // GURU
    Route::get('/guru', [GuruController::class, 'index'])->name('guru');
    Route::get('/guru/create', [GuruController::class, 'create']);
    Route::post('/guru/create', [GuruController::class, 'store']);
    Route::delete('/guru/delete/{id}', [GuruController::class, 'destroy']);
    Route::get('/guru/{id}', [GuruController::class, 'show']);


    // SISWA 
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa');
    Route::get('/create-siswa', [SiswaController::class, 'create'])->name('create-siswa');
    Route::post('/siswa/create', [SiswaController::class, 'store']);
    Route::delete('/siswa/delete/{id}', [SiswaController::class, 'destroy']);
    Route::get('/siswa/edit/{id}', [SiswaController::class, 'edit']);
    Route::put('/siswa/{id}', [SiswaController::class, 'update']);

    //  TEMPAT
    Route::get('/tempat', [TempatController::class, 'index'])->name('tempat');
    Route::get('/tempat/create', [TempatController::class, 'create']);
    Route::post('/tempat/create', [TempatController::class, 'store']);
    Route::get('/tempat/edit/{id}', [TempatController::class, 'edit']);
    Route::put('/tempat/edit/{id}', [TempatController::class, 'update']);
    Route::delete('/tempat/delete/{id}', [TempatController::class, 'destroy']);

    //  KERAWANAN
    Route::get('/jeniskerawanan', [JenisKerawananController::class, 'index'])->name('jeniskerawanan');
    Route::get('/jeniskerawanan/create', [JenisKerawananController::class, 'create']);
    Route::post('/jeniskerawanan/create', [JenisKerawananController::class, 'store']);
    Route::get('/jeniskerawanan/edit/{id}', [JenisKerawananController::class, 'edit']);
    Route::put('/jeniskerawanan/edit/{id}', [JenisKerawananController::class, 'update']);
    Route::delete('/jeniskerawanan/delete/{id}', [JenisKerawananController::class, 'destroy']);

    // LAYANAN
Route::get('/layanan', [LayananBKController::class, 'index'])->name('layanan');
Route::get('/layanan/create',[LayananBKController::class,'create']);
Route::post('/layanan/create',[LayananBKController::class,'store']);
Route::get('/layanan/{id}', [LayananBKController::class, 'show']);
Route::get('/layanan/edit/{id}',[LayananBKController::class,'edit']);
Route::put('/layanan/{id}',[LayananBKController::class,'update']);
Route::delete('/layanan/delete/{id}',[LayananBKController::class,'destroy']);

});




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:bk'
])->group(function () {
    Route::get('/bk/siswa', [DashboardController::class, 'siswaBKIndex']);
    Route::get('/bk/konseling', [DashboardController::class, 'dataPerjanjianBKDenganSiswa']);
    Route::get('/bk/konseling/{namaJenisLayanan}', [DashboardController::class, 'dataPerjanjianBKDenganSiswaSesuaiLayanan']);
    Route::get('/bk/konseling/input/{namaJenisLayanan}', [DashboardController::class, 'inputBimbingan']);
    Route::post('/bk/konseling/input/{namaJenisLayanan}', [KonsulingBKController::class, 'simpanKonsuling']);
    Route::get('/bk/konseling/input/reschedule/{id}',[KonsulingBKController::class, 'viewReschedule']);
    Route::post('/bk/konseling/input/reschedule/{id}',[KonsulingBKController::class, 'menundaPengajuan']);
    Route::post('/bk/konseling/accept/{id}',[KonsulingBKController::class, 'menerimaPengajuan']);
    Route::get('/bk/konseling/catat/{id}',[KonsulingBKController::class, 'tampilanHasil']);
    Route::post('/bk/konseling/catat/{id}',[KonsulingBKController::class, 'mencatatHasil']);

        // SEMINAR
        Route::get('/seminar', [SeminarController::class, 'index'])->name('seminar');
        Route::get('/seminar/create', [SeminarController::class, 'create']);
        Route::post('/seminar/create', [SeminarController::class, 'store']);
        Route::delete('/seminar/delete/{id}', [SeminarController::class, 'destroy']);
        Route::get('/seminar/edit/{id}', [SeminarController::class, 'edit']);
        Route::put('/seminar/{id}', [SeminarController::class, 'update']);
        Route::get('/seminar/{id}', [SeminarController::class, 'show']);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:siswa'
])->group(function () {
    Route::get('/jadwalkonseling', [DashboardController::class, 'tampilansiswa']);
    Route::get('/input/{namaLayanan}', [DashboardController::class, 'inputBuatSiswa']);
    Route::post('/input/{namaLayanan}', [KonsulingBKController::class, 'simpanKonsuling']);
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:walas'
])->group(function () {
    Route::get('/walas/siswa', [WalasController::class, 'getAllDataSiswaFromKelas']);
    Route::get('/walas/siswa/konseling', [WalasController::class, 'getAllDataSiswaFromKelas']);
});

