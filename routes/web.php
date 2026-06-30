<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login')->name('home');

Route::get('/dashboard', function () {
    $role = request()->user()?->role;

    return match ($role) {
        'production_manager' => redirect()->route('PMdashboard'),
        'administrator' => redirect()->route('Adashboard'),
        'super_admin' => redirect()->route('SAdashboard'),
        default => inertia('dashboard'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::view('/production/dashboard', 'production_manager.PMdashboard')
        ->name('PMdashboard');

    Route::view('/admin/dashboard', 'administrator.Adashboard')
        ->name('Adashboard');

    Route::view('/super/dashboard', 'super_admin.SAdashboard')
        ->name('SAdashboard');
});

require __DIR__.'/settings.php';
