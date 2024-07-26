# Contatize

O Contatize é uma aplicação desenvolvida para armazenar contatos de uma agenda telefônica. O Back-end da aplicação foi desenvolvida utilizando a linguagem de programação PHP, o framework Laravel e o banco de dados MySQL. O Front-end foi desenvolvido utilizando o Vue.js com o framework Vuetify e a biblioteca Tailwind CSS. A aplicação foi containerizada utilizando o Docker com o Laravel Sail e hospedada na Oracle Cloud.

## Acesso

A aplicação pode ser acessada através do link abaixo:


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

Para executar a aplicação localmente, siga os passos abaixo:

1. Clone o repositório:

```bash
git clone https://github.com/Hugobsan/Contatize.git
```

2. Acesse a pasta do projeto:

```bash
cd contatize-app
```

3. Execute o Laravel Sail:

```bash
./vendor/bin/sail up -d
```

4. Instale as dependências do Composer:

```bash
./vendor/bin/sail composer install
```

5. Instale as dependências do NPM:

```bash
./vendor/bin/sail npm install
```

6. Execute as migrações do banco de dados:

```bash
./vendor/bin/sail artisan migrate --seed
```

7. Crie um link simbólico para o armazenamento de arquivos:

```bash
./vendor/bin/sail artisan storage:link
```

8. Inicie o Vite:

```bash
./vendor/bin/sail npm run dev
```

9. Acesse a aplicação em seu navegador:

```
http://localhost
```