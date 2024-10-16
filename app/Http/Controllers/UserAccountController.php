<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    public function create()
    {
        return view('user.accounts.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|in:pagar,receber',
            'description' => 'nullable|string',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'status' => 'required|in:paid,pending',
        ]);

        try {
            $account = new Account($validatedData);
            $account->user_id = auth()->id();
            $account->save();

            return redirect('/dashboard')->with('success', 'Conta criada com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('user.accounts.create')->withErrors(['error' => 'Erro ao criar conta: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit(Account $account)
    {
        // Verifica se o usuário tem permissão para editar a conta
        $this->authorize('update', $account);

        return view('user.accounts.edit', compact('account'));
    }

    public function update(Request $request, Account $account)
    {
        // Validação dos dados
        $validatedData = $request->validate([
            'title' => 'required|in:pagar,receber',
            'description' => 'nullable|string',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'status' => 'required|in:paid,pending',
        ]);

        // Atualiza a conta
        $this->authorize('update', $account); // Verifica a autorização antes de atualizar
        $account->update($validatedData);

        return redirect('/dashboard')->with('success', 'Conta atualizada com sucesso.');
    }

    public function destroy(Account $account)
    {
        // Verifica se o usuário tem permissão para deletar a conta
        $this->authorize('delete', $account);
        $account->delete();

        return redirect('/dashboard')->with('success', 'Conta excluída com sucesso.');
    }
}
