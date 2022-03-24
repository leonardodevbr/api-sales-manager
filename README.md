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
  "data": [
    {
      "id": 1,
      "name": "Cléber Sérgio de Aguiar Jr.",
      "cpf": "318.490.520-82",
      "birthdate": "24/12/1995",
      "created_at": "2022-03-24T03:24:47.000000Z",
      "updated_at": "2022-03-24T03:24:47.000000Z",
      "deleted_at": null
    },
    {
      "id": 2,
      "name": "Caio Feliciano Neto",
      "cpf": "821.156.731-05",
      "birthdate": "19/07/1955",
      "created_at": "2022-03-24T03:24:47.000000Z",
      "updated_at": "2022-03-24T03:24:47.000000Z",
      "deleted_at": null
    }
  ]
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