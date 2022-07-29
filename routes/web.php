<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;

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
    return view('auth.login');
});

/*
Route::get('/empleados/create',[EmpleadoController::class,"create"]);
Route::controller(EmpleadoController::class)->group(function(){
    Route::get('empleados', "index");
    Route::get('empleados/create', 'create');   
});*/

Route::resource('empleado',EmpleadoController::class);

Auth::routes();

Route::get('/home', [EmpleadoController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'], function(){
    Route::get('/', [EmpleadoController::class, 'index'])->name('home');
});