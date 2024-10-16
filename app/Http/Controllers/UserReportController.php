<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Account; 
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserReportController extends Controller
{
    public function show(Request $request)
    {
        $this->authorize('admin-access');

        // Receber o ID do usuário selecionado no formulário
        $userId = $request->input('user_id'); 
        $month = $request->input('month'); // Receber o mês
        $year = $request->input('year');   // Receber o ano

        // Validar se o usuário foi selecionado
        if (!$userId) {
            return redirect()->back()->with('error', 'Por favor, selecione um usuário.');
        }

        // Obter as contas do usuário
        $accounts = Account::where('user_id', $userId);

        // Filtrar por mês e ano, se fornecido
        if ($month && $year) {
            $accounts->whereMonth('due_date', $month)
                     ->whereYear('due_date', $year);
        }

        $accounts = $accounts->get();

        // Obter o usuário
        $user = User::findOrFail($userId); // Obtém o usuário ou gera uma exceção se não encontrar

        // Calcular totais e contagens para contas a pagar
        $toPay = $accounts->where('title', 'pagar');
        $totalToPay = $toPay->sum('amount');
        $paidCountToPay = $toPay->where('status', 'paid')->count();
        $totalPaidToPay = $toPay->where('status', 'paid')->sum('amount');
        $pendingCountToPay = $toPay->where('status', 'pending')->count();
        $totalPendingToPay = $toPay->where('status', 'pending')->sum('amount');
        $overdueCountToPay = $toPay->where('status', 'pending')
                                   ->where('due_date', '<', now())->count();
        $totalOverdueToPay = $toPay->where('status', 'pending')
                                   ->where('due_date', '<', now())->sum('amount');

        // Calcular totais e contagens para contas a receber
        $toReceive = $accounts->where('title', 'receber');
        $totalToReceive = $toReceive->sum('amount');
        $paidCountToReceive = $toReceive->where('status', 'paid')->count();
        $totalPaidToReceive = $toReceive->where('status', 'paid')->sum('amount');
        $pendingCountToReceive = $toReceive->where('status', 'pending')->count();
        $totalPendingToReceive = $toReceive->where('status', 'pending')->sum('amount');
        $overdueCountToReceive = $toReceive->where('status', 'pending')
                                           ->where('due_date', '<', now())->count();
        $totalOverdueToReceive = $toReceive->where('status', 'pending')
                                           ->where('due_date', '<', now())->sum('amount');

        return view('admin.reports.user', compact(
            'user', // Passa o usuário para a view
            'totalToPay',
            'paidCountToPay',
            'totalPaidToPay',
            'pendingCountToPay',
            'totalPendingToPay',
            'overdueCountToPay',
            'totalOverdueToPay',
            'totalToReceive',
            'paidCountToReceive',
            'totalPaidToReceive',
            'pendingCountToReceive',
            'totalPendingToReceive',
            'overdueCountToReceive',
            'totalOverdueToReceive'
        ));
    }
}
