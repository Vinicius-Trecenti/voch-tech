# Projeto desenvolvido para o processo seletivo da Voch Tech

<div align="center">
  <img src="public/logo.svg" alt="logo" width="600">
</div>

> O Plus é um sistema simples utilizando Laravel que possui diversas funcionalidades e atende as solicitações do processo seletivo da Voch Tech.

## 📌 Funcionalidades
✅ CRUD de Grupos Econômicos 

✅ CRUD de Bandeiras 

✅ CRUD de Unidades

✅ CRUD de Colaboradores 

✅ Relatórios exportáveis (Excel)  

✅ Autenticação segura com Laravel Breeze  

✅ Auditoria com Observers e Jobs  

✅ Dashboard interativo com Livewire e Chart.js  


## 🛠️ Tecnologias Utilizadas
- **Laravel 11** 🏗️
- **Livewire** 👾  
- **Tailwind CSS** 🎨
- **TallstackUI** 🔥    
- **MySQL** 🐬


## 🔧 Como configurar o PLUS

###  Pré-requisitos
- PHP 8.1+
- Composer
- Node.js e NPM
- MySQL

## 📥 Comandos

1️⃣ Clone o repositório:  
```bash
git clone https://github.com/Vinicius-Trecenti/voch-tech.git
```

2️⃣ Instale as dependências:
```bash
composer install
npm install && npm run dev
```

3️⃣ Configure o arquivo .env:
```bash
cp .env.example .env
php artisan key:generate
```

4️⃣ Configure o banco de dados e rode as migrations e os seeders
```bash
php artisan migrate --seed
```

5️⃣ Inicie o servidor:

```bash
php artisan serve
```
Acesse http://127.0.0.1:8000 no navegador ou clique no link do terminal. 🎉

