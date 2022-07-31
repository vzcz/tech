<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\employee;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

######Routes Employee
Route::group(['prefix' => '/employee'], function (){
    Route::get("/", [employee::class, 'showEmployee'])->name('employee.display');
    Route::get("/Add", [employee::class, 'addEmployee'])->name('add.employee');
    Route::post("/store", [employee::class, 'store'])->name("store.employee");
//    Route::get("/edit/{employee_id}", [employee::class, 'edit'])->name('employee.edit');
});

######End
