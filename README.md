É um sistema de login único, ou seja, o usuário poderá está logado em apenas uma máquina por vez, caso seja efetuado outro login em outra máquina o último usuário será deslogado ao atualizar a página.
O método utilizado para distinguir o login está relacionado com a criação de um token, gerado pela captura do IP, PHPSESSID e o tipo de browser do usuário, após a concatenação dos elementos capturados é gerado um MD5 e armazenado no banco de dados.

Método utilizado:

public function newSessionHash(){

		$ip = $_SERVER['REMOTE_ADDR'];
		$cookie = $_SERVER['HTTP_COOKIE'];
		$browser = $_SERVER['HTTP_USER_AGENT'];

		$sessionHash = md5($ip.$cookie.$browser); 

		return $sessionHash; 
	}

< ------------------------------------------------------------------------------------------------------------------ >

O sistema de login possui algumas defesas contra os seguintes ataques: 

1- SQL Injection: É um ataque que consiste na inserção de uma query via aplicação web.

2- CSRF: E um tipo de ataque informático malicioso a um website no qual comandos não autorizados são transmitidos através de um utilizador em quem o website confia.

3- XSS: É um ataque que consiste na inserção de comandos (script etc...) em campos de texto (input).

4- Session Hijacking: O seqüestro de sessão é sinônimo de uma sessão roubada, na qual um invasor intercepta e assume uma sessão legitimamente estabelecida entre um usuário e um host.