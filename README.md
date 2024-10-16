# Aplicação Web de Gestão de Contas a Pagar e Receber

## Introdução
Esta aplicação web foi desenvolvida para ajudar usuários a gerenciar suas contas a pagar e receber de forma eficiente. O sistema foi criado como parte de um teste para desenvolvedor full stack Laravel em nível júnior/pleno, com o objetivo de verificar o conhecimento e o nível de aprofundamento no framework Laravel e seu ecossistema.

### Recursos de uso obrigatório:
1. Eloquent ORM para gerenciar o banco de dados.
2. Migrations para criar e versionar a estrutura das tabelas.
3. Seeders para popular o banco de dados com dados fictícios.
4. Middleware para autenticação e controle de acesso.
5. Policies ou Gates para gerenciar permissões de usuários.
6. Laravel Blade para o sistema de templates e views.
7. Validation para validação de dados ao salvar contas a pagar e receber.
8. Laravel Mix para otimização de assets.
9. Testing usando PHPUnit e Laravel's testing utilities.
10. CSRF Protection embutida no Laravel para segurança.
11. **Chart.js** para visualização de dados de contas a pagar e receber.

### Requisitos e funcionalidades:
1. **Autenticação**:
   - O sistema deve permitir login de usuários usando os recursos de autenticação nativos do Laravel (Laravel Breeze ou Laravel Jetstream).
   - Cada usuário deve ter permissões diferentes:
     - Admin: Pode gerenciar contas e visualizar relatórios.
     - Usuário comum: Pode adicionar e visualizar suas próprias contas a pagar e receber.

2. **Contas a Pagar e Receber**:
   - Criar uma tabela com as seguintes colunas: título, descrição, valor, data de vencimento, status (pago/pendente).
   - Usuários comuns devem ser capazes de adicionar, editar e excluir suas próprias contas a pagar/receber.
   - O Admin deve ser capaz de visualizar todas as contas de todos os usuários.

3. **Segurança**:
   - Implementar proteção contra SQL Injection e Cross-Site Scripting (XSS).
   - Proteger as rotas com o middleware de autenticação do Laravel.
   - Garantir que as ações sejam realizadas somente por usuários autorizados (uso de policies e gates no Laravel).

4. **Testes**:
   - Criar testes unitários e testes de integração usando o framework PHPUnit que acompanha o Laravel.
   - Cobrir as funcionalidades básicas, como a criação e edição de contas, bem como as permissões de acesso.

5. **Documentação**:
   - Documentação básica de como rodar o projeto (pré-requisitos, instalação, rodar migrações, executar os testes, etc.).
   - Incluir exemplos de chamadas às APIs (se houver) ou instruções de como utilizar as principais funcionalidades.

6. **Uso do Git**:
   - Use Git para versionar o código.
   - Crie um repositório público ou privado e compartilhe o link ao enviar a entrega do teste.
   - Use commits descritivos para documentar o progresso do projeto.

---

### Ambiente de desenvolvimento:
- Apache 2.4.54
- PHP 8.2.20
- MySQL 8.0.30
- Laravel 10.48.22

### Pré-requisitos
- Composer (versão >= 2.5)
- Node.js (versão >= 16.0)
- npm (versão >= 7.0)
- PHP (versão >= 8.1)

### Dependências do Projeto:
- [Breeze (versão >= 1.29)](https://laravel.com/docs/10.x/starter-kits)
- [lucascudo/laravel-pt-BR-localization (versão >= 2.2.4)](https://github.com/lucascudo/laravel-pt-BR-localization)
- [Chart.js](https://www.chartjs.org/) para visualização de dados.

### Funcionalidades Implementadas
- [X] Autenticação de usuários com Laravel Breeze
- [X] Níveis de acesso (Admin e Usuário comum)
- [X] CRUD de contas a pagar e receber
- [X] Proteções de segurança (SQL Injection e XSS)
- [X] Testes unitários e de integração com PHPUnit
- [X] Visualização de dados usando Chart.js

### Instalação
1. **Clone o repositório:**
   - Execute o comando:
     git clone <link-do-repositório>


2. **Navegue até o diretório do projeto:**
   - Use o comando:

     cd nome-do-repositório


3. **Instale as dependências do PHP:**
   - Execute:
     composer install


4. **Instale as dependências do Node.js:**
   - Execute:

     npm install


5. **Copie o arquivo `.env.example` para `.env` e configure suas credenciais de banco de dados:**
   - Execute:
     cp .env.example .env

6. **Configure as informações de e-mail para verificação:**
   - Abra o arquivo `.env` e adicione ou ajuste as seguintes configurações:
     ```plaintext
     MAIL_MAILER=smtp
     MAIL_HOST=smtp.example.com
     MAIL_PORT=587
     MAIL_USERNAME=seu-email@example.com
     MAIL_PASSWORD=sua-senha
     MAIL_ENCRYPTION=tls
     MAIL_FROM_ADDRESS=seu-email@example.com
     MAIL_FROM_NAME="${APP_NAME}"
     ```
   - **Observação:** Substitua `smtp.example.com`, `seu-email@example.com` e `sua-senha` pelas suas configurações reais de e-mail.



7. **Rode as migrações para criar as tabelas no banco de dados:**
   - Execute:
     php artisan migrate
    

8. **(Opcional) Popule o banco de dados com dados fictícios:**
   - Execute:
     php artisan db:seed
    

9. **Inicie o servidor de desenvolvimento:**
   - Execute:
     php artisan serve
    

### Execução de Testes
- Para rodar os testes, use o comando:
   php artisan test
