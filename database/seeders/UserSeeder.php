<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Criar um usuário admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Use a senha padrão
            'role' => 'admin', // Define o papel como 'admin'
            'email_verified_at' => now(), // Define o e-mail como verificado
        ]);

        // Criar 10 usuários fictícios com o papel de 'user'
        User::factory()->count(10)->create([
            'role' => 'user', // Garante que todos os usuários criados pela factory são 'user'
        ]);
    }
}
