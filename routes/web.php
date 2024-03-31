<?php
use App\Http\Controllers\StudentController;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia\Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('students', StudentController::class);
});
