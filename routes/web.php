<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

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
    return view('home');
});
Route::get('home', [AuthController::class, 'index'])->name('user.home');
Route::get('login', [AuthController::class, 'login'])->name('user.login');
Route::get('registration', [AuthController::class, 'registration'])->name('user.registration');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('post.registration');
Route::get('activate-account/{activation_code}', [AuthController::class, 'activateAccount'])->name('user.activateaccount');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('post.login');
Route::post('get-states', [AuthController::class, 'getStates'])->name('post.states');
Route::post('get-cities', [AuthController::class, 'getCities'])->name('post.ankit');
Route::get('get-new-captcha', [AuthController::class, 'get_new_captcha']);
