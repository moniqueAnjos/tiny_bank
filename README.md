<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Sobre

Tiny Bank é um banco simples que simula transações entre usuários comuns e lojistas.

# Começando

## Instalação

Por favor, verifique o guia oficial de instalação do laravel para os requisitos do servidor antes de começar. [Documentação Oficial](https://laravel.com/docs/5.4/installation#installation)

Clonar o repositório

    git clone https://github.com/moniqueAnjos/tiny_bank.git

Mudar para a pasta repo

    cd tiny_bank

Instale todas as dependências usando o composer

    composer install

Copie o arquivo .env de exemplo e faça as alterações de configuração necessárias no arquivo .env

    cp .env.example .env

Execute as migrações de banco de dados (**Defina a conexão de banco de dados em .env antes de migrar**)

    php artisan migrate

Inicie o servidor de desenvolvimento local

    php artisan serve

Agora você pode acessar o servidor em http://localhost:8000

**Lista de comandos**

    git clone https://github.com/moniqueAnjos/tiny_bank.git
    cd laravel-realworld-example-app
    composer install
    cp .env.example .env
    
**Certifique-se de definir as informações de conexão de banco de dados corretas antes de executar as** [variáveis ​​de ambiente de migração](#environment-variables)

    php artisan migrate
    php artisan serve

## Seeder

**O seeder de usuário possui valores fixos gerados.**

Abra o UserSeeder se preferir inserir valores conforme sua necessidade

    database/seeds/UserSeeder.php

Execute o seeder no banco e pronto

    php artisan db:seed

***Observação*** : é recomendável ter um banco de dados limpo antes de rodar. Você pode atualizar suas migrações a qualquer momento para limpar o banco de dados executando o seguinte comando

    php artisan migrate:refresh
    
----------

# Visão geral do código

## Pastas

- `app/Models` - Contém todos os modelos Eloquent
- `app/Exceptions` - Contém todos os tratamentos de erro para saidas padronizadas
- `app/Http/Controllers` - Contém todos os controladores de API
- `app/Http/Requests` - Contém todas as solicitações de formulário de API
- `app/Interfaces` - Contém todas as interfaces criadas
- `app/Repositories` - Contém todas os repositórios criados
- `app/Services` - Contém s lógica necessária para executar as regras de negocio
- `config` - Contém todos os arquivos de configuração do aplicativo
- `database/factories` - Contém a fábrica de modelos para todos os modelos
- `database/migrations` - Contém todas as migrações de banco de dados
- `database/seeds` - Contém a carga ficticia do banco de dados
- `routes` - Contém todas as rotas da api definidas no arquivo api.php
- `storage/api-docs` - Contém o json gerado pelo swagger para a documentação viva
- `tests/Feature` - Contém o teste de integração da aplicação

## Variáveis de ambiente

- `.env` - Variáveis ​​de ambiente podem ser definidas neste arquivo

***Nota*** : Você pode definir rapidamente as informações do banco de dados e outras variáveis ​​nesse arquivo e fazer com que o aplicativo funcione totalmente.

----------
# Documentação (swagger)

    #Para acessar a documentação da api utilize a url
    # Com o servidor rodando
    http://127.0.0.1:8000/api/doc

----------
# Autor

 <img style="border-radius: 50%;" src="https://avatars.githubusercontent.com/u/24610980?v=4" width="100px;" alt=""/>
 <br />
 <sub><b>Monique Arcanjo</b></sub>💪

👋🏽 Entre em contato!

 [![Linkedin Badge](https://img.shields.io/badge/-Monique-blue?style=flat-square&logo=Linkedin&logoColor=white&link=https://www.linkedin.com/in/monique-arcanjo-524564ba/)](https://www.linkedin.com/in/monique-arcanjo-524564ba/)
[![Gmail Badge](https://img.shields.io/badge/-monique.santos22.ms@gmail.com-c14438?style=flat-square&logo=Gmail&logoColor=white&link=monique.santos22.ms@gmail.com)](monique.santos22.ms@gmail.com)