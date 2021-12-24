<?php

use Illuminate\Support\Facades\Route;

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

Route::namespace('Students')->group(function () {

    Route::get('/', [App\Http\Controllers\Students\StudentController::class, 'index'])->name('/');

    Route::get('import', [App\Http\Controllers\Students\StudentController::class, 'showImportForm'])->name('import');

    Route::post('import', [App\Http\Controllers\Students\StudentController::class, 'import'])->name('import');

    Route::resource('student', StudentController::class)->except(['index', 'show']);

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

