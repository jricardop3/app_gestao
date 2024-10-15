<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();  // ID da conta
            $table->string('title');  // Título da conta
            $table->text('description')->nullable();  // Descrição da conta (opcional)
            $table->decimal('amount', 10, 2);  // Valor da conta
            $table->date('due_date');  // Data de vencimento
            $table->enum('status', ['pending', 'paid']);  // Status da conta
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // ID do usuário associado
            $table->timestamps();  // Timestamps para created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
