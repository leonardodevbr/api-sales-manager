# Configurações do Projeto

<br>

Criar o arquivo .env

```sh
cp .env.example .env
```

<br>
Compilar a imagem do App

```sh
docker-compose build app
```

<br>
Iniciar os contâiners do projeto

```sh
docker-compose up -d
```

<br>
Acessar o bash do container

```sh
docker-compose exec app bash
```

<br>
Instalar as dependências do projeto

```sh
composer install
```

<br>
Gerar a key do projeto Laravel

```sh
php artisan key:generate
```

<br>
Gerar a key JWT

```sh
php artisan jwt:secret
```

<br>
Gerar as tabelas

```sh
php artisan migrate
```

<br>
Gerar dados falsos para testar a aplicação

```sh
php artisan db:seed
```

<br>
URL base da API

[http://localhost:8000/api/v1](http://localhost:8000/api/v1)

# Endpoints Disponíveis

## Autenticação

#### [POST] Login

```
/api/v1/auth/login
```

Body

```json
{
  "email": "admin@domain.com",
  "password": "password"
}
```

Response

```json
{
  "statusCode": 200,
  "data": {
    "access_token": "ACCESS_TOKEN",
    "token_type": "bearer",
    "expires_in": 3600
  },
  "message": "Autenticado com sucesso."
}
```

<br><br>

#### [POST] Logout

```
/api/v1/auth/logout
```

Headers

```json
{
  "Authorization": "Bearer {ACCESS_TOKEN}",
  "Content-Type": "application/json"
}
```

Body

```json
{
}
```

Response

```json
{
  "statusCode": 200,
  "data": [],
  "message": "Logout efetuado com sucesso."
}
```

<br><br>

#### [POST] Usuário Logado

```
/api/v1/auth/me
```

Headers

```json
{
  "Authorization": "Bearer {ACCESS_TOKEN}",
  "Content-Type": "application/json"
}
```

Body

```json
{
}
```

Response

```json
{
  "statusCode": 200,
  "data": {
    "id": 1,
    "email": "admin@domain.com",
    "created_at": "2022-03-24T03:24:47.000000Z",
    "updated_at": "2022-03-24T03:24:47.000000Z",
    "deleted_at": null
  },
  "message": "Dados do usuário logado."
}
```

<br><br>

#### [POST] Atualizar Token

```
/api/v1/auth/refresh
```

Headers

```json
{
  "Authorization": "Bearer {ACCESS_TOKEN}",
  "Content-Type": "application/json"
}
```

Body

```json
{
}
```

Response

```json
{
  "statusCode": 200,
  "data": {
    "access_token": "ACCESS_TOKEN",
    "token_type": "bearer",
    "expires_in": 3600
  },
  "message": "Token atualizado com sucesso."
}
```

<br><br>

## Clientes

#### [GET] Listar Clientes

```
/api/v1/customers
```

#### Parâmetros Opcionais
- sort_by (default:name)
- order_by (default:asc)
- limit (default:10)
<br><br>

Headers

```json
{
  "Authorization": "Bearer {ACCESS_TOKEN}",
  "Content-Type": "application/json"
}
```

Body

```json
{
}
```

Response

```json
{
  "statusCode": 200,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 7,
        "name": "Dr. Cláudio Zambrano",
        "cpf": "239.902.873-07",
        "birthdate": "04/08/2001"
      },
      {
        "id": 8,
        "name": "James Queirós Queirós",
        "cpf": "466.310.547-66",
        "birthdate": "20/05/1984"
      }
    ],
    "first_page_url": "http://localhost:8000/api/v1/customers?page=1",
    "from": 1,
    "next_page_url": "http://localhost:8000/api/v1/customers?page=2",
    "path": "http://localhost:8000/api/v1/customers",
    "per_page": "2",
    "prev_page_url": null,
    "to": 2
  },
  "message": "Lista de clientes."
}
```

<br><br>

#### [GET] Visualizar Cliente

```
/api/v1/customers/{customerId}
```

Headers

```json
{
  "Authorization": "Bearer {ACCESS_TOKEN}",
  "Content-Type": "application/json"
}
```

Body

```json
{
}
```

Response

```json
{
  "statusCode": 200,
  "data": {
    "id": 1,
    "name": "Cléber Sérgio de Aguiar Jr.",
    "cpf": "318.490.520-82",
    "birthdate": "24/12/1995",
    "created_at": "2022-03-24T03:24:47.000000Z",
    "updated_at": "2022-03-24T03:24:47.000000Z",
    "deleted_at": null
  },
  "message": "Dados do cliente #1."
}
```

<br><br>

#### [PUT] Cadastrar Cliente

```
/api/v1/customers
```

Headers

```json
{
  "Authorization": "Bearer {ACCESS_TOKEN}",
  "Content-Type": "application/json"
}
```

Body

```json
{
  "name": "Rogério Oliveira",
  "cpf": "068.591.073-35",
  "birthdate": "16/08/1996"
}
```

Response

```json
{
  "statusCode": 200,
  "data": {
    "name": "Rogério Oliveira",
    "cpf": "068.591.073-35",
    "birthdate": "16/08/1996",
    "updated_at": "2022-03-24T15:13:06.000000Z",
    "created_at": "2022-03-24T15:13:06.000000Z",
    "id": 12
  },
  "message": "Cliente cadastrado com sucesso!"
}
```

<br><br>

#### [POST] Atualizar Cliente

```
/api/v1/customers/{customerId}
```

Headers

```json
{
  "Authorization": "Bearer {ACCESS_TOKEN}",
  "Content-Type": "application/json"
}
```

Body

```json
{
  "name": "Rogério Oliveira",
  "cpf": "068.591.073-35",
  "birthdate": "16/08/1996"
}
```

Response

```json
{
  "statusCode": 200,
  "data": {
    "id": 11,
    "name": "Rogério N. Mendes",
    "cpf": "068.591.073-31",
    "birthdate": "22/01/1984",
    "created_at": "2022-03-24T14:57:15.000000Z",
    "updated_at": "2022-03-24T15:15:25.000000Z",
    "deleted_at": null
  },
  "message": "Cliente atualizado com sucesso!"
}
```

<br><br>

#### [DELETE] Remover Cliente

```
/api/v1/customers/{customerId}
```

Headers

```json
{
  "Authorization": "Bearer {ACCESS_TOKEN}",
  "Content-Type": "application/json"
}
```

Body

```json
{
}
```

Response

```json
{
  "statusCode": 200,
  "data": {
    "id": 12,
    "name": "Rogério Oliveira",
    "cpf": "068.591.073-35",
    "birthdate": "16/08/1996",
    "created_at": "2022-03-24T15:13:06.000000Z",
    "updated_at": "2022-03-24T15:16:00.000000Z",
    "deleted_at": "2022-03-24T15:16:00.000000Z"
  },
  "message": "Cliente removido com sucesso!"
}
```


<br><br>

## Produtos

#### [GET] Listar Produtos

```
/api/v1/products
```

#### Parâmetros Opcionais
- sort_by (default:name)
- order_by (default:asc)
- limit (default:10)
  <br><br>

Headers

```json
{
  "Authorization": "Bearer {ACCESS_TOKEN}",
  "Content-Type": "application/json"
}
```

Body

```json
{
}
```

Response

```json
{
  "statusCode": 200,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 75,
        "batch_id": 7,
        "code": "2022032469596",
        "name": "Alcantara",
        "color": "maroon",
        "description": "Quando tornei a olhar um para o padre, á tarde, em minha casa, prestava mais altenção que d'antes, e, segundo era louvor ou critica, assim me trazia gosto ou desgosto mais intensos que outr'ora.",
        "price": "123.06",
        "batch": {
          "id": 7,
          "code": "2022032410381563924",
          "manufacturing_date": "08/01/2022"
        }
      },
      {
        "id": 88,
        "batch_id": 10,
        "code": "2022032430618",
        "name": "Alves",
        "color": "green",
        "description": "Ainda agora tenho o éco aos meus ouvidos. O gosto que eu não podia entender tamanha explosão. É verdade que tambem sentia a secreta esperança de vel-a atirar-se a mim mesmo, e a gordura acabou com o.",
        "price": "248.88",
        "batch": {
          "id": 10,
          "code": "2022032410381534945",
          "manufacturing_date": "04/11/2021"
        }
      }
    ],
    "first_page_url": "http://localhost:8000/api/v1/products?page=1",
    "from": 1,
    "next_page_url": "http://localhost:8000/api/v1/products?page=2",
    "path": "http://localhost:8000/api/v1/products",
    "per_page": "2",
    "prev_page_url": null,
    "to": 2
  },
  "message": "Lista de produtos."
}
```

<br><br>

#### [GET] Visualizar Produto

```
/api/v1/products/{productId}
```

Headers

```json
{
  "Authorization": "Bearer {ACCESS_TOKEN}",
  "Content-Type": "application/json"
}
```

Body

```json
{
}
```

Response

```json
{
  "statusCode": 200,
  "data": {
    "id": 105,
    "batch_id": 10,
    "code": "2022032432212",
    "name": "Garrafa Térmica",
    "color": "blue",
    "description": "Garrafa de plástico com tampa metálica.",
    "price": "24.90",
    "batch": {
      "id": 10,
      "code": "2022032410381534945",
      "manufacturing_date": "04/11/2021"
    }
  },
  "message": "Dados do produto #105."
}
```

<br><br>

#### [PUT] Cadastrar Produto

```
/api/v1/products
```

Headers

```json
{
  "Authorization": "Bearer {ACCESS_TOKEN}",
  "Content-Type": "application/json"
}
```

Body

```json
{
  "batch_id": 10,
  "code": "2022032432212",
  "name": "Garrafa Térmica",
  "color": "blue",
  "description": "Garrafa de plástico com tampa metálica.",
  "price": "36.90"
}
```

Response

```json
{
  "statusCode": 200,
  "data": {
    "batch_id": 10,
    "code": "2022032432212",
    "name": "Garrafa Térmica",
    "color": "blue",
    "description": "Garrafa de plástico com tampa metálica.",
    "price": "24.90",
    "id": 105
  },
  "message": "Produto cadastrado com sucesso!"
}
```

<br><br>

#### [POST] Atualizar Produto

```
/api/v1/products/{productId}
```

Headers

```json
{
  "Authorization": "Bearer {ACCESS_TOKEN}",
  "Content-Type": "application/json"
}
```

Body

```json
{
  "batch_id": 10,
  "code": "2022032432212",
  "name": "Garrafa Térmica",
  "color": "blue",
  "description": "Garrafa de plástico com tampa metálica.",
  "price": "0.10"
}
```

Response

```json
{
  "statusCode": 200,
  "data": {
    "id": 98,
    "batch_id": 10,
    "code": "2022032432212",
    "name": "Garrafa Térmica",
    "color": "blue",
    "description": "Garrafa de plástico com tampa metálica.",
    "price": "0.10"
  },
  "message": "Produto atualizado com sucesso!"
}
```

<br><br>

#### [DELETE] Remover Produto

```
/api/v1/products/{productId}
```

Headers

```json
{
  "Authorization": "Bearer {ACCESS_TOKEN}",
  "Content-Type": "application/json"
}
```

Body

```json
{
}
```

Response

```json
{
  "statusCode": 200,
  "data": {
    "id": 100,
    "batch_id": 3,
    "code": "2022032460507",
    "name": "Galvão",
    "color": "fuchsia",
    "description": "Pio IX, grandes esperanças da Italia; mas ninguem pegou do assumpto; o principal da hora e do meu intento; imaginou que era alto e por longe, um toque. Depois, entrará em materia. Quer primeiro ver.",
    "price": "9.98"
  },
  "message": "Produto removido com sucesso!"
}
```