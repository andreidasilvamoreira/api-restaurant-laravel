
---

# API Restaurante

API REST desenvolvida para gerenciamento de um sistema de restaurante, permitindo o controle de produtos, pedidos e categorias.

## 🛠️ Tecnologias
- PHP
- Laravel
- MySQL
- API REST

## 📂 Funcionalidades
- CRUD de produtos
- CRUD de categorias
- Registro de pedidos
- Relacionamento entre pedidos e itens

## 🧠 Conceitos aplicados
- RESTful APIs
- Validações de dados
- Relacionamentos One-to-Many
- Organização de camadas (Controller, Service, Repository)

## ▶️ Como executar o projeto
```bash
git clone https://github.com/seu-usuario/API-Restaurante.git
cd API-Restaurante
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
