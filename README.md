# api-user-symfony
Trabalho final - PHP PUC MG
O objetivo desta tarefa é construir uma API Web escrita em PHP para fazer gestão de Usuários. O projeto deverá ser versionado no Github e o link do mesmo deverá ser entregue ao professor diretamente através do portal Canvas.
Requisitos funcionais

    Endpoint para criação de um novo usuário (POST /users)
        Usuário deve ser validado antes de persistido no banco de dados e, caso não esteja válido, o código de erro 400 deve ser retornado junto com a lista de erros encontrados
    Endpoint para listar todos os usuários cadastrados no banco de dados (GET /users)
    Endpoint para alteração de um usuário (PUT /users/{id})
        Usuário deve ser validado antes de persistido no banco de dados e, caso não esteja válido, o código de erro 400 deve ser retornado junto com a lista de erros encontrados
        Usuário deve existir na base e, caso contrário, o código de erro 404 com uma mensagem apropriada deve ser retornada
    Endpoint para remoção de um usuário (DELETE /users/{id})
        Usuário deve existir na base e, caso contrário, o código de erro 404 com uma mensagem apropriada deve ser retornada
    Endpoint para visulizar detalhes de um usuário (GET /users/{id})
        Usuário deve existir na base e, caso contrário, o código de erro 404 com uma mensagem apropriada deve ser retornada

Modelagem

Cada usuário deve conter as seguintes informações:

    Nome
    Sobrenome
    E-mail
    Telefones
        Código de área (31, 33 e etc)
        Número no formato XXXX-XXXX
    Endereço
        Estado
        Cidade
        Bairro
        Rua
        Número
        Complemento

OBS: Cada usuário possui um ou mais telefones

OBS: Cada usuário possui um endereço

Desta forma, teremos um total de três tabelas (user, user_address, user_contact_phone)
Requisitos não-funcionais

    Requisições e respostas da API devem ser no formato JSON
    API deve conter testes funcionais para garantir que a aplicação está funcionando corretamente
    Devemos incluir uma integração contínua no GitHub Actions para buildar e rodar os testes automaticamente a cada "git push"


Para começar: php composer install
