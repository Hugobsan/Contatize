# Contatize

O Contatize é uma aplicação desenvolvida para armazenar contatos de uma agenda telefônica. O Back-end da aplicação foi desenvolvida utilizando a linguagem de programação PHP, o framework Laravel e o banco de dados MySQL. O Front-end foi desenvolvido utilizando o Vue.js com o framework Vuetify e a biblioteca Tailwind CSS. A aplicação foi containerizada utilizando o Docker com o Laravel Sail e hospedada na Oracle Cloud.

## Apresentação da Aplicação

Você pode assistir ao vídeo de apresentação da aplicação clicando no link:
[Vídeo de Apresentação](https://youtu.be/nPCxp0pRZMI)

## Acesso à Aplicação

Acesse a aplicação através do link:
[Entrar na Aplicação](http://contatize.hugobsan.me)


## Funcionalidades

- Cadastro de contatos
- Edição de contatos
- Exclusão de contatos
- Listagem de contatos
- Pesquisa de contatos
- Visualização de detalhes de contatos
- Autenticação de usuários
- Edição de perfil de usuários

## Tecnologias Utilizadas

- PHP 8.2
- Laravel 11
- MySQL 8.0
- Vue.js
- Vuetify
- Tailwind CSS
- Docker

## Instalação

Para executar a aplicação localmente, é necessário ter o Docker e o Docker Compose instalados em sua máquina. Além do PHP 8.3, MYSQL e o Composer para instalar as dependências do Laravel.

### Para executar a aplicação localmente (Sem Docker), siga os passos abaixo:

1. Clone o repositório:

```bash
git clone https://github.com/Hugobsan/Contatize.git
```

2. Acesse a pasta do projeto:

```bash
cd Contatize/contatize-app
```

3. Instale as dependências do Composer:

```bash
composer install
```

4. Copie o arquivo .env.example para .env:

```bash
cp .env.example .env
```

5. Gere a chave da aplicação:

```bash
php artisan key:generate
```

6. Configure o arquivo .env com as informações do banco de dados:

7. Execute as migrações do banco de dados:

```bash
php artisan migrate --seed
```

8. Inicie os servidores do back-end e do front-end:

```bash
php artisan serve
```

```bash
npm run dev
```

9. Acesse a aplicação em seu navegador através do endereço http://localhost:8000

### Para executar a aplicação localmente com Docker, siga os passos abaixo:

1. Clone o repositório:

```bash
git clone
```

2. Acesse a pasta do projeto:

```bash
cd Contatize/contatize-app
```

3. Instale as dependências do Composer:

```bash
composer install
```

4. Inicie a aplicação com o Docker:

```bash
./vendor/bin/sail up -d
```

5. Execute as migrações do banco de dados:

```bash
./vendor/bin/sail artisan migrate --seed
```

6. Instale as dependências do front-end:

```bash
./vendor/bin/sail npm install
```

7. Compile os assets do front-end:

```bash
./vendor/bin/sail npm run dev
```

8. Acesse a aplicação em seu navegador através do endereço http://localhost
