<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index']);

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'view'])->name('login.view')->middleware('guest');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login')->middleware('guest');

Route::get('/signup', [App\Http\Controllers\Auth\RegisterUserController::class, 'view'])->name('signup.view');
Route::post('/signup', [App\Http\Controllers\Auth\RegisterUserController::class, 'register'])->name('signup');

Route::put('/users/update', [App\Http\Controllers\UserController::class, 'update'])->middleware('auth');
Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'delete'])->middleware('auth');

Route::post('/companies', [App\Http\Controllers\CompanyController::class, 'create'])->middleware('auth');
Route::put('/companies', [App\Http\Controllers\CompanyController::class, 'update'])->middleware('auth');
Route::delete('/companies/{id}', [App\Http\Controllers\CompanyController::class, 'delete'])->middleware('auth');
Route::get('/company/view', [App\Http\Controllers\CompanyController::class, 'view'])->name('company.view')->middleware('auth');
Route::get('/company/{id}', [App\Http\Controllers\CompanyController::class, 'getById'])->name('company.get');

Route::get('/services/view', [App\Http\Controllers\ServiceController::class, 'view'])->name('services.view')->middleware('auth');
Route::post('/services', [App\Http\Controllers\ServiceController::class, 'create'])->name('services.create')->middleware('auth');
Route::put('/services/update', [App\Http\Controllers\ServiceController::class, 'update'])->middleware('auth');
Route::get('/services/{companyId}', [App\Http\Controllers\ServiceController::class, 'getByCompany']);
Route::delete('/services/{id}', [App\Http\Controllers\ServiceController::class, 'delete'])->middleware('auth');