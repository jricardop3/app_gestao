<?php

namespace Tests\Feature;

use App\Models\User; // Importa o modelo User
use App\Models\Account; // Importa o modelo Account
use Illuminate\Foundation\Testing\RefreshDatabase; // Importa o trait para reiniciar o banco de dados a cada teste
use Tests\TestCase; // Importa a classe base para testes

class UserAccountTest extends TestCase
{
    use RefreshDatabase; // Aplica o trait para garantir que o banco de dados seja limpo antes de cada teste

    protected User $user; // Declaração da propriedade $user para armazenar o usuário autenticado

    // Método que é executado antes de cada teste
    protected function setUp(): void
    {
        parent::setUp(); // Chama o método de configuração da classe pai
        $this->user = User::factory()->create(); // Cria um novo usuário usando uma fábrica
        $this->actingAs($this->user); // Autentica o usuário para que ele possa interagir com as rotas protegidas
    }

    /** @test */
    public function it_can_create_an_account()
    {
        // Envia uma solicitação POST para a rota que armazena uma nova conta
        $response = $this->post(route('user.accounts.store'), [
            'title' => 'Conta Teste', // Título da conta
            'description' => 'Descrição da conta teste', // Descrição da conta
            'amount' => 100.00, // Montante da conta
            'due_date' => '2024-12-31', // Data de vencimento
            'status' => 'pending', // Status da conta
        ]);

        // Verifica se a resposta redireciona para o dashboard do usuário
        $response->assertRedirect(route('user.dashboard'));
        // Verifica se a conta foi criada no banco de dados
        $this->assertDatabaseHas('accounts', [
            'title' => 'Conta Teste', // Verifica se o título está correto
            'user_id' => $this->user->id, // Verifica se a conta pertence ao usuário autenticado
        ]);
    }

    /** @test */
    public function it_can_edit_an_account()
    {
        // Cria uma conta para ser editada
        $account = Account::create([
            'title' => 'Conta Teste', // Título inicial da conta
            'description' => 'Descrição da conta teste', // Descrição inicial da conta
            'amount' => 100.00, // Montante inicial da conta
            'due_date' => '2024-12-31', // Data de vencimento inicial
            'status' => 'paid', // Status inicial da conta
            'user_id' => $this->user->id, // Define o usuário proprietário da conta
        ]);

        // Envia uma solicitação PUT para atualizar a conta existente
        $response = $this->put(route('user.accounts.update', $account), [
            'title' => 'Conta Editada', // Novo título da conta
            'description' => 'Descrição da conta editada', // Nova descrição da conta
            'amount' => 200.00, // Novo montante da conta
            'due_date' => '2025-01-31', // Nova data de vencimento
            'status' => 'paid', // Novo status da conta
        ]);

        // Verifica se a resposta redireciona para o dashboard do usuário
        $response->assertRedirect(route('user.dashboard'));
        // Verifica se a conta foi atualizada no banco de dados
        $this->assertDatabaseHas('accounts', [
            'title' => 'Conta Editada', // Verifica se o novo título está correto
            'user_id' => $this->user->id, // Verifica se a conta pertence ao usuário autenticado
        ]);
    }

    /** @test */
    public function it_can_delete_an_account()
    {
        // Cria uma conta para ser excluída
        $account = Account::create([
            'title' => 'Conta Teste', // Título da conta
            'description' => 'Descrição da conta teste', // Descrição da conta
            'amount' => 100.00, // Montante da conta
            'due_date' => '2024-12-31', // Data de vencimento
            'status' => 'paid', // Status da conta
            'user_id' => $this->user->id, // Define o usuário proprietário da conta
        ]);

        // Envia uma solicitação DELETE para remover a conta
        $response = $this->delete(route('user.accounts.destroy', $account));

        // Verifica se a resposta redireciona para o dashboard do usuário
        $response->assertRedirect(route('user.dashboard'));
        // Verifica se a conta foi removida do banco de dados
        $this->assertDatabaseMissing('accounts', [
            'id' => $account->id, // Verifica se a conta com o ID específico não está mais no banco de dados
        ]);
    }
}
