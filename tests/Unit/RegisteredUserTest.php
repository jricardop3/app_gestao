<?php
namespace Tests\Unit\Auth;

use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class RegisteredUserTest extends TestCase
{
    //Reseta o banco de dados
    use RefreshDatabase; 

    public function test_registration_validation(): void
    {
        // Cria uma instância do controlador
        $controller = new RegisteredUserController();

        // Cenário de dados válidos
        $validData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        // Simula uma requisição com os dados válidos
        $request = Request::create('/register', 'POST', $validData);

        // Verifica se a validação é bem-sucedida
        try {
            $controller->store($request);
            $this->assertTrue(true); // A validação foi bem-sucedida
        } catch (ValidationException $e) {
            //Registra o erro no log do laravel, caso ocorra.
            Log::error('Erro de validação durante o teste de registro.', [
                'exception' => $e->getMessage(),
                'data' => $validData,
            ]);
            $this->fail('Validação falhou para dados válidos.');
        }
    }

    public function test_registration_fails_with_invalid_email(): void
    {
        $controller = new RegisteredUserController();

        // Cenário de email inválido
        $invalidData = [
            'name' => 'Test User',
            'email' => 'invalid-email',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        // Simula uma requisição com email inválido
        $request = Request::create('/register', 'POST', $invalidData);

        // Verifica se a validação falha
        $this->expectException(ValidationException::class);
        //Registra o erro proposital no log.
        Log::error('Erro erro esperado com e-mail inválido.', [
            'data' => $invalidData,
        ]);
        $controller->store($request);
    }

    public function test_registration_fails_when_password_confirmation_does_not_match(): void
    {
        $controller = new RegisteredUserController();

        // Cenário de senha e confirmação de senha que não coincidem
        $invalidData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'different-password',
        ];

        // Simula uma requisição com confirmação de senha incorreta
        $request = Request::create('/register', 'POST', $invalidData);

        // Verifica se a validação falha
        $this->expectException(ValidationException::class);
        $controller->store($request);
    }

    public function test_registration_fails_when_required_fields_are_missing(): void
    {
        $controller = new RegisteredUserController();

        // Cenário de campos obrigatórios ausentes
        $invalidData = [
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        // Simula uma requisição com o campo 'name' ausente
        $request = Request::create('/register', 'POST', $invalidData);

        // Verifica se a validação falha
        $this->expectException(ValidationException::class);
        $controller->store($request);
    }
}

