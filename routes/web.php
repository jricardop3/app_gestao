<?php

use App\Http\Controllers\AdminAccountController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserReportController;
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

    // Rotas para o usuário
    Route::prefix('user/accounts')->name('user.accounts.')->group(function () {
        Route::get('/', [UserAccountController::class, 'index'])->name('index');
        Route::get('/create', [UserAccountController::class, 'create'])->name('create');
        Route::post('/', [UserAccountController::class, 'store'])->name('store');
        Route::get('/{account}/edit', [UserAccountController::class, 'edit'])->name('edit');
        Route::put('/{account}', [UserAccountController::class, 'update'])->name('update');
        Route::delete('/{account}', [UserAccountController::class, 'destroy'])->name('destroy');
    });

    // Rotas para o administrador
    Route::prefix('admin/accounts')->name('admin.accounts.')->group(function () {
        Route::get('/', [AdminAccountController::class, 'index'])->name('index');
        Route::get('/create', [AdminAccountController::class, 'create'])->name('create');
        Route::get('/{account}/edit', [AdminAccountController::class, 'edit'])->name('edit');
        Route::put('/{account}', [AdminAccountController::class, 'update'])->name('update');
        Route::delete('/{account}', [AdminAccountController::class, 'destroy'])->name('destroy');
    });

    // Rotas para o relatório do usuario
    Route::post('/admin/reports/user', [UserReportController::class, 'show'])->name('admin.reports.user');
});



require __DIR__.'/auth.php';
