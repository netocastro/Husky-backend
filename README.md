# Backend
    Essa é uma API foi construida para um desafio da Husky. Ela simula uma aplicação que gerencia
    entregas de delivery, onde se pode manipular os pedidos de um usuário.

## Projeto

    Essa aplicação é feita com PHP puro e utiliza todas as normas de programação seguindo as PSRs(PHP Standards Recommendations), arquitetura e padrões de projeto como MVC , Active Record e Layer Supertype;

    <h1>Requistos para rodar a API</h1>
    *Servidor Apache (wamp,xampp ou qualquer um de sua preferência)
    *MySQL
    *PHP version 7.4
    *Composer


## Instalação do Backend

    *Coloque a pasta <nome da pasta> dentro do diretório público seu servidor Apache.

    *Abra o terminal dentro da raiz do projeto e execute o comando: "composer update" (sem as aspas),
    pra ter certeza que não falta alguem componente componente.

    * Na raiz do projeto, na pasta database execute o arquivo database.sql em seu SGBD  para criar as tabelas
    e popular o banco de dados.

    *Dentro da pasta src/Core se encontra o arquivo Config.php, nele vc precisa editar a
    constante BASE_PATH para o diretorio no qual vc colocou a pasta do projeto.
    Também terá que editar a constante DATA_LAYER_CONFIG com as informações do seu banco de dados.

#### Exemplo BASE_PATH:



    $s = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 's' : '');

		define("BASE_PATH", "http{$s}://{$_SERVER['HTTP_HOST']}");

 


### Exemplo DATA_LAYER_CONFIG:

   
		define('DATA_LAYER_CONFIG', [
			'driver' => 'mysql',  
			'host' => 'localhost',          // nome do seu host
			'port' => '3306',
			'dbname' => 'backend_husky',   // nome da database
			'username' => 'root',          // usuário
			'passwd' => '',				   // senha
			'options' => [
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
				PDO::ATTR_CASE => PDO::CASE_NATURAL,
			],
		]);

    

	O BASE_PATH reconhece automaticamente se o servidor é HTTP ou HTTPS.
	Se você estiver utilizando um certificado SSL, descomente as linhas 10, 11 e 12 no arquivo .htaccess
	que se encontra na raiz do projeto removendo o "#". Depois disso é so acessar o projeto através do
	navegador, cliente de API REST como insomnia e postman ou através da documentação da dessa API com swagger, apartir da rota /documentation pra poder fazer as requisicões com swagger.
	Ex: http://localhost/documentation

	<h1>Explicando o Backend</h1>

	O backend possui o CRUD de todas as poderão ser acessadas através do swagger.


# Métodos
Requisições para a API devem seguir os padrões:

## Users
| Método | URI | Descrição |
|---|---|---|
| `GET` | /user | Retorna todos os registros de usuários do banco de dados.|
| `GET` | /user/{id} | Retorna as informações de um usuário específico através do id no banco de dados. |
| `POST` | /user | Insere um usuário no banco de dados. |
| `PUT` | /user/{id} | Atualiza as informações de um usuário específico através do id no banco de dados.|
| `DELETE` | /user/{id} | Deleta um usuário específico através do id no banco de dados. |

## Motoboys
| Método | URI | Descrição |
|---|---|---|
| `GET` | /motoboy | Retorna todos os registros de motoboys do banco de dados.|
| `GET` | /motoboy/{id} | Retorna as informações de um motoboy específico através do id no banco de dados. |
| `POST` | /motoboy | Insere um motoboy no banco de dados. |
| `PUT` | /motoboy/{id} | Atualiza as informações de um motoboy específico através do id no banco de dados.|
| `DELETE` | /motoboy/{id} | Deleta um motoboy específico através do id no banco de dados. |

## Status
| Método | URI | Descrição |
|---|---|---|
| `GET` | /status | Retorna todos os registros de status do banco de dados.|
| `GET` | /status/{id} | Retorna as informações de um status específico através do id no banco de dados. |
| `POST` | /status | Insere um status no banco de dados. |
| `PUT` | /status/{id} | Atualiza as informações de um status específico através do id no banco de dados.|
| `DELETE` | /status/{id} | Deleta um status específico através do id no banco de dados. |


## Delivery
| Método | URI | Descrição |
|---|---|---|
| `GET` | /delivery | Retorna todos os registros de deliveries do banco de dados.|
| `GET` | /delivery/{id} | Retorna as informações de um delivery específico através do id no banco de dados. |
| `POST` | /delivery | Insere um delivery no banco de dados. |
| `PUT` | /delivery/{id} | Atualiza as informações de um delivery específico através do id no banco de dados.|
| `DELETE` | /delivery/{id} | Deleta um delivery específico através do id no banco de dados. |

+ Request (application/json)

    + Body

            {
                "code": "1rbUURjcp1KErn7Jgx7d",
                "client_id": "e70654d7f568d0",
                "client_secret": "156762a28c007a64ff",
                "redirect_uri": "urn:ietf:wg:oauth:2.0:oob:auto",
                "grant_type": "authorization_code"
            }

+ Response 200 (application/json)

    + Body

            {
                "access_token": "[access_token]",
                "token_type": "Bearer",
                "expires_in": 900,
                "refresh_token": "[refresh_token]",
                "personal_token": "[token_string]"
            }
