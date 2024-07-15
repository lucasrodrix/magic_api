# Documentação do Projeto API RESTful - Magic: The Gathering

## Introdução
Este documento fornece uma visão geral do projeto de desenvolvimento de uma API RESTful para gerenciamento de cartas do jogo Magic: The Gathering. O projeto utiliza PHP 7.*, MySQL 5.7, e Slim Framework 3 para roteamento, seguindo padrões de design orientado a objetos.

# Componentes Principais

## 1. Configuração (`config/`)
- **settings.php**: Configurações globais da aplicação, incluindo configurações do banco de dados, chave secreta JWT, e diretório de cache.
- **dependencies.php**: Configuração do container de injeção de dependência (DIC) para Slim Framework, configurando Eloquent ORM para MySQL e Symfony Cache.

## 2. Ponto de Entrada (`public/index.php`)
- **index.php**: Arquivo de entrada que inicializa o aplicativo Slim, define o fuso horário, configura dependências e registra rotas.

## 3. Rotas (`routes/routes.php`)
- **routes.php**: Define todos os endpoints da API, agrupados por funcionalidade (autenticação, edições e cartas), usando controllers e middleware para gerenciamento de requisições.

## 4. Controladores (`src/Controllers/`)
- **AuthController.php**: Controlador para autenticação de usuários. Implementa métodos para login e logout utilizando JWT.
- **CardController.php**: Controlador para gerenciamento de cartas. Implementa CRUD para cartas e listagem com caching.
- **EditionController.php**: Controlador para gerenciamento de edições. Implementa CRUD para edições.

## 5. Middleware (`src/Middleware/`)
- **AuthMiddleware.php**: Middleware para autenticação de rotas protegidas por JWT. Verifica a presença e validade do token JWT em cada requisição.

## 6. Modelos (`src/Models/`)
- **User.php**: Modelo para usuários, mapeando a tabela `users` do banco de dados.
- **Card.php**: Modelo para cartas, mapeando a tabela `cards` e definindo relacionamento com edições.
- **Edition.php**: Modelo para edições, mapeando a tabela `editions`.

## 7. Arquivos Adicionais
- **composer.json**: Arquivo de configuração do Composer, especificando autoload e dependências do projeto.
- **bancodedados.sql**: Script SQL para criação das tabelas `users`, `editions` e `cards`.

# Funcionalidades Implementadas

## Autenticação
- **Login**: Endpoint POST `/api/login` para autenticar usuários e gerar token JWT.
- **Logout**: Endpoint POST `/api/logout` para finalizar sessão (não requer servidor-side logout com JWT).

## Gerenciamento de Edições
- CRUD completo para edições:
  - GET `/api/editions/list` para listar todas as edições.
  - GET `/api/editions/list/{id}` para obter detalhes de uma edição específica.
  - POST `/api/editions/create` para criar uma nova edição.
  - PUT `/api/editions/update/{id}` para atualizar uma edição existente.
  - DELETE `/api/editions/delete/{id}` para excluir uma edição.

## Gerenciamento de Cartas
- CRUD completo para cartas:
  - GET `/api/cards/list/{id}` para obter detalhes de uma carta específica.
  - POST `/api/cards/create` para criar uma nova carta.
  - PUT `/api/cards/update/{id}` para atualizar uma carta existente.
  - DELETE `/api/cards/delete/{id}` para excluir uma carta.
- Listagem pública com caching:
  - GET `/api/cards/list` lista todas as cartas com caching para melhor desempenho.

## Proteção e Segurança
- Todos os endpoints de edições e cartas são protegidos por autenticação JWT usando middleware `AuthMiddleware`.

## Padrões e Tecnologias Utilizadas
- Utilização de PHP 7.*, MySQL 5.7, Slim Framework 3 para roteamento, Eloquent ORM para acesso ao banco de dados, Symfony Cache para caching, e Firebase JWT para autenticação JWT.

## Pontos Extras
- Implementação de caching para listagem pública de cartas.
- Estrutura organizada e modularizada utilizando MVC e Dependency Injection.
