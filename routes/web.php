<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Routes protégées par authentification
Route::middleware(['auth', 'verified'])->group(function () {

   Route::middleware(['auth', 'verified', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // CRUD Utilisateurs
        Route::get('/users', [AdminDashboardController::class, 'users'])->name('users.index');
        Route::get('/users/create', [AdminDashboardController::class, 'createUser'])->name('users.create');
        Route::post('/users', [AdminDashboardController::class, 'storeUser'])->name('users.store');
        Route::delete('/users/{user}', [AdminDashboardController::class, 'destroyUser'])->name('users.destroy');

        // CRUD Matériel (Catalogue Stock)
        Route::get('/hardware', [AdminDashboardController::class, 'hardware'])->name('hardware.index');
        Route::get('/hardware/create', [AdminDashboardController::class, 'createHardware'])->name('hardware.create');
        Route::post('/hardware', [AdminDashboardController::class, 'storeHardware'])->name('hardware.store');
        Route::get('/hardware/{hardware}/edit', [AdminDashboardController::class, 'editHardware'])->name('hardware.edit');
        Route::put('/hardware/{hardware}', [AdminDashboardController::class, 'updateHardware'])->name('hardware.update');
        Route::delete('/hardware/{hardware}', [AdminDashboardController::class, 'destroyHardware'])->name('hardware.destroy');

        // Licences & Attributions
        // CRUD Licences
        Route::get('/licenses', [AdminDashboardController::class, 'licenses'])->name('licenses.index');
        Route::get('/licenses/create', [AdminDashboardController::class, 'createLicense'])->name('licenses.create');
        Route::post('/licenses', [AdminDashboardController::class, 'storeLicense'])->name('licenses.store');
        Route::get('/licenses/{license}/edit', [AdminDashboardController::class, 'editLicense'])->name('licenses.edit');
        Route::put('/licenses/{license}', [AdminDashboardController::class, 'updateLicense'])->name('licenses.update');
        Route::delete('/licenses/{license}', [AdminDashboardController::class, 'destroyLicense'])->name('licenses.destroy');
        
        
        Route::get('/assignments', [AdminDashboardController::class, 'assignments'])->name('assignments.index');

        // Traçabilité / Logs
        Route::get('/logs', [AdminDashboardController::class, 'logs'])->name('logs.index');
    });

    // Espace Distributeur / Gestionnaire de stock
    Route::middleware(['role:distributor'])->prefix('distributor')->name('distributor.')->group(function () {
        Route::get('/dashboard', function () {
            return view('distributor.dashboard');
        })->name('dashboard');
    });

    // Espace Employé
    Route::middleware(['role:employee'])->prefix('employee')->name('employee.')->group(function () {
        Route::get('/dashboard', function () {
            return view('employee.dashboard');
        })->name('dashboard');
    });
});

require __DIR__.'/auth.php';