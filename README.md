# Configurações do Projeto

Para rodar este projeto é necessário ter o [Docker](https://www.docker.com/) instalado na sua máquina.
<br><br>
Caso já o tenha instalado, faça o clone do projeto e siga as instruções abaixo.
<br>
<br>

1 - Criar o arquivo .env

```sh
cp .env.example .env
```

<br>
2 - Compilar a imagem do App

```sh
docker-compose build app
```

<br>
3 - Iniciar os contâiners do projeto

```sh
docker-compose up -d
```

<br>
4 - Acessar o bash do container

```sh
docker-compose exec app bash
```

<br>
5 - Instalar as dependências do projeto

```sh
composer install
```

<br>
6 - Gerar a key do projeto Laravel

```sh
php artisan key:generate
```

<br>
7 - Gerar a key para o JWT

```sh
php artisan jwt:secret
```

<br>
8 - Criar o arquivo do banco de dados SQLite

```sh
touch database/database.sqlite
```

<br>
9 - Gerar as tabelas

```sh
php artisan migrate
```

<br>
10 - Gerar dados falsos para testar a aplicação

```sh
php artisan db:seed
```

<br>

### Agora já deve ser possível acessar os endpoints da aplicação.

A Collection do Postman disponibilizada acima já deve ter as configurações necessárias para testar a API. <br>

- [x] Variável {{host}} com a URL base do projeto;
- [x] Variável {{token}} que será preenchida automaticamente após login;
- [x] Método de autenticação global com Bearer Token;

OBS: Não é necessário configurar o método de autenticação nos endpoints, pois já estão pegando a configuração global da
Collection.

<br>
URL base da API

[http://localhost:8000/api/v1](http://localhost:8000/api/v1)

# Endpoints Disponíveis

## Autenticação

#### [POST] Login

```
/auth/login
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
/auth/logout
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
/auth/me
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
/auth/refresh
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
/customers
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
/customers/{customerId}
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
/customers
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
/customers/{customerId}
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
/customers/{customerId}
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
/products
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
/products/{productId}
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
/products
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
/products/{productId}
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
/products/{productId}
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

<br><br>

## Pedidos

#### [GET] Listar Vendedores

```
/sellers
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
        "id": 2,
        "user_id": 5,
        "name": "Cláudia Sepúlveda",
        "cnpj": "24.115.925/6801-28",
        "user": {
          "id": 5,
          "email": "suelen17@example.net"
        }
      },
      {
        "id": 6,
        "user_id": 12,
        "name": "Rogério N Oliveira",
        "cnpj": "34.055.665/0001-01",
        "user": {
          "id": 12,
          "email": "adsleonardo.o@gmail.com"
        }
      }
    ],
    "first_page_url": "http://localhost:8000/api/v1/sellers?page=1",
    "from": 1,
    "next_page_url": "http://localhost:8000/api/v1/sellers?page=2",
    "path": "http://localhost:8000/api/v1/sellers",
    "per_page": "2",
    "prev_page_url": null,
    "to": 2
  },
  "message": "Lista de vendedores."
}
```

<br><br>

#### [GET] Visualizar Vendedor

```
/sellers/{sellerId}
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
    "user_id": 3,
    "name": "Srta. Priscila Fidalgo Jr.",
    "cnpj": "01.010.084/8161-42",
    "user": {
      "id": 3,
      "email": "nestrada@example.net"
    }
  },
  "message": "Dados do vendedor #1."
}
```

<br><br>

#### [PUT] Cadastrar Vendedor

```
/sellers
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
  "cnpj": "34.055.665/0001-01",
  "email": "adsleonardo.o@gmail.com",
  "password": "123456"
}
```

Response

```json
{
  "statusCode": 200,
  "data": {
    "user_id": 13,
    "name": "Rogério Oliveira",
    "cnpj": "34.055.665/0001-01",
    "id": 7,
    "user": {
      "id": 13,
      "email": "adsleonardo.o@gmail.com"
    }
  },
  "message": "Vendedor cadastrado com sucesso!"
}
```

<br><br>

#### [POST] Atualizar Vendedor

```
/sellers/{sellerId}
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
  "name": "Rogério N Oliveira",
  "cnpj": "34.055.665/0001-01"
}
```

Response

```json
{
  "statusCode": 200,
  "data": {
    "id": 6,
    "user_id": 12,
    "name": "Rogério N Oliveira",
    "cnpj": "34.055.665/0001-01",
    "user": {
      "id": 12,
      "email": "adsleonardo.o@gmail.com"
    }
  },
  "message": "Vendedor atualizado com sucesso!"
}
```

<br><br>

#### [DELETE] Remover Vendedor

```
/sellers/{sellerId}
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
    "id": 7,
    "user_id": 13,
    "name": "Rogério Oliveira",
    "cnpj": "34.055.665/0001-01",
    "user": {
      "id": 13,
      "email": "adsleonardo.o@gmail.com"
    }
  },
  "message": "Vendedor removido com sucesso!"
}
```

<br><br>

## Pedidos

#### [GET] Listar Pedidos

```
/orders
```

#### Parâmetros Opcionais

- sort_by (default:amount)
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
        "id": 2,
        "seller_id": 1,
        "customer_id": 1,
        "amount": "387.71",
        "code": "240322033448FVRQJU",
        "created_at": "2022-03-24T18:34:48.000000Z",
        "customer": {
          "id": 1,
          "name": "George Santana",
          "cpf": "187.266.373-71",
          "birthdate": "11/01/1992"
        },
        "seller": {
          "id": 1,
          "user_id": 9,
          "name": "Maximiano Gusmão Filho",
          "cnpj": "56.323.600/1115-57"
        },
        "products": [
          {
            "id": 1,
            "batch_id": 4,
            "code": "2022032409398",
            "name": "Lira",
            "color": "navy",
            "description": "Passeámos alguns minutos compridos, até que o espirito do meu coração, se vontade de minha mãe, antes de qualquer trabalho effectivo por parte de José Dias; eu já fazia esforços, leitor amigo. Não.",
            "price": "172.29",
            "pivot": {
              "order_id": "2",
              "product_id": "1"
            }
          },
          {
            "id": 6,
            "batch_id": 6,
            "code": "2022032402405",
            "name": "Camacho",
            "color": "blue",
            "description": "Mamãe é boa de mais; dá-lhe attenção de Capitú ia respondendo promptamente e bem. Trazia um vestidinho melhor e os olhos de prima Justina, passeando de um commerciante de objectos americanos. Estava.",
            "price": "168.14",
            "pivot": {
              "order_id": "2",
              "product_id": "6"
            }
          },
          {
            "id": 8,
            "batch_id": 9,
            "code": "2022032473082",
            "name": "Montenegro",
            "color": "lime",
            "description": "Talvez esperasse uma menina. Não disse mal della; ao contrario das pessoas que enxovalham depressa o vestido novo, elle trazia o velho tenor, durará emquanto durar o theatro, não se póde? --Póde-se.",
            "price": "47.28",
            "pivot": {
              "order_id": "2",
              "product_id": "8"
            }
          }
        ]
      },
      {
        "id": 1,
        "seller_id": 2,
        "customer_id": 4,
        "amount": "653.85",
        "code": "240322033411BY2B2N",
        "created_at": "2022-03-24T18:34:11.000000Z",
        "customer": {
          "id": 4,
          "name": "Dr. Kléber Júlio de Souza Neto",
          "cpf": "518.576.030-59",
          "birthdate": "15/11/1998"
        },
        "seller": {
          "id": 2,
          "user_id": 1,
          "name": "Valentina Valentin Rezende Jr.",
          "cnpj": "27.896.578/6701-90"
        },
        "products": [
          {
            "id": 3,
            "batch_id": 1,
            "code": "2022032443482",
            "name": "Paes",
            "color": "fuchsia",
            "description": "Como vês, Capitú, aos quatorze annos, alta, forte e atrevido. Não imitava ninguem; não vivia com rapazes, que me acompanham para todos os meus olhos longos, constantes, enfiados nelles, e á isto.",
            "price": "253.76",
            "pivot": {
              "order_id": "1",
              "product_id": "3"
            }
          },
          {
            "id": 7,
            "batch_id": 6,
            "code": "2022032407961",
            "name": "Campos",
            "color": "aqua",
            "description": "Era ainda bonita e moça, mas teimava em dizer que conferia, rotulava e pregava na memoria a minha vida se casa bem á definição. Cantei um _duo_ ternissimo, depois um _trio_, depois um _quatuor..._.",
            "price": "193.93",
            "pivot": {
              "order_id": "1",
              "product_id": "7"
            }
          },
          {
            "id": 2,
            "batch_id": 7,
            "code": "2022032428055",
            "name": "Valente",
            "color": "purple",
            "description": "Depois, ainda falou gravemente e longamente sobre a nuca por um latim que ninguem apprende, e é a opinião dos imparciaes. Os amigos que me achava em momento tão grave; obedeci, a principio não disse.",
            "price": "206.16",
            "pivot": {
              "order_id": "1",
              "product_id": "2"
            }
          }
        ]
      }
    ],
    "first_page_url": "http://localhost:8000/api/v1/orders?page=1",
    "from": 1,
    "next_page_url": null,
    "path": "http://localhost:8000/api/v1/orders",
    "per_page": "2",
    "prev_page_url": null,
    "to": 2
  },
  "message": "Lista de pedidos."
}
```

<br><br>

#### [GET] Visualizar Pedido

```
/orders/{orderId}
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
    "id": 2,
    "seller_id": 1,
    "customer_id": 1,
    "amount": "387.71",
    "code": "240322033448FVRQJU",
    "created_at": "2022-03-24T18:34:48.000000Z",
    "customer": {
      "id": 1,
      "name": "George Santana",
      "cpf": "187.266.373-71",
      "birthdate": "11/01/1992"
    },
    "seller": {
      "id": 1,
      "user_id": 9,
      "name": "Maximiano Gusmão Filho",
      "cnpj": "56.323.600/1115-57"
    },
    "products": [
      {
        "id": 1,
        "batch_id": 4,
        "code": "2022032409398",
        "name": "Lira",
        "color": "navy",
        "description": "Passeámos alguns minutos compridos, até que o espirito do meu coração, se vontade de minha mãe, antes de qualquer trabalho effectivo por parte de José Dias; eu já fazia esforços, leitor amigo. Não.",
        "price": "172.29",
        "pivot": {
          "order_id": "2",
          "product_id": "1"
        }
      },
      {
        "id": 6,
        "batch_id": 6,
        "code": "2022032402405",
        "name": "Camacho",
        "color": "blue",
        "description": "Mamãe é boa de mais; dá-lhe attenção de Capitú ia respondendo promptamente e bem. Trazia um vestidinho melhor e os olhos de prima Justina, passeando de um commerciante de objectos americanos. Estava.",
        "price": "168.14",
        "pivot": {
          "order_id": "2",
          "product_id": "6"
        }
      },
      {
        "id": 8,
        "batch_id": 9,
        "code": "2022032473082",
        "name": "Montenegro",
        "color": "lime",
        "description": "Talvez esperasse uma menina. Não disse mal della; ao contrario das pessoas que enxovalham depressa o vestido novo, elle trazia o velho tenor, durará emquanto durar o theatro, não se póde? --Póde-se.",
        "price": "47.28",
        "pivot": {
          "order_id": "2",
          "product_id": "8"
        }
      }
    ]
  },
  "message": "Dados do pedido #2."
}
```

<br><br>

#### [PUT] Cadastrar Pedido

```
/orders
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
  "seller_id": "1",
  "customer_id": "1",
  "products_id": [
    1,
    6,
    8
  ]
}
```

Response

```json
{
  "statusCode": 200,
  "data": {
    "seller_id": 1,
    "customer_id": 1,
    "code": "240322033448FVRQJU",
    "amount": "387.71",
    "created_at": "2022-03-24T18:34:48.000000Z",
    "id": 2,
    "customer": {
      "id": 1,
      "name": "George Santana",
      "cpf": "187.266.373-71",
      "birthdate": "11/01/1992"
    },
    "seller": {
      "id": 1,
      "user_id": 9,
      "name": "Maximiano Gusmão Filho",
      "cnpj": "56.323.600/1115-57"
    },
    "products": [
      {
        "id": 1,
        "batch_id": 4,
        "code": "2022032409398",
        "name": "Lira",
        "color": "navy",
        "description": "Passeámos alguns minutos compridos, até que o espirito do meu coração, se vontade de minha mãe, antes de qualquer trabalho effectivo por parte de José Dias; eu já fazia esforços, leitor amigo. Não.",
        "price": "172.29",
        "pivot": {
          "order_id": "2",
          "product_id": "1"
        }
      },
      {
        "id": 6,
        "batch_id": 6,
        "code": "2022032402405",
        "name": "Camacho",
        "color": "blue",
        "description": "Mamãe é boa de mais; dá-lhe attenção de Capitú ia respondendo promptamente e bem. Trazia um vestidinho melhor e os olhos de prima Justina, passeando de um commerciante de objectos americanos. Estava.",
        "price": "168.14",
        "pivot": {
          "order_id": "2",
          "product_id": "6"
        }
      },
      {
        "id": 8,
        "batch_id": 9,
        "code": "2022032473082",
        "name": "Montenegro",
        "color": "lime",
        "description": "Talvez esperasse uma menina. Não disse mal della; ao contrario das pessoas que enxovalham depressa o vestido novo, elle trazia o velho tenor, durará emquanto durar o theatro, não se póde? --Póde-se.",
        "price": "47.28",
        "pivot": {
          "order_id": "2",
          "product_id": "8"
        }
      }
    ]
  },
  "message": "Pedido cadastrado com sucesso!"
}
```

<br><br>

#### [POST] Atualizar Pedido

```
/orders/{orderId}
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
  "seller_id": "1",
  "customer_id": "1",
  "products_id": [
    3,
    2,
    6
  ]
}
```

Response

```json
{
  "statusCode": 200,
  "data": {
    "id": 2,
    "seller_id": 1,
    "customer_id": 1,
    "amount": "628.06",
    "code": "240322033448FVRQJU",
    "created_at": "2022-03-24T18:34:48.000000Z",
    "customer": {
      "id": 1,
      "name": "George Santana",
      "cpf": "187.266.373-71",
      "birthdate": "11/01/1992"
    },
    "seller": {
      "id": 1,
      "user_id": 9,
      "name": "Maximiano Gusmão Filho",
      "cnpj": "56.323.600/1115-57"
    },
    "products": [
      {
        "id": 6,
        "batch_id": 6,
        "code": "2022032402405",
        "name": "Camacho",
        "color": "blue",
        "description": "Mamãe é boa de mais; dá-lhe attenção de Capitú ia respondendo promptamente e bem. Trazia um vestidinho melhor e os olhos de prima Justina, passeando de um commerciante de objectos americanos. Estava.",
        "price": "168.14",
        "pivot": {
          "order_id": "2",
          "product_id": "6"
        }
      },
      {
        "id": 3,
        "batch_id": 1,
        "code": "2022032443482",
        "name": "Paes",
        "color": "fuchsia",
        "description": "Como vês, Capitú, aos quatorze annos, alta, forte e atrevido. Não imitava ninguem; não vivia com rapazes, que me acompanham para todos os meus olhos longos, constantes, enfiados nelles, e á isto.",
        "price": "253.76",
        "pivot": {
          "order_id": "2",
          "product_id": "3"
        }
      },
      {
        "id": 2,
        "batch_id": 7,
        "code": "2022032428055",
        "name": "Valente",
        "color": "purple",
        "description": "Depois, ainda falou gravemente e longamente sobre a nuca por um latim que ninguem apprende, e é a opinião dos imparciaes. Os amigos que me achava em momento tão grave; obedeci, a principio não disse.",
        "price": "206.16",
        "pivot": {
          "order_id": "2",
          "product_id": "2"
        }
      }
    ]
  },
  "message": "Pedido atualizado com sucesso!"
}
```

<br><br>

#### [DELETE] Remover Pedido

```
/orders/{orderId}
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
    "id": 2,
    "seller_id": 1,
    "customer_id": 1,
    "amount": "628.06",
    "code": "240322033448FVRQJU",
    "created_at": "2022-03-24T18:34:48.000000Z"
  },
  "message": "Pedido removido com sucesso!"
}
```

<br><br>
Todos os endpoints podem ser testados através da ferramenta [Postman](https://www.postman.com/) importando a collection
disponível [neste link](https://www.getpostman.com/collections/6ad4880ec708777c3e90).
<br><br>
Os dados gerados inicialmente para login são:<br>

#### E-mail:

```
admin@domain.com
```

#### Senha:

```
password
```

<br><br>

Obrigado!

<br><br>

Desenvolvido por
[Leonardo Oliveira](https://www.linkedin.com/in/adsleonardo/)