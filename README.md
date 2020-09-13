# Safra Payback

Esse projeto foi desenvolvido como parte do hackathon do banco safra!

Levamos em consideração a forma como estão estruturados os requests do banco, a partir da [documentação da api](https://github.com/banco-safra/technee) que foi disponibilizada para esse hackathon.

##### Boilerplate utilizada:

* [Laravel API Boilerplate](https://github.com/kennethtomagan/laravel-api-boilerplate.git) de kennethtomagan

##### Pacotes Utilizados:

* JWT-Auth - [tymondesigns/jwt-auth](https://github.com/tymondesigns/jwt-auth)
* Laravel-CORS [barryvdh/laravel-cors](http://github.com/barryvdh/laravel-cors)

##### Requisitos:

* PHP: ^7.2

## Features

* Autenticação JWT
* Features Básicas: Registro, Login, Atualização de Perfil & Senha
* Resposta da API em formato JSON.

## Instalação

#### Clonar o repositório:
```
$ git clone https://github.com/Safra-Hackathon/api.git safra-hackathon-api
```
#### Instalando Dependências
 
* [Docker](https://docs.docker.com/get-docker/)
* [Docker Compose](https://docs.docker.com/compose/install/)

#### Rodando o Projeto com Docker Compose

```
$ cd safra-hackathon-api
$ docker-compose up -d
```

#### Script que faz a Configuração Inicial
O próximo passo é rodar o script que faz a configuração inicial do ambiente & semeia banco de dados
```
$ sh ./env/scripts/docker_init.sh
```

## Rotas da API
* Collection do Postman: [link](env/postman/collection.json)

Todas as rotas tem um prefixo "{HOST_URL}/api/"

| Verb     |                     URI                                             |       Controller                      |      Notes                                |
| -------- | ------------------------------------------------------------------- | ------------------------------------- | ------------------------------------------
| POST     | `auth`                                    |  AuthController                       | faz o login e gera o token de acesso
| POST     | `register`                                |  RegisterController                   | cria um novo usuário na aplicação
| POST     | `recovery`                                |  ForgotPasswordController             | recupera as credenciais
| POST     | `reset`                                   |  ResetPasswordController              | reseta a senha depois da recuperação
| POST     | `logout`                                  |  LogoutController                     | faz o logout do usuário, invalidando o token
| GET      | `profile`                                 |  ProfileController                    | pega os dados do perfil do usuário logado
| PUT      | `profile`                                 |  ProfileController                    | atualiza os dados do perfil do usuário logado
| PUT      | `profile/password`                        |  ProfileController                    | atualiza a senha do usuário logado
| GET      | `payback`                                 |  PaybackController                    | recupera informações do estado atual do payback
| POST     | `payback`                                 |  PaybackController                    | atualiza informações do payback como porcentagem ou liga/desliga 
| GET      | `payback/history`                         |  PaybackController                    | recupera o histórico gravado de alterações do estado do payback
| GET      | `payback/transactions`                    |  PaybackController                    | recupera um histórico de transações do safra pay e quanto geraram de payback
| POST     | `payback/accounts/{account_id}/generate`  |  PaybackController                    | Recebe notificação de pagamento que gera o payback, o corpo do POST é igual ao conteúdo das transactions da API do Safra
| GET      | `payback/history/chart/{start}/{end}`     |  PaybackHistoryChartController        | Recupera as informações do histórico de payback, utilizada no gráfico da dashboard
| GET      | `funds`                                   |  FundController                       | Recupera os fundos de investimento e suas informações
| GET      | `recommend/{value}`                       |  FundController                       | Busca um fundo recomendado com base num valor disponível
| GET      | `investments`                             |  InvestmentController                 | Retorna a carteira atual de investimentos do cliente
| POST     | `investments`                             |  InvestmentController                 | Atualiza a carteira de investimentos do cliente
