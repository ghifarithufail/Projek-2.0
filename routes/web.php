<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KorcamController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[AdminController::class, 'index'])->name('home');
Route::get('/admin',[AdminController::class, 'admin'])->name('admin');

Route::get('/korcam', [KorcamController::class, 'index'])->name('korcam');
Route::get('korcam-create', [KorcamController::class, 'create'])->name('korcam/create');
Route::post('korcam-store', [KorcamController::class, 'store'])->name('korcam/store');
Route::get('korcams-{id}', [KorcamController::class, 'show'])->name('korcam/show');
Route::post('korcams-edit-{id}', [KorcamController::class, 'edit'])->name('korcam/edit');

Route::post('/kelurahans', [KorcamController::class, 'getKelurahan'])->name('get-kelurahan');
Route::post('/tps', [KorcamController::class, 'getTps'])->name('get-tps');
