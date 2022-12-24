<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\Admin\Auth\AuthController;
use App\Http\Controllers\Dashboard\Admin\Auth\ProfileController;
use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Dashboard\Admin\ConsultationController;
use App\Http\Controllers\Dashboard\Admin\UserController;
use App\Http\Controllers\Dashboard\Admin\CategoreyController;
use App\Http\Controllers\Dashboard\Admin\SettingController;
use App\Http\Controllers\Dashboard\Admin\WelcomeController;


Route::get('/dashboard/login', [AuthController::class,'index'])->name('dashboard.login.index');
Route::post('/dashboard/login', [AuthController::class,'store'])->name('dashboard.login.store');
Route::post('/dashboard/logout', [AuthController::class,'logout'])->name('dashboard.logout');

Route::prefix('dashboard/admin')->name('dashboard.admin.')->middleware(['auth:admin'])->group(function () {

    Route::get('/', [WelcomeController::class,'index'])->name('welcome');

    // profile route
    Route::get('profile/edit', [ProfileController::class,'edit'])->name('profile.edit');
    Route::get('profile/password/edit', [ProfileController::class,'edit'])->name('profile.password.edit');
    Route::put('profile/update/{user}', [ProfileController::class,'update'])->name('profile.update');

    //admins routes
    Route::get('/admins/data', [AdminController::class, 'data'])->name('admins.data');
    Route::delete('/admins/bulk_delete', [AdminController::class, 'bulkDelete'])->name('admins.bulk_delete');
    Route::resource('admins', AdminController::class)->except(['show']);

    //roles routes
    Route::get('/roles/data', [AdminController::class, 'data'])->name('roles.data');
    Route::delete('/roles/bulk_delete', [AdminController::class, 'bulkDelete'])->name('roles.bulk_delete');
    Route::resource('roles', AdminController::class)->except(['show']);

    //consultations routes
    Route::get('/consultations/data', [ConsultationController::class, 'data'])->name('consultations.data');
    Route::delete('/consultations/bulk_delete', [ConsultationController::class, 'bulkDelete'])->name('consultations.bulk_delete');
    Route::resource('consultations', ConsultationController::class)->except(['show']);

    //categorys routes
    Route::get('/categorys/data', [CategoreyController::class, 'data'])->name('categorys.data');
    Route::delete('/categorys/bulk_delete', [CategoreyController::class, 'bulkDelete'])->name('categorys.bulk_delete');
    Route::resource('categorys', CategoreyController::class)->except(['show']);

    //users routes
    Route::get('/users/data', [UserController::class, 'data'])->name('users.data');
    Route::delete('/users/bulk_delete', [UserController::class, 'bulkDelete'])->name('users.bulk_delete');
    Route::resource('users', UserController::class)->except(['show']);

    //orders routes
    Route::resource('orders', OrderController::class);

    Route::get('/settings/social_links', [SettingController::class, 'social_links'])->name('settings.social_links');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');


}); //end of dashboard routes

