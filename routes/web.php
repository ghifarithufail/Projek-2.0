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
use App\Http\Controllers\SuaraCalegController;
use App\Http\Controllers\TpsrwController;
use App\Models\SuaraCaleg;
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




Route::get('/login',[LoginController::class, 'loginUser'])->name('login');
Route::post('/login/store',[LoginController::class, 'login'])->name('login/store');

Route::group(['middleware' => ['auth']], function(){

Route::get('/',[AdminController::class, 'index'])->name('home');
Route::get('/chart',[DashboardController::class, 'index'])->name('chart');
Route::get('/admin',[AdminController::class, 'admin'])->name('admin');
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');
    
Route::get('/user/create',[LoginController::class, 'create'])->name('user/create')->middleware('hakakses:1');
Route::get('/user/edit/{id}',[LoginController::class, 'edit'])->name('user/edit')->middleware('hakakses:1');
Route::get('/user',[LoginController::class, 'index'])->name('user')->middleware('hakakses:1');
Route::post('/user/store',[LoginController::class, 'store'])->name('user/store')->middleware('hakakses:1');
Route::post('/user/update/{id}',[LoginController::class, 'update'])->name('user/update')->middleware('hakakses:1');

Route::get('/korcam', [KorcamController::class, 'index'])->name('korcam')->middleware('hakakses:1,2');
Route::get('korcam/create', [KorcamController::class, 'create'])->name('korcam/create')->middleware('hakakses:1,2');
Route::post('korcam/store', [KorcamController::class, 'store'])->name('korcam/store')->middleware('hakakses:1,2');
Route::get('/korcam-report', [KorcamController::class, 'report'])->name('korcam/report')->middleware('hakakses:1');
Route::get('korcams/{id}', [KorcamController::class, 'show'])->name('korcam/show')->middleware('hakakses:1');
Route::post('korcams/edit/{id}', [KorcamController::class, 'edit'])->name('korcam/edit')->middleware('hakakses:1');
Route::get('korcam/detail/{id}', [KorcamController::class, 'detail'])->name('korcam/detail')->middleware('hakakses:1');
Route::get('korcam/download/{id}', [KorcamController::class, 'download'])->name('korcam/download')->middleware('hakakses:1');
Route::get('korcam/pdf/{id}', [KorcamController::class, 'pdf'])->name('korcam/pdf')->middleware('hakakses:1');
Route::get('korcam/excel/{id}', [KorcamController::class, 'excel'])->name('korcam/excel')->middleware('hakakses:1');
Route::post('korcams/destroy/{id}', [KorcamController::class, 'destroy'])->name('korcam/destroy')->middleware('hakakses:1');

Route::post('/kelurahans', [KorcamController::class, 'getKelurahan'])->name('get-kelurahan');
Route::post('/tps', [KorcamController::class, 'getTps'])->name('get-tps');
Route::post('/get-korcam', [KorcamController::class, 'getKorcam'])->name('getKorcam');
Route::post('/get-korhan', [KorcamController::class, 'getKorhan'])->name('getKorhan');
Route::post('/get-kortps', [KorcamController::class, 'getKorTps'])->name('getKortps');
Route::post('/get-kabkota', [KorcamController::class, 'getKabkota'])->name('getKabkota');

Route::get('anggota', [AnggotaController::class, 'index'])->name('anggota');
Route::get('anggota/create', [AnggotaController::class, 'create'])->name('anggota/create');
Route::post('anggota/store', [AnggotaController::class, 'store'])->name('anggota/store');
Route::get('anggota/edit/{id}', [AnggotaController::class, 'edit'])->name('anggota/edit');
Route::post('anggota/update/{id}', [AnggotaController::class, 'update'])->name('anggota/update');
Route::post('anggota/destroy/{id}', [AnggotaController::class, 'destroy'])->name('anggota/destroy');


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
Route::post('caleg/destroy/{id}', [CalegController::class, 'destroy'])->name('caleg/destroy')->middleware('hakakses:1');


Route::get('partai', [PartaiController::class, 'index'])->name('partai');
Route::get('partai/create', [PartaiController::class, 'create'])->name('partai/create');
Route::post('partai/store', [PartaiController::class, 'store'])->name('partai/store');
Route::get('partai/edit/{id}', [PartaiController::class, 'edit'])->name('partai/edit');
Route::post('partai/update/{id}', [PartaiController::class, 'update'])->name('partai/update');
Route::post('partai/destroy/{id}', [PartaiController::class, 'destroy'])->name('partai/destroy');


//belum semua

Route::get('kelurahan', [KelurahanController::class, 'index'])->name('kelurahan');
Route::get('kelurahan/create', [KelurahanController::class, 'create'])->name('kelurahan/create');
Route::post('kelurahan/store', [KelurahanController::class, 'store'])->name('kelurahan/store');
Route::get('kelurahan/edit/{id}', [KelurahanController::class, 'edit'])->name('kelurahan/edit');
Route::post('kelurahan/update/{id}', [KelurahanController::class, 'update'])->name('kelurahan/update');
Route::get('kelurahan/detail/{id}', [KelurahanController::class, 'detail'])->name('kelurahan/detail');
Route::post('kelurahan/destroy/{id}', [KelurahanController::class, 'destroy'])->name('kelurahan/destroy');




Route::get('tps', [TpsrwController::class, 'index'])->name('tps');
Route::get('tps/create', [TpsrwController::class, 'create'])->name('tps/create');
Route::post('tps/store', [TpsrwController::class, 'store'])->name('tps/store');
Route::get('tps/edit/{id}', [TpsrwController::class, 'edit'])->name('tps/edit');
Route::post('tps/update/{id}', [TpsrwController::class, 'update'])->name('tps/update');
Route::post('tps/destroy/{id}', [TpsrwController::class, 'destroy'])->name('tps/destroy');


Route::prefix('korhan')->group(function () {
    // Define your routes here
    Route::get('/', [KorhanController::class, 'index'])->name('korhan')->middleware('hakakses:1,2,3');
    Route::get('/create', [KorhanController::class, 'create'])->name('korhan/create')->middleware('hakakses:1,2,3');
    Route::post('/store', [KorhanController::class, 'store'])->name('korhan/store')->middleware('hakakses:1,2,3')->middleware('hakakses:1');
    Route::post('/update/{id}', [KorhanController::class, 'update'])->name('korhan/update')->middleware('hakakses:1');
    Route::get('detail/{id}', [KorhanController::class, 'detail'])->name('korhan/detail')->middleware('hakakses:1');
    Route::get('details/{id}', [KorhanController::class, 'details'])->name('korhan/details')->middleware('hakakses:1');
    Route::get('pdf/{id}', [KorhanController::class, 'pdf'])->name('korhan/pdf')->middleware('hakakses:1');
    Route::get('/report', [KorhanController::class, 'report'])->name('korhan/report')->middleware('hakakses:1');
    Route::get('/download/{id}', [KorhanController::class, 'download'])->name('korhan/download')->middleware('hakakses:1');
    Route::get('download/excel/{id}', [KorhanController::class, 'excel'])->name('korhan/excel')->middleware('hakakses:1');
    Route::post('/destroy/{id}', [KorhanController::class, 'destroy'])->name('korhan/destroy')->middleware('hakakses:1');

});
Route::get('korhan/edit/{id}', [KorhanController::class, 'edit'])->name('korhan/edit');

Route::prefix('suara')->group(function () {

    Route::get('/', [SuaraCalegController::class, 'index'])->name('suara')->middleware('hakakses:1');
    Route::get('/create', [SuaraCalegController::class, 'create'])->name('suara/create')->middleware('hakakses:1');
    Route::post('/store', [SuaraCalegController::class, 'store'])->name('suara/store')->middleware('hakakses:1');
    Route::get('/edit/{id}', [SuaraCalegController::class, 'edit'])->name('suara/edit')->middleware('hakakses:1');
    Route::post('/update/{id}', [SuaraCalegController::class, 'update'])->name('suara/update')->middleware('hakakses:1');
    Route::post('/destroy/{id}', [SuaraCalegController::class, 'destroy'])->name('suara/destroy')->middleware('hakakses:1');


});

// Route::get('/detail/{id}', [KorhanController::class, 'detail'])->name('detail');



Route::prefix('kortps')->group(function () {
    // Define your routes here
    Route::get('/', [KorTpsController::class, 'index'])->name('kortps')->middleware('hakakses:1,2,3,4');
    Route::get('/create', [KorTpsController::class, 'create'])->name('kortps/create')->middleware('hakakses:1,2,3,4');
    Route::post('/store', [KorTpsController::class, 'store'])->name('kortps/store')->middleware('hakakses:1,2,3,4');
    Route::get('/edit/{id}', [KorTpsController::class, 'edit'])->name('kortps/edit')->middleware('hakakses:1');
    Route::post('/update/{id}', [KorTpsController::class, 'update'])->name('kortps/update')->middleware('hakakses:1');
    Route::get('/detail/{id}', [KorTpsController::class, 'detail'])->name('kortps/detail')->middleware('hakakses:1');
    Route::get('/details/{id}', [KorTpsController::class, 'details'])->name('kortps/details')->middleware('hakakses:1');
    Route::get('/report', [KorTpsController::class, 'report'])->name('kortps/report')->middleware('hakakses:1');
    Route::get('/download/{id}', [KorTpsController::class, 'download'])->name('kortps/download')->middleware('hakakses:1');
    Route::get('/pdf/{id}', [KorTpsController::class, 'pdf'])->name('kortps/pdf')->middleware('hakakses:1');
    Route::get('/download/excel/{id}', [KorTpsController::class, 'excel'])->name('kortps/excel')->middleware('hakakses:1');
    Route::get('download-excel/{id}', [KorTpsController::class, 'downloadExcel'])->name('download-excel')->middleware('hakakses:1');
    Route::post('/destroy/{id}', [KorTpsController::class, 'destroy'])->name('kortps/destroy')->middleware('hakakses:1');


});
Route::get('/generate-pdf-mapel/{id}', [PdfController::class, 'pdf_mapel'])->name('pdf-mapel');


}) ;





