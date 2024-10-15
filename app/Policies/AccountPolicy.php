<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Account;

class AccountPolicy
{
    /**
     * Determine se o usuário pode editar a conta.
     */
    public function update(User $user, Account $account)
    {
        // Verifica se o usuário é o proprietário da conta ou tem permissão para editar
        return $user->id === $account->user_id || $user->role === 'admin';
    }

    /**
     * Determine se o usuário pode excluir a conta.
     */
    public function delete(User $user, Account $account)
    {
        return $user->id === $account->user_id; // Apenas o proprietário pode excluir
    }
}
