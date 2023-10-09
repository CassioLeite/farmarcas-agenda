## Desafio Farmarcas

Desafio proposto da Farmarcas, usando PHP, Laravel 10 e MySql. O desafio consiste na criação de uma API Rest de um sistema de agendamento de eventos.

## Configuração

```
cp .env.example .env
```

## Docker

Para conteinerização da aplicação, foi ultilizado o Laravel Sail.

Após clonar o projeto, o seguinte comando deve ser usado para a iniciar o projeto:

```
./vendor/bin/sail up -d
```

Após os serviços serem inciados acessar: http://localhost. A aplicação esta rodando na porta 80.
Um serviço de phpMyAdmin também foi adicionado ao projeto. Acessar: http://localhost:8001/index.php. O phpMyAdmin esta rodando na porta 8081.

Para acessar o banco via phpMyadmin:

usuario: sail

password: password

O usuário e senha é definido no próprio .env da aplicação.

## Seeder

Seeders foram adicionados ao projeto, permitindo a utilização da API para testes com usuários previamente mockados.

Para rodar os seeder:

```
./vendor/bin/sail artisan migrate
```

```
./vendor/bin/sail artisan migrate:fresh --seed
```

O usuário para testes é:

email: teste@gmail.com

senha: 123456

## Documentação

Para a documentação, foi utilizado o swagger. Para facilitar na visualização da documentação os arquivos criados pelo pacote do Swagger já foram salvos no projeto.

Em caso de erro é possível que seja necessário [reinstalar ou atualizar](https://www.bacancytechnology.com/blog/laravel-swagger-integration#requirements-and-setup-for-laravel-swagger) os end-points documentadas no Swagger.

A documentação pode ser acessada através do endereço: 

http://localhost/api/documentation


