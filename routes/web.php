<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolesController;
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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//permissions
Route::resource('permissions', PermissionController::class);
Route::get('permissions/{permissionID}/delete', [PermissionController::class, 'destroy']);

//roles
Route::resource('roles', RolesController::class);
Route::get('roles/{roleID}/delete', [RolesController::class, 'destroy']);
//    ->middleware('permission:delete role');
Route::get('roles/{roleID}/assign-permissions', [RolesController::class, 'assignPermissionToRole']);
Route::put('roles/{roleID}/assign-permissions', [RolesController::class, 'givePermissionToRole']);
