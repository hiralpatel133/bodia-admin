<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\UserController;


Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login-submit', [LoginController::class, 'loginSubmit'])->name('login.submit');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    
    // Site Settings
    Route::get('settings', [SiteSettingController::class, 'index'])->name('admin.settings.index');
    Route::post('settings', [SiteSettingController::class, 'store'])->name('admin.settings.store');
    
    Route::post('/logout', [LoginController::class, 'logout'])->name('dashboard.logout');

    // Email Templates
    Route::resource('email-templates', EmailTemplateController::class, ['as' => 'admin']);
    Route::post('email-templates/{emailTemplate}/toggle-status', [EmailTemplateController::class, 'toggleStatus'])->name('admin.email-templates.toggle-status');

    // Users Management
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('admin.users.toggle-status');
    Route::post('users/{user}/toggle-cod-block', [UserController::class, 'toggleCodBlock'])->name('admin.users.toggle-cod-block');
    Route::get('users/export/{type}', [UserController::class, 'export'])->name('admin.users.export');
});