<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AdminAccountController extends Controller
{
    public function index()
    {
        $this->authorize('admin-access');
        $user = auth()->user();
    
        // Resumo das contas de todos os usuários
        $totalToPay = Account::where('status', 'pending')->sum('amount'); // Total a pagar
        $totalToReceive = Account::where('status', 'paid')->sum('amount'); // Total a receber
        $pendingCount = Account::where('status', 'pending')->count(); // Contas pendentes
        
        // Paginação das contas de todos os usuários (10 por página)
        $allAccounts = Account::with('user')->paginate(10); // Defina o número desejado de registros por página
    
        return view('admin.accounts.index', compact('totalToPay', 'totalToReceive', 'pendingCount', 'allAccounts'));
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
            'title' => 'required|string|max:255',
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
