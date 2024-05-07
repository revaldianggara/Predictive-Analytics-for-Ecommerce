<?php

use Illuminate\Support\Facades\Route;
use Modules\UserConfig\Http\Controllers\UserController;

$permission = 'user_config.user';
Route::prefix('admin/user_config/user')->name('admin.user_config.user.')->middleware(['auth'])->group(function () use ($permission) {
    Route::middleware(['permission:view ' . $permission])->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('datatable', [UserController::class, 'datatable'])->name('datatable');
        Route::get('show/{id}', [UserController::class, 'show'])->name('show');
    });
    Route::middleware(['permission:create ' . $permission])->group(function () {
        Route::get('create', [UserController::class, 'createGet'])->name('createGet');
        Route::post('create', [UserController::class, 'createPost'])->name('createPost');
    });
    Route::middleware(['permission:update ' . $permission])->group(function () {
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [UserController::class, 'update'])->name('update');
    });
    Route::middleware(['permission:delete ' . $permission])->group(function () {
        Route::delete('delete/{id}', [UserController::class, 'delete'])->name('delete');
    });
    Route::middleware(['permission:restore ' . $permission])->group(function () {
        Route::get('restore/{id}', [UserController::class, 'restore'])->name('restore');
    });
    Route::middleware(['permission:Super-Admin'])
        ->get('login/{id}', [UserController::class, 'loginAsUser'])->name('login.as.user');
});
