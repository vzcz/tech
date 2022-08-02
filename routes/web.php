<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\employeeController;
use \Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        Route::get("/", [employeeController::class, 'showEmployee'])->name('employee.display')->middleware(['can:read']);;
        Route::get("/Add", [employeeController::class, 'addEmployee'])->name('add.employee')->middleware(['can:create']);
        Route::post("/store", [employeeController::class, 'store'])->name("store.employee")->middleware(['can:create']);;
        Route::get("/edit/{id}",[employeeController::class, "edit"])->name("employee.edit")->middleware(['can:edit']);;
        Route::post("/update", [employeeController::class, "update"])->name("employee.update")->middleware(['can:edit']);;
        Route::get("/delete/{id}", [employeeController::class, "delete"])->name("employee.delete")->middleware(['can:delete']);;
    });

######End


