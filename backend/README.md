# qaas
## backend da aplicação

### Requisitos
* PHP >= v7.4
* Composer v2.*
* MySQL v5.7

### Instalação
* Depois de clonar o repositório, entre no diretório do projeto e instale as dependencias:
```sh
composer install
```

> Nessa etapa, o banco de dados já deve estar criado. As configurações de conexão com o banco de dados devem estar em um arquivo `.env` na raiz da aplicação contendo as variáveis descritas no arquivo de exemplo `.env.example`

* Depois de instalar as dependencias, rode as migrations para criar as tabelas necessárias no banco de dados:
```sh
php artisan migrate
```
> As seguintes tabelas serão criadas no banco de dados:

| questions    | dimensions |
| ---          | ---        |
| id           | id         |
| text         | name       |
| dimension_id | created_at |
| active       | updated_at |
| deleted_at   |            |
| created_at   |            |
| updated_at   |            |

* Inicie a aplicação:
```sh
 php -S <url:port> -t public
```

* Após isso, aplicação ficará disponível na `url:port` definidas.
