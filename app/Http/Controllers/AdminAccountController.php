<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;

class AdminAccountController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('admin-access');
        $user = auth()->user();
    
        // Obtém todos os usuários
        $users = User::all();
    
        // Resumo das contas de todos os usuários
        $totalToPay = Account::where('status', 'pending')->sum('amount'); // Total a pagar
        $totalToReceive = Account::where('status', 'paid')->sum('amount'); // Total a receber
        $pendingCount = Account::where('status', 'pending')->count(); // Contas pendentes
        
        // Filtra as contas com base no usuário selecionado
        $selectedUserId = $request->input('user_id');
        $allAccounts = Account::with('user')
            ->when($selectedUserId, function ($query, $selectedUserId) {
                return $query->where('user_id', $selectedUserId);
            })
            ->paginate(10); // Paginação das contas de todos os usuários (10 por página)
    
        return view('admin.accounts.index', compact('totalToPay', 'totalToReceive', 'pendingCount', 'allAccounts', 'users', 'selectedUserId'));
    }
    

    public function edit(Account $account)
    {
        $this->authorize('admin-access'); // Verifica se o usuário é admin
        return view('admin.accounts.edit', compact('account'));
    }

    public function update(Request $request, Account $account)
    {
        $this->authorize('admin-access'); // Verifica se o usuário é admin
    
        // Ajusta o valor de amount para o formato numérico
        $request['amount'] = str_replace(',', '.', $request['amount']);
    
        // Validação
        $validatedData = $request->validate([
            'title' => 'required|in:pagar,receber',
            'description' => 'nullable|string',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'status' => 'required|in:paid,pending',
        ]);
    
        try {
            // Atualizar a conta com os dados validados
            $account->update($validatedData);
    
            return redirect()->route('admin.accounts.index')->with('success', 'Conta atualizada com sucesso.');
        } catch (\Exception $e) {
            // Em caso de erro, redireciona com mensagem de erro
            return redirect()->route('admin.accounts.index')->with('error', 'Ocorreu um erro ao atualizar a conta.');
        }
    }
    
    
    
    

    public function destroy(Account $account)
    {
        $this->authorize('admin-access'); // Verifica se o usuário é admin

        try {
            $account->delete();
            return redirect()->route('admin.accounts.index')->with('success', 'Conta excluída com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao excluir a conta.');
        }
    }
}
