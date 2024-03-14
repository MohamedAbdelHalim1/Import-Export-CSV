<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});



Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users-import', [UserController::class, 'show_import'])->name('users.import');
Route::post('/users-import', [UserController::class, 'upload_users'])->name('upload.users');
Route::post('/users-import-sheet', [UserController::class, 'upload_users_from_CSV'])->name('users.importPost');

Route::get('/users-export', [UserController::class, 'show_export'])->name('users.export');
Route::post('/users-export', [UserController::class, 'export_sheet'])->name('export.sheet');