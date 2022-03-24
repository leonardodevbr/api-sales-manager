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
php artisan migrate:fresh --seed
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

### Login

```
[POST] /api/v1/auth/login
```

Body

```json
{
  "email": "matias.vanessa@example.com",
  "password": "password"
}
```

Response

```json
{
  "access_token": "ACCESS_TOKEN",
  "token_type": "bearer",
  "expires_in": 3600
}
```

<br><br>

### Logout

```
[POST] /api/v1/auth/logout
```

Headers

```json
{
  "Authorization": "Bearer {{ACCESS_TOKEN}}",
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
  "message": "Successfully logged out"
}
```

<br><br>

### Usuário Logado

```
[POST] /api/v1/auth/me
```

Headers

```json
{
  "Authorization": "Bearer {{ACCESS_TOKEN}}",
  "Content-Type": "application/json"
}
```

Body

```json
{
  "id": 1,
  "email": "matias.vanessa@example.com",
  "created_at": "2022-03-23T22:50:48.000000Z",
  "updated_at": "2022-03-23T22:50:48.000000Z"
}
```

Response

```json
{
  "message": "Successfully logged out"
}
```

<br><br>

### Atualizar Token

```
[POST] /api/v1/auth/refresh
```

Headers

```json
{
  "Authorization": "Bearer {{ACCESS_TOKEN}}",
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
  "Authorization": "Bearer {{ACCESS_TOKEN}}",
  "token_type": "bearer",
  "expires_in": 3600
}
```

<br><br>

## Produtos

### Listar Produtos

```
[GET] /api/v1/products
```

Headers

```json
{
  "Authorization": "Bearer {{ACCESS_TOKEN}}",
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
[
  {
    "id": 1,
    "batch_id": 10,
    "code": "2022032398538",
    "name": "Garrafa Térmica",
    "color": "silver",
    "description": "Garrafa térmica com interior de vidro e capa metálica (...)",
    "price": 89.90,
    "formatted_price": "R$89,90",
    "created_at": "2022-03-23T22:50:49.000000Z",
    "updated_at": "2022-03-23T22:50:49.000000Z"
  },
  {
    ...
  }
]
```

<br><br>

### Visualizar Produto

```
[GET] /api/v1/products/:productId
```

Headers

```json
{
  "Authorization": "Bearer {{ACCESS_TOKEN}}",
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
[
  {
    "id": 1,
    "batch_id": 10,
    "code": "2022032398538",
    "name": "Garrafa Térmica",
    "color": "silver",
    "description": "Garrafa térmica com interior de vidro e capa metálica (...)",
    "price": 89.90,
    "formatted_price": "R$89,90",
    "created_at": "2022-03-23T22:50:49.000000Z",
    "updated_at": "2022-03-23T22:50:49.000000Z"
  },
  {
    ...
  }
]
```