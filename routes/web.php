<?php

use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\QuizsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
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
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return "all cleared ...";
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardsController::class, 'index'])->name('dashboard');
    Route::resource('dashboards', DashboardsController::class);
    Route::resource('users', UserController::class);
    Route::resource('quiz', QuizsController::class);
    Route::get('/users/folleto', function () {
        return view('folleto');
    });
    Route::post('/users/store_folleto', [UserController::class, 'store_folleto'])->name('users.store_folleto');

});
