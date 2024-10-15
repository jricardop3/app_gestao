<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccountTest extends TestCase
{
    //use RefreshDatabase; // Para reiniciar o banco de dados entre os testes

    /** @test */
    public function admin_cannot_access_dashboard_if_not_authenticated()
    {
        $this->get(route('admin.dashboard'))
            ->assertRedirect(route('login')); // Verifique se redireciona para a página de login
    }

    /** @test */
    public function admin_can_access_dashboard()
    {
        $admin = User::factory()->create(['role' => 'admin']); // Supondo que você tenha um papel 'admin'
        
        $this->actingAs($admin)
            ->get(route('admin.dashboard'))
            ->assertStatus(200)
            ->assertViewIs('admin-dashboard'); // Verifique se a view correta é carregada
    }



    /** @test */
    public function admin_can_edit_account()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create();
        $account = Account::factory()->create(['user_id' => $user->id]);

        $this->actingAs($admin)
            ->get(route('admin.accounts.edit', $account->id))
            ->assertStatus(200) // Verifique se a página de edição carrega corretamente
            ->assertSee($account->title); // Verifique se o título da conta está na página
    }
    /** @test */
    public function admin_can_delete_account()
    {
        // Cria um admin e um usuário
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create();

        // Cria uma conta associada ao usuário
        $account = Account::factory()->create(['user_id' => $user->id]);

        // Ativa o admin
        $this->actingAs($admin)
            // Tenta deletar a conta
            ->delete(route('admin.accounts.destroy', $account->id))
            // Verifica se redireciona para a lista de contas
            ->assertRedirect(route('admin.accounts.index'));

        // Verifica se a conta foi realmente removida do banco de dados
        $this->assertDatabaseMissing('accounts', ['id' => $account->id]);
    }




}
