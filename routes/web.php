<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\depancontroller;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\skillcontroller;
use Doctrine\DBAL\Portability\Middleware;
use App\Http\Controllers\halamancontroller;
use App\Http\Controllers\profilecontroller;
use App\Http\Controllers\educationcontroller;
use App\Http\Controllers\experiencecontroller;
use App\Http\Controllers\pengaturanhalamancontroller;

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


Route::get('/',[depancontroller::class,"index"]);

Route::redirect('home', 'dashboard');

Route::get('/auth',[authController::class, "index"])->name('login')->middleware('guest');
Route::get('/auth/redirect', [authController::class, "redirect"])->middleware('guest');
Route::get('/auth/callback', [authController::class, "callback"])->middleware('guest');
Route::get('/auth/logout', [authController::class, 'logout']);

Route::prefix('dashboard')->middleware('auth')->group(
    function(){
        Route::get('/', [halamancontroller::class,'index']);
        Route::resource('halaman',halamancontroller::class);
        Route::resource('experience',experiencecontroller::class);
        Route::resource('education',educationcontroller::class);
        Route::get('skill',[skillcontroller::class,"index"])->name('skill.index');
        Route::post('skill',[skillcontroller::class,"update"])->name('skill.update');
        Route::get('profile',[profilecontroller::class,"index"])->name('profile.index');
        Route::post('profile',[profilecontroller::class,"update"])->name('profile.update');
        Route::get('pengaturanhalaman',[pengaturanhalamancontroller::class,"index"])->name('pengaturanhalaman.index');
        Route::post('pengaturanhalaman',[pengaturanhalamancontroller::class,"update"])->name('pengaturanhalaman.update');
    
    }
);
