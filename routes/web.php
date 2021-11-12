<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');


// SuperAdmin
Route::namespace('App\Http\Controllers\Superadmin')->middleware(['auth:sanctum','verified','role:superadmin'])->prefix('superadmin')->name('superadmin.')->group(function(){
    Route::resource('permissions', 'PermissionsController')->only(['index']);
    Route::resource('roles', 'RolesController')->only(['index']);
    Route::resource('users', 'UsersController')->only(['index']);
    }
);

