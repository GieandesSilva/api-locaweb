## API LOCAWEB

O que você encontra aqui:
    
    * web-base   - Um serviço com ALPINE + NGINX
    * app-base   - Um serviço com ALPINE + PHP7.2-fpm + Laravel 5.7
    * db-base    - Um serviço com MYSQL5.7

## Instalação

* Faça o clone do projeto:

```bash
    git clone https://github.com/GieandesSilva/api-locaweb.git [nome-do-projeto]
```

* Entre na pasta [nome-do-projeto] e rode:

```bash
    docker-compose up -d
```

* Verifique se os containers estão de pé [opcional]:

```bash
    docker ps
```

* Acesse o container do aplicativo para instalar as dependências:

```bash
    docker exec -ti app-base sh
```
    
* Dentro do container execute os comandos:
    
```bash
    * Instale as dependências com composer:
    
        composer install

    * Faça uma cópia do .env.example:

        cp .env.example .env

    * Altere as permissões do .env:
    
        chgrp 1000 .env && chown 1000 .env

    * Gere a chave para o aplicativo:
    
        php artisan key:generate

    * Permita o acesso as subpastas do storage:
    
        chmod 777 -R storage/

    * Gere as tabelas utilizadas na autenticação:
    
        php artisan migrate

    * Instale o passport para utilização da autenticação:

        php artisan passport:install
        
        * Esse comando irá gerar as chaves que deverão ser utilizadas nos próximos passos, mantenha armazenados os valores em algum local.
            # Este é um exemplo do retorno do comando:
            Client ID: 1
            Client secret: WYaZnApKKLZZV8A35LOws7chWibrhcA2I0pEFXYC
            Password grant client created successfully.
            Client ID: 2
            Client secret: tHrtmPttcx1iTJV1XxQTnJbLQLvRdqkLaVlqwjDA


    * No env, altere as variáveis com os valores das chaves geradas do segundo cliente

        # Exemplo: 
        VUE_APP_API_CLIENT_ID="2"
        VUE_APP_API_CLIENT_SECRET= "tHrtmPttcx1iTJV1XxQTnJbLQLvRdqkLaVlqwjDA"
```

* Verifique o seu projeto rodando no link:

```bash
    http://localhost:8000/
```
            
## :D
Agora Vamos fazer o download do cliente.

## Nós
[Gieandes Silva](http://gieandessilva.com)
