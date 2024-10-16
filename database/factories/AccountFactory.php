<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition()
    {
        return [
            'title' => $this->faker->randomElement(['pagar', 'receber']), // Títulos refletindo a necessidade
            'description' => $this->faker->text(100),
            'amount' => $this->faker->randomFloat(2, 10, 1000),  // Valor entre 10 e 1000
            'due_date' => $this->faker->dateTimeBetween('now', '+1 year'),  // Data de vencimento entre agora e um ano
            'status' => $this->faker->randomElement(['pending', 'paid']),  // Status aleatório
            'user_id' => User::inRandomOrder()->first()->id,  // Associar a um usuário existente
        ];
    }
}
