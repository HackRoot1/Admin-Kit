<?php

use App\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;

// Auth Routes
Route::view('login', 'auth.sign-in')->name('auth.sign-in');
Route::view('register', 'auth.sign-up')->name('auth.sign-up');
Route::view('reset-password', 'auth.reset-password')->name('auth.reset-password');

// Dashboard & User Related Routes
Route::get('/', function () {
    return view('index');
})->name('index');
Route::view('profile-settings', 'settings.profile')->name('settings.profile');
Route::view('settings', 'settings.settings')->name('settings.settings');



// Staff Related Routes
Route::view('staffs-index', 'staffs.index')->name('staffs.index');
Route::view('staffs-create', 'staffs.create')->name('staffs.create');
Route::view('staffs-store', 'staffs.store')->name('staffs.store');
Route::view('staffs-edit', 'staffs.edit')->name('staffs.edit');
Route::view('staffs-update', 'staffs.update')->name('staffs.update');
Route::view('staffs-delete', 'staffs.delete')->name('staffs.delete');
Route::view('staffs-view', 'staffs.view')->name('staffs.view');

// Roles Related Routes
Route::controller(RolesController::class)->group(function() {
    Route::get('roles-index', 'index')->name('roles.index');
    Route::view('roles-create', 'roles.create')->name('role.create');
    Route::post('roles-store', 'store')->name('role.store');
    Route::get('roles-edit/{id}', 'edit')->name('role.edit');
    Route::put('roles-update/{id}', 'update')->name('role.update');
    Route::delete('roles-delete/{id}', 'destroy')->name('role.destroy');
    Route::get('roles-show/{id}', 'show')->name('role.show');
});

// Roles Related Routes
Route::view('permissions-index', 'permissions.index')->name('permissions.index');
Route::view('permissions-create', 'permissions.create')->name('permissions.create');
Route::view('permissions-store', 'permissions.store')->name('permissions.store');
Route::view('permissions-edit', 'permissions.edit')->name('permissions.edit');
Route::view('permissions-update', 'permissions.update')->name('permissions.update');
Route::view('permissions-delete', 'permissions.delete')->name('permissions.delete');
Route::view('permissions-view', 'permissions.view')->name('permissions.view');

// Tasks Related Routes
Route::view('tasks-index', 'tasks.index')->name('tasks.index');
Route::view('tasks-create', 'tasks.create')->name('tasks.create');
Route::view('tasks-store', 'tasks.store')->name('tasks.store');
Route::view('tasks-edit', 'tasks.edit')->name('tasks.edit');
Route::view('tasks-update', 'tasks.update')->name('tasks.update');
Route::view('tasks-delete', 'tasks.delete')->name('tasks.delete');
Route::view('tasks-view', 'tasks.view')->name('tasks.view');

// Invoice Related Routes
Route::view('invoices', 'invoices.invoice')->name('invoices.index');
Route::view('payments', 'invoices.payments')->name('invoices.payments');
Route::view('checkout', 'invoices.checkout')->name('invoices.checkout');

// Activity Log
Route::view('activity-log', 'activity-log')->name('activity.log');
Route::view('chat', 'chat')->name('chat');

// Fallbacks & Error Routes
Route::view('404', '404')->name('404');
