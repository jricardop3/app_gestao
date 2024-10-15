<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardAccessTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa se um admin pode acessar o painel do admin.
     *
     * @return void
     */
    public function test_admin_can_access_admin_dashboard()
    {
        $admin = User::factory()->create(['role' => 'admin']); // Cria um usuário admin
        $response = $this->actingAs($admin)->get('/admin-dashboard');

        $response->assertStatus(200); // Espera que o status da resposta seja 200 (OK)
    }

    /**
     * Testa se um usuário comum não pode acessar o painel do admin.
     *
     * @return void
     */
    public function test_user_cannot_access_admin_dashboard()
    {
        $user = User::factory()->create(['role' => 'user']); // Cria um usuário comum
        $response = $this->actingAs($user)->get('/admin-dashboard');

        $response->assertStatus(403); // Espera que o status da resposta seja 403 (Forbidden)
    }

    /**
     * Testa se um usuário comum pode acessar seu próprio painel.
     *
     * @return void
     */
    public function test_user_can_access_user_dashboard()
    {
        $user = User::factory()->create(['role' => 'user']); // Cria um usuário comum
        $response = $this->actingAs($user)->get('/user-dashboard');

        $response->assertStatus(200); // Espera que o status da resposta seja 200 (OK)
    }

    /**
     * Testa se um admin não pode acessar o painel do usuário.
     *
     * @return void
     */
    public function test_admin_cannot_access_user_dashboard()
    {
        $admin = User::factory()->create(['role' => 'admin']); // Cria um usuário admin
        $response = $this->actingAs($admin)->get('/user-dashboard');

        $response->assertStatus(403); // Espera que o status da resposta seja 403 (Forbidden)
    }
}
