<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessUnitController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('business_units', App\Http\Controllers\BusinessUnitController::class);
Route::get('/business_units', [BusinessUnitController::class, 'index'])->name('business_units.index');
Route::resource('projects', App\Http\Controllers\ProjectController::class);
Route::get('/projects', [\App\Http\Controllers\ProjectController::class, 'index'])->name('projects.index');
Route::get('projects/{id}', [\App\Http\Controllers\ProjectController::class, 'show'])->name('projects.show');
Route::put('/projects/{project}', [App\Http\Controllers\ProjectController::class, 'update'])->name('projects.update');
Route::put('/progress_reports/{progress_report}', [App\Http\Controllers\ProgressReportController::class, 'update'])->name('progress_reports.update');
Route::post('/progress-reports', [App\Http\Controllers\ProgressReportController::class, 'store'])->name('progress-reports.store');
