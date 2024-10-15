<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // Use a senha padrão para todos os usuários
            'role' => 'user', // Define o papel padrão como 'user'
            'email_verified_at' => now(), // Define o e-mail como verificado
            'remember_token' => Str::random(10),
        ];
    }
}
