<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserAccountTest extends TestCase
{
    use RefreshDatabase; // Descomente esta linha para usar o RefreshDatabase

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    /** @test */
    public function it_can_create_an_account()
    {
        $response = $this->post(route('user.accounts.store'), [
            'title' => 'pagar',
            'amount' => 100.00,
            'due_date' => '2024-12-31',
            'status' => 'pending',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('accounts', [
            'title' => 'pagar',
            'user_id' => $this->user->id,
        ]);
    }

    /** @test */
    public function it_can_edit_an_account()
    {
        // Cria uma conta associada ao usuário autenticado
        $account = Account::factory()->create(['user_id' => $this->user->id]);

        // Define os dados a serem enviados na requisição de edição
        $data = [
            'title' => 'receber',
            'description' => 'Teste de edição',
            'amount' => 100,
            'due_date' => now()->addDays(30)->toDateString(),
            'status' => 'pending',
        ];

        // Envia uma requisição PUT para atualizar a conta
        $response = $this->put(route('user.accounts.update', $account->id), $data);

        // Verifica se o redirecionamento foi para o dashboard e se a mensagem de sucesso está presente
        $response->assertRedirect('/dashboard');
        $response->assertSessionHas('success', 'Conta atualizada com sucesso.');

        // Verifica se os dados da conta foram atualizados no banco de dados
        $this->assertDatabaseHas('accounts', [
            'id' => $account->id,
            'title' => 'receber',
            'description' => 'Teste de edição',
            'amount' => 100,
            'due_date' => now()->addDays(30)->toDateString(),
            'status' => 'pending',
        ]);
    }

    /** @test */
    public function it_cannot_edit_another_users_account()
    {
        // Cria um usuário e uma conta associada a ele
        $owner = User::factory()->create();
        $account = Account::factory()->create(['user_id' => $owner->id]);

        // Faz login como um usuário diferente
        $this->actingAs($this->user);

        // Tenta editar a conta que pertence ao outro usuário
        $data = [
            'title' => 'receber',
            'amount' => 100,
            'due_date' => now()->addDays(30)->toDateString(),
            'status' => 'pending',
        ];

        $response = $this->put(route('user.accounts.update', $account->id), $data);

        // Verifica se o acesso foi negado (uma exceção deve ser lançada)
        $response->assertStatus(403);
    }

    /** @test */
    public function it_can_delete_an_account()
    {
        $account = Account::create([
            'title' => 'Conta Teste',
            'amount' => 100.00,
            'due_date' => '2024-12-31',
            'status' => 'paid',
            'user_id' => $this->user->id,
        ]);

        $response = $this->delete(route('user.accounts.destroy', $account));

        $response->assertRedirect('/dashboard');
        $this->assertDatabaseMissing('accounts', [
            'id' => $account->id,
        ]);
    }

    /** @test */
    public function it_cannot_delete_another_users_account()
    {
        // Cria um usuário e uma conta associada a ele
        $owner = User::factory()->create();
        $account = Account::factory()->create(['user_id' => $owner->id]);

        // Faz login como um usuário diferente
        $this->actingAs($this->user);

        // Tenta deletar a conta que pertence ao outro usuário
        $response = $this->delete(route('user.accounts.destroy', $account));

        // Verifica se o acesso foi negado (uma exceção deve ser lançada)
        $response->assertStatus(403);
    }
}
