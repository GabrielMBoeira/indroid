# Manezinho Ixtepô

Aplicação web do **Manezinho Ixtepô** — o pescador mais brincalhão da Ilha da Magia — em **Laravel + Vue 3 + Inertia + Tailwind CSS**.

Jogo de perguntas e respostas para impressionar os amigos, com visual de manezinho catarinense.

## Stack

- Laravel 13
- Vue 3 (Composition API)
- Inertia.js
- Tailwind CSS 4
- SQLite (padrão local; MySQL/Postgres via `.env`)

## Requisitos

- PHP 8.3+
- Composer
- Node 22+
- SQLite (ou outro banco configurado)

## Instalação

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
npm install
npm run dev
```

Em outro terminal:

```bash
php artisan serve
```

Abra `http://localhost:8000`.

Para produção:

```bash
npm run build
```

O document root do servidor deve apontar para `public/`.

## Contas de demonstração (após `db:seed`)

| Perfil | E-mail | Senha |
| --- | --- | --- |
| Admin | gabrielmboeira@gmail.com | password |
| Usuário ativo | demo@indroid.com.br | password |
| Usuário pendente | pendente@indroid.com.br | password |

## Funcionalidades

- Home com o Ixtepô (pescador estilo Pixar) e texto animado
- Cadastro, login, recuperação e alteração de senha
- Termo de responsabilidade e página de contato
- Jogo **Perguntar** (o manezinho “adivinha” a resposta digitada em segredo)
- Liberação de cadastro via Mercado Pago (PIX quando `MERCADOPAGO_ACCESS_TOKEN` estiver definido)
- Painel admin para liberar usuários e ler mensagens

## Mercado Pago

Defina no `.env`:

```
MERCADOPAGO_ACCESS_TOKEN=seu_token
MERCADOPAGO_PAYMENT_LINK=https://mpago.la/2bzTRGg
INDROID_PRICE=5
```

O webhook continua em `POST /notificacao`. Sem token, o cadastro fica pendente e o usuário usa o link de pagamento configurado.

## Testes

```bash
php artisan test
```
