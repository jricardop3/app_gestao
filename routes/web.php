<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    // Verifica se o usuário está autenticado
    if (auth()->check()) {
        // Verifica o papel do usuário e redireciona para o painel apropriado
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    }

    // Se o usuário não estiver autenticado, redirecione para a página de login
    return redirect()->route('login');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rota para o painel do admin, protegida pelo gate 'admin-access'
    Route::get('/admin-dashboard', [AdminDashboardController::class, 'index'])
        ->middleware('can:admin-access')
        ->name('admin.dashboard');

    // Rota para o painel do usuário, protegida pelo gate 'user-access'
    Route::get('/user-dashboard', [UserDashboardController::class, 'index'])
        ->middleware('can:user-access')
        ->name('user.dashboard');
});



require __DIR__.'/auth.php';
