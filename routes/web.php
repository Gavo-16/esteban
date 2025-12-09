<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : redirect('/login');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function () {
    Route::get('/user/qr', [UserController::class, 'qr'])->name('user.qr');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Rutas de usuarios
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users.index');
    Route::post('/admin/users', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    
    // Rutas de eventos
    Route::get('/admin/events', [AdminController::class, 'events'])->name('admin.events.index');
    Route::post('/admin/events', [AdminController::class, 'createEvent'])->name('admin.events.create');
    Route::get('/admin/events/{id}/edit', [AdminController::class, 'editEvent'])->name('admin.events.edit');
    Route::put('/admin/events/{id}', [AdminController::class, 'updateEvent'])->name('admin.events.update');
    Route::delete('/admin/events/{id}', [AdminController::class, 'deleteEvent'])->name('admin.events.delete');
    
    // Rutas de asistencias
    Route::get('/admin/attendances', [AdminController::class, 'attendances'])->name('admin.attendances.index');
    Route::get('/admin/attendances/{eventId}/edit', [AdminController::class, 'editAttendances'])->name('admin.attendances.edit');
    Route::put('/admin/attendances/update', [AdminController::class, 'updateAttendances'])->name('admin.attendances.update');
    
    // Escáner
    Route::get('/admin/scanner', [AdminController::class, 'scanner'])->name('admin.scanner');
    Route::post('/admin/mark-attendance', [AdminController::class, 'markAttendance'])->name('admin.markAttendance');
});
