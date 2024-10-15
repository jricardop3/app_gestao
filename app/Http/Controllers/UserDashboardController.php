<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\View\View;

class UserDashboardController extends Controller
{
    /**
     * Exibe a visão do painel do usuário.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $this->authorize('user-access');
        $user = auth()->user();
    
        // Usar consultas diretas na tabela 'accounts'
        $totalToPay = Account::where('user_id', $user->id)->where('status', 'pending')->sum('amount'); // ajuste 'pendente' para 'pending'
        $totalToReceive = Account::where('user_id', $user->id)->where('status', 'paid')->sum('amount'); // ajuste 'receber' para 'paid'
        $pendingCount = Account::where('user_id', $user->id)->where('status', 'pending')->count(); // ajuste 'pendente' para 'pending'
        $accounts = Account::where('user_id', $user->id)->get();
    
        return view('user-dashboard', compact('totalToPay', 'totalToReceive', 'pendingCount', 'accounts'));
    }
}
