<?php

use Illuminate\Support\Facades\Route;
use Modules\UserConfig\Http\Controllers\PermissionController;

$permission = 'user_config.role';

Route::prefix('admin/user_config')->name('admin.user_config.')->middleware(['auth'])->group(function () use ($permission) {
    Route::prefix('permission')->name('role.')->group(function () use ($permission) {
        Route::middleware(['permission:view ' . $permission])->group(function () {
            Route::get('/', [PermissionController::class, 'index'])->name('index');
            Route::get('show/{id}', [PermissionController::class, 'show'])->name('show');
        });
        Route::middleware(['permission:update ' . $permission])->group(function () {
            Route::post('update/{id}', [PermissionController::class, 'update'])->name('update');
        });
        Route::middleware(['permission:delete ' . $permission])->group(function () {
            Route::get('delete/{id}', [PermissionController::class, 'delete'])->name('delete');
        });
        Route::middleware(['permission:create ' . $permission])->group(function () {
            Route::get('create', [PermissionController::class, 'createGet'])->name('createGet');
            Route::post('create', [PermissionController::class, 'createPost'])->name('createPost');
        });
    });
});
