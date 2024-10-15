<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AdminAccountController extends Controller
{
    public function index()
    {
        // Obter todas as contas
        $accounts = Account::all();
        return view('admin.accounts.index', compact('accounts'));
    }

    public function edit(Account $account)
    {
        return view('admin.accounts.edit', compact('account'));
    }

    public function update(Request $request, Account $account)
    {
        // Validação
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'status' => 'required|in:pago,pendente',
        ]);

        // Atualizar a conta
        $account->update($request->all());

        return redirect()->route('admin.accounts.index')->with('success', 'Conta atualizada com sucesso.');
    }

    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()->route('admin.accounts.index')->with('success', 'Conta excluída com sucesso.');
    }
}
