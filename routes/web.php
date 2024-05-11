<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/users', [App\Http\Controllers\UserController::class, 'create']);
Route::put('/users/update', [App\Http\Controllers\UserController::class, 'update']);
Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'delete']);

Route::post('/companies', [App\Http\Controllers\CompanyController::class, 'create']);
Route::put('/companies', [App\Http\Controllers\CompanyController::class, 'update']);
Route::delete('/companies/{id}', [App\Http\Controllers\CompanyController::class, 'delete']);
Route::get('/companies', [App\Http\Controllers\CompanyController::class, 'getAll']);
Route::get('/user/companies', [App\Http\Controllers\CompanyController::class, 'getByUser']);

Route::post('/services', [App\Http\Controllers\ServiceController::class, 'create']);
Route::put('/services/update', [App\Http\Controllers\ServiceController::class, 'update']);
Route::get('/services/{companyId}', [App\Http\Controllers\ServiceController::class, 'getByCompany']);
Route::delete('/services/{id}', [App\Http\Controllers\ServiceController::class, 'delete']);