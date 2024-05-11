<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/services', [App\Http\Controllers\ServiceController::class, 'getByCompany']);
Route::get('/users', [App\Http\Controllers\UserController::class, 'createUser']);
Route::get('/companies', [App\Http\Controllers\CompanyController::class, 'getAll']);
Route::get('/user/companies', [App\Http\Controllers\CompanyController::class, 'getByUser']);