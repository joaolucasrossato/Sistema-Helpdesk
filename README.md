# HelpDesk — Sistema de Gerenciamento de Chamados

Sistema web para abertura, acompanhamento e resolução de chamados de suporte técnico, desenvolvido com Laravel. Projeto criado como portfólio para demonstrar habilidades em desenvolvimento back-end PHP/Laravel, modelagem de banco de dados relacional, autenticação, API REST e boas práticas de desenvolvimento.

## Funcionalidades

### Chamados
- Criação de chamados com título, descrição, categoria e prioridade (Baixa, Média, Alta)
- Listagem com indicação visual de prioridade e status
- Alteração de status (Aberto → Em andamento → Resolvido)
- Visualização detalhada com histórico de comentários
- Exclusão com confirmação

### Categorias
- CRUD completo (criar, listar, editar, excluir)

### Comentários
- Sistema de comentários dentro de cada chamado, com autor e data

### Histórico de alterações
- Registro automático de mudanças de status, com autor e data/hora

### Dashboard
- Cartões com total de chamados, e contagem por status (Aberto, Em andamento, Resolvido)

### Autenticação
- Login, registro e gerenciamento de perfil (via Laravel Breeze)

### API REST
- Autenticação via token (Laravel Sanctum)
- Endpoints para listar, criar, atualizar e excluir chamados via JSON
- Testada e documentada com coleção Postman

## Tecnologias utilizadas

| Categoria | Tecnologia |
|---|---|
| Linguagem | PHP 8.4 |
| Framework | Laravel 13 |
| Banco de dados | MySQL |
| Autenticação web | Laravel Breeze |
| Autenticação API | Laravel Sanctum |
| Front-end | Blade, Bootstrap 5, CSS customizado |
| Testes | Pest PHP |
| Versionamento | Git |

## Testes automatizados

O projeto conta com 35 testes automatizados (Pest), cobrindo:
- Autenticação e gerenciamento de perfil
- CRUD de chamados (criação, atualização de status, exclusão)
- Comentários
- Endpoints da API REST, incluindo casos de acesso não autenticado

Para rodar os testes:
```bash
php artisan test
```

## Instalação e execução local

### Pré-requisitos
- PHP 8.4+
- Composer
- MySQL
- Node.js e npm

### Passos

```bash
# Clonar o repositório
https://github.com/joaolucasrossato/Sistema-Helpdesk.git
cd helpdesk

# Instalar dependências
composer install
npm install

# Configurar ambiente
cp .env.example .env
php artisan key:generate

# Configurar as credenciais do banco no arquivo .env
# DB_DATABASE=helpdesk
# DB_USERNAME=root
# DB_PASSWORD=

# Rodar migrations e popular o banco com dados de exemplo
php artisan migrate:fresh --seed

# Compilar os assets
npm run build

# Iniciar o servidor
php artisan serve
```

Acesse `http://127.0.0.1:8000`

### Credenciais de teste (criadas pelo Seeder)

| Campo | Valor |
|---|---|
| E-mail | admin@helpdesk.com |
| Senha | password |

## Testando a API

A API é autenticada via Bearer Token (Laravel Sanctum).

| Método | Endpoint | Descrição | Autenticação |
|---|---|---|---|
| POST | `/api/login` | Login e geração de token | Não |
| POST | `/api/logout` | Revoga o token atual | Sim |
| GET | `/api/tickets` | Lista todos os chamados | Sim |
| POST | `/api/tickets` | Cria um novo chamado | Sim |
| GET | `/api/tickets/{id}` | Detalhe de um chamado | Sim |
| PUT | `/api/tickets/{id}` | Atualiza um chamado | Sim |
| DELETE | `/api/tickets/{id}` | Remove um chamado | Sim |

Uma coleção Postman pronta para testes está disponível em [`docs/postman/API Helpdesk.postman_collection.json`](docs/postman/API%20Helpdesk.postman_collection.json). Importe no Postman, use o endpoint `/api/login` para gerar um token, e cole-o como Bearer Token nas demais requisições.

## Estrutura do banco de dados

- **users** — usuários do sistema
- **categories** — categorias de chamado (ex: Erro Impressora, Erro no Sistema)
- **tickets** — chamados, relacionados a um usuário (autor) e uma categoria
- **comments** — comentários vinculados a um chamado e um usuário
- **histories** — histórico de alterações de status de cada chamado
