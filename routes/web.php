<?php

use App\Http\Controllers\InstallerController;
use App\Http\Controllers\PublicController;
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


Route::controller(InstallerController::class)->prefix('/installer')->group(function() {
    Route::get('/', 'index');
});

Route::middleware(['installer'])->controller(PublicController::class)->group(function() {
    Route::get('/', 'index');
});