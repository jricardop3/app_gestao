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
    
        // Resumo das contas do usuário
        $totalToPay = Account::where('user_id', $user->id)->where('status', 'pending')->sum('amount'); // Total a pagar
        $totalToReceive = Account::where('user_id', $user->id)->where('status', 'paid')->sum('amount'); // Total a receber
        $pendingCount = Account::where('user_id', $user->id)->where('status', 'pending')->count(); // Contas pendentes

        // Paginação das contas do usuário
        $accounts = Account::where('user_id', $user->id)->paginate(10); // Paginar 10 contas por página
    
        return view('user-dashboard', compact('totalToPay', 'totalToReceive', 'pendingCount', 'accounts'));
    }
}
