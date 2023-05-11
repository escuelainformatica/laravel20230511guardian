<?php

use App\Http\Controllers\EjemploController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::any('/login', [EjemploController::class,'login'])->name('login');
Route::any('/loginadmin', [EjemploController::class,'loginadmin'])->name('loginadmin');
Route::middleware('auth:web')->get('/ok', [EjemploController::class,'ok'])->name('ok');
Route::middleware('auth:admin')->get('/okadmin', [EjemploController::class,'okadmin'])->name('okadmin');

