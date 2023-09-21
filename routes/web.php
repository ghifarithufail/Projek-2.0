<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\CalegController;
use App\Http\Controllers\DapilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\KorcamController;
use App\Http\Controllers\KorhanController;
use App\Http\Controllers\KorTpsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PartaiController;
use App\Http\Controllers\TpsrwController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[AdminController::class, 'index'])->name('home');
Route::get('/chart',[DashboardController::class, 'index'])->name('chart');
Route::get('/admin',[AdminController::class, 'admin'])->name('admin');

Route::get('/login',[LoginController::class, 'loginUser'])->name('login');
Route::post('/login/store',[LoginController::class, 'login'])->name('login/store');

Route::group(['middleware' => ['auth','hakakses:1']], function(){

Route::get('/user/create',[LoginController::class, 'create'])->name('user/create');
Route::get('/user',[LoginController::class, 'index'])->name('user');
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');
Route::post('/user/store',[LoginController::class, 'store'])->name('user/store');

Route::get('/korcam', [KorcamController::class, 'index'])->name('korcam');
Route::get('/korcam-report', [KorcamController::class, 'report'])->name('korcam/report');
Route::get('korcam/create', [KorcamController::class, 'create'])->name('korcam/create');
Route::post('korcam/store', [KorcamController::class, 'store'])->name('korcam/store');
Route::get('korcams/{id}', [KorcamController::class, 'show'])->name('korcam/show');
Route::post('korcams/edit/{id}', [KorcamController::class, 'edit'])->name('korcam/edit');
Route::get('korcam/detail/{id}', [KorcamController::class, 'detail'])->name('korcam/detail');
Route::get('korcam/download/{id}', [KorcamController::class, 'download'])->name('korcam/download');

}) ;



Route::post('/kelurahans', [KorcamController::class, 'getKelurahan'])->name('get-kelurahan');
Route::post('/tps', [KorcamController::class, 'getTps'])->name('get-tps');
Route::post('/get-korcam', [KorcamController::class, 'getKorcam'])->name('getKorcam');
Route::post('/get-korhan', [KorcamController::class, 'getKorhan'])->name('getKorhan');
Route::post('/get-kabkota', [KorcamController::class, 'getKabkota'])->name('getKabkota');

Route::get('anggota', [AnggotaController::class, 'index'])->name('anggota');
Route::get('anggota/create', [AnggotaController::class, 'create'])->name('anggota/create');
Route::post('anggota/store', [AnggotaController::class, 'store'])->name('anggota/store');
Route::get('anggota/edit/{id}', [AnggotaController::class, 'edit'])->name('anggota/edit');
Route::post('anggota/update/{id}', [AnggotaController::class, 'update'])->name('anggota/update');

Route::get('dapil', [DapilController::class, 'index'])->name('dapil');
Route::get('dapil/create', [DapilController::class, 'create'])->name('dapil/create');
Route::post('dapil/store', [DapilController::class, 'store'])->name('dapil/store');
Route::get('dapil/edit/{id}', [DapilController::class, 'edit'])->name('dapil/edit');
Route::post('dapil/update/{id}', [DapilController::class, 'update'])->name('dapil/update');

Route::get('caleg', [CalegController::class, 'index'])->name('caleg');
Route::get('caleg/create', [CalegController::class, 'create'])->name('caleg/create');
Route::post('caleg/store', [CalegController::class, 'store'])->name('caleg/store');
Route::get('caleg/edit/{id}', [CalegController::class, 'edit'])->name('caleg/edit');
Route::post('caleg/update/{id}', [CalegController::class, 'update'])->name('caleg/update');


Route::get('partai', [PartaiController::class, 'index'])->name('partai');
Route::get('partai/create', [PartaiController::class, 'create'])->name('partai/create');
Route::post('partai/store', [PartaiController::class, 'store'])->name('partai/store');
Route::get('partai/edit/{id}', [PartaiController::class, 'edit'])->name('partai/edit');
Route::post('partai/update/{id}', [PartaiController::class, 'update'])->name('partai/update');

//belum semua
Route::get('kelurahan', [KelurahanController::class, 'index'])->name('kelurahan');
Route::get('kelurahan/detail/{id}', [KelurahanController::class, 'detail'])->name('kelurahan/detail');
Route::get('tps', [TpsrwController::class, 'index'])->name('tps');

Route::prefix('korhan')->group(function () {
    // Define your routes here
    Route::get('/', [KorhanController::class, 'index'])->name('korhan');
    Route::get('/create', [KorhanController::class, 'create'])->name('korhan/create');
    Route::post('/store', [KorhanController::class, 'store'])->name('korhan/store');
    Route::post('/update/{id}', [KorhanController::class, 'update'])->name('korhan/update');
    Route::get('detail/{id}', [KorhanController::class, 'detail'])->name('korhan/detail');
    Route::get('details/{id}', [KorhanController::class, 'details'])->name('korhan/details');
    Route::get('pdf/{id}', [KorhanController::class, 'pdf'])->name('korhan/pdf');
    Route::get('/report', [KorhanController::class, 'report'])->name('korhan/report');
    Route::get('/download/{id}', [KorhanController::class, 'download'])->name('korhan/download');


    // Add more routes as needed
});
Route::get('korhan/edit/{id}', [KorhanController::class, 'edit'])->name('korhan/edit');

// Route::get('/detail/{id}', [KorhanController::class, 'detail'])->name('detail');



Route::prefix('kortps')->group(function () {
    // Define your routes here
    Route::get('/', [KorTpsController::class, 'index'])->name('kortps');
    Route::get('/create', [KorTpsController::class, 'create'])->name('kortps/create');
    Route::post('/store', [KorTpsController::class, 'store'])->name('kortps/store');
    Route::get('/edit/{id}', [KorTpsController::class, 'edit'])->name('kortps/edit');
    Route::post('/update/{id}', [KorTpsController::class, 'update'])->name('kortps/update');
    Route::get('/detail/{id}', [KorTpsController::class, 'detail'])->name('kortps/detail');
    Route::get('/details/{id}', [KorTpsController::class, 'details'])->name('kortps/details');
    Route::get('/report', [KorTpsController::class, 'report'])->name('kortps/report');
    Route::get('/download/{id}', [KorTpsController::class, 'download'])->name('kortps/download');
    Route::get('/pdf/{id}', [KorTpsController::class, 'pdf'])->name('kortps/pdf');
    Route::get('/download/excel/{id}', [KorTpsController::class, 'excel'])->name('kortps/excel');

});
Route::get('/generate-pdf-mapel/{id}', [PdfController::class, 'pdf_mapel'])->name('pdf-mapel');








