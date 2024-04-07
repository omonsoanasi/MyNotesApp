<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth','verified'])->group(function () {
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
    Route::get('/role/{role}/add-permissions', [RoleController::class, 'addPermission'])->name('role.add-permissions');
    Route::put('role/{role}/give-permissions', [RoleController::class, 'givePermission'])->name('role.give-permissions');
    Route::resource('user', UserController::class);
});

Route::redirect('/', '/note')->name('dashboard');

Route::middleware(['auth','verified'])->group(function () {
    Route::resource('note', NoteController::class);
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
