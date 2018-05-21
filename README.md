PHP Back end challenge por Gustavo Serafim
Desenvolvido e testado com XAMPP
PHP v.7.2.4 - Sem nenhum framework

/src - Endpoints da API
/img - Imagens de perfil dos usuários
/db - Dump do banco de dados

Como testar:
	Todos os testes foram realizados utilizando o Postman v6.1.2
	Requisições prontas em: https://documenter.getpostman.com/view/4297738/RW87p9tp

Endpoint 1:
	/src/login.php - Enviar um JSON com as chaves email e senha:
	{
		"email": "tioogu@gmail.com",
		"senha": "12345"
	}
	Após o login a aplicação redirecionará para o endpoint 2 -> perfil.php já realizando um GET.
	
Endpoint 2:
	Após logado realizar uma requisição GET em /src/perfil.php
	
Endpoint 3:
	Após logado realizar uma requisição PUT em /src/perfil.php passando um JSON semelhante:
	{
		"nome": "Gustavo Serafim",
		"email": "tioogu@hotmail.com",
		"senha": "12345678"
	}
	Obs: Refazer o login após atualizar email e/ou senha.
	
Endpoint 4:
	Realizar uma requisição POST em /src/perfil.php enviando um imagem com input name 'foto', na pasta /img/ contem um arquivo que pode ser usuado para teste.

Endpoint 5: 
	Realizar uma requisição DELETE em /src/perfil.php e sessão será finalizada.
