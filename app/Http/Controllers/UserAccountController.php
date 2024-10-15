<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    public function index()
    {

        $accounts = Account::where('user_id', auth()->id())->get();
        return view('user.accounts.index', compact('accounts'));
    }
    
    
    

    public function create()
    {
        return view('user.accounts.create');
    }

    public function store(Request $request)
    {
        // Validação
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'status' => 'required|in:paid,pending', // Exemplo de status
        ]);
    
        try {
            // Criar nova conta e associar ao usuário autenticado
            $account = new Account($validatedData); // Usa os dados validados
            $account->user_id = auth()->id(); // Associar a conta ao usuário autenticado
            $account->save(); // Salvar a conta no banco de dados
    
            // Redirecionar de volta à lista de contas com uma mensagem de sucesso
            return redirect()->route('user.dashboard')->with('success', 'Conta criada com sucesso.');
        } catch (\Exception $e) {
            // Se houver uma exceção, redirecionar de volta para a rota de criação com uma mensagem de erro
            return redirect()->route('user.accounts.create')->withErrors(['error' => 'Erro ao criar conta: ' . $e->getMessage()])->withInput();
        }
    }
    
    

    public function edit(Account $account)
    {
        // Verificar se o usuário pode editar essa conta
        $this->authorize('update', $account);
        
        // Retornar a view de edição com a conta
        return view('user.accounts.edit', compact('account'));
    }

    public function update(Request $request, Account $account)
    {
        // Validação
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'status' => 'required|in:paid,pending',
        ]);

        // Atualizar a conta
        $account->update($request->all());

        return redirect()->route('user.dashboard')->with('success', 'Conta atualizada com sucesso.');
    }

    public function destroy(Account $account)
    {
        // Verificar se o usuário pode excluir essa conta
        $this->authorize('delete', $account);
        $account->delete();

        return redirect()->route('user.dashboard')->with('success', 'Conta excluída com sucesso.');
    }
}
