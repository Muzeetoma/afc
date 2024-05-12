<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index']);

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'view'])->name('login.view')->middleware('guest');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/logout', [App\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/signup', [App\Http\Controllers\Auth\RegisterUserController::class, 'view'])->name('signup.view');
Route::post('/signup', [App\Http\Controllers\Auth\RegisterUserController::class, 'register'])->name('signup');

Route::put('/users/update', [App\Http\Controllers\UserController::class, 'update'])->middleware('auth');
Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'delete'])->middleware('auth');

Route::get('/company/{id}', [App\Http\Controllers\CompanyController::class, 'getById'])->name('company.get');

Route::get('/admin/company/view', [App\Http\Controllers\Admin\AdminCompanyController::class, 'viewCompany'])->name('admin.company.view')->middleware('auth');
Route::get('/admin/company/create', [App\Http\Controllers\Admin\AdminCompanyController::class, 'viewCompanyCreate'])->name('admin.company.create.view')->middleware('auth');
Route::get('/admin/company/update/{id}', [App\Http\Controllers\Admin\AdminCompanyController::class, 'viewCompanyUpdate'])->name('admin.company.update.view')->middleware('auth');
Route::post('/admin/company', [App\Http\Controllers\Admin\AdminCompanyController::class, 'createCompany'])->name('admin.company.create')->middleware('auth');
Route::put('/admin/company/{id}', [App\Http\Controllers\Admin\AdminCompanyController::class, 'updateCompany'])->name('admin.company.update')->middleware('auth');
Route::delete('/admin/company/{id}', [App\Http\Controllers\Admin\AdminCompanyController::class, 'deleteCompany'])->name('admin.company.delete')->middleware('auth');

Route::get('admin/services/view/{id}', [App\Http\Controllers\Admin\AdminServiceController::class, 'viewService'])->name('admin.services.view')->middleware('auth');
Route::post('/admin/services/create', [App\Http\Controllers\Admin\AdminServiceController::class, 'createService'])->name('admin.services.create')->middleware('auth');
Route::get('/admin/services/create', [App\Http\Controllers\Admin\AdminServiceController::class, 'createServiceView'])->name('admin.services.create.view')->middleware('auth');
Route::get('/admin/services/update/{id}', [App\Http\Controllers\Admin\AdminServiceController::class, 'updateServiceView'])->name('admin.services.update.view')->middleware('auth');
Route::put('/admin/services/{id}', [App\Http\Controllers\Admin\AdminServiceController::class, 'updateService'])->name('admin.services.update')->middleware('auth');
Route::delete('/admin/services/{id}', [App\Http\Controllers\Admin\AdminServiceController::class, 'deleteService'])->name('admin.services.delete')->middleware('auth');