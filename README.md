# App Gestão de pessoas
O App gestão de pessoas, foi desenvolvido para cumprir um teste para desenvolvedor full stack laravel em nível júnior/pleno, tem como objetivo verificar o conhecimento e nível de aprofundamento no framework laravel e seu ecosistema.
"Desenvolver uma aplicação web para controle de contas a pagar e receber usando o framework
Laravel. O sistema deve incluir autenticação de usuários, níveis de acesso, testes unitários,
segurança básica e uma documentação simples."
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
10. CSRF Protection embutida no Laravel para segurança.anco de dados.
### Requisitos e funcionalidades:
1. Autenticação:
- O sistema deve permitir login de usuários usando os recursos de autenticação nativos do
Laravel (Laravel Breeze ou Laravel Jetstream).
- Cada usuário deve ter permissões diferentes:
- Admin: Pode gerenciar contas e visualizar relatórios.
- Usuário comum: Pode adicionar e visualizar suas próprias contas a pagar e receber.
2. Contas a Pagar e Receber:
- Criar uma tabela com as seguintes colunas: título, descrição, valor, data de vencimento, status
(pago/pendente).
- Usuários comuns devem ser capazes de adicionar, editar e excluir suas próprias contas a
pagar/receber.
- O Admin deve ser capaz de visualizar todas as contas de todos os usuários.
3. Segurança:
- Implementar proteção contra SQL Injection e Cross-Site Scripting (XSS).
- Proteger as rotas com o middleware de autenticação do Laravel.
- Garantir que as ações sejam realizadas somente por usuários autorizados (uso de policies e
gates no Laravel).
4. Testes:
- Criar testes unitários e testes de integração usando o framework PHPUnit que acompanha o
Laravel.
- Cobrir as funcionalidades básicas, como a criação e edição de contas, bem como as permissões
de acesso.
5. Documentação:
- Documentação básica de como rodar o projeto (pré-requisitos, instalação, rodar migrações,
executar os testes, etc.).
- Incluir exemplos de chamadas às APIs (se houver) ou instruções de como utilizar as principais
funcionalidades.
6. Uso do Git:
- Use Git para versionar o código.
- Crie um repositório público ou privado e compartilhe o link ao enviar a entrega do teste.
- Use commits descritivos para documentar o progresso do projeto.
<hr/>

### Ambiente de desenvolvimento:
- Apache 2.4.54
- PHP 8.2.20
- MySQL 8.0.30
- Laravel 10.48.22

### Pré-requisitos
- Composer (versão >= 2.5)
- Node.js (versão >= 16.0)
- npm (versão >= 7.0)
- PHP (versão >= 8.1 )

### Dependências do Projeto:
- Breeze (versão >= 1.29)

### Funcionalidades Implementadas
- [ ] Autenticação de usuários com Laravel Breeze
- [ ] Níveis de acesso (Admin e Usuário comum)
- [ ] CRUD de contas a pagar e receber
- [ ] Proteções de segurança (SQL Injection e XSS)
- [ ] Testes unitários e de integração com PHPUnit
