<?php

class Seguranca {

 	public function autentificarSession(){
		$sessionHash = $this->newSessionHash();

		if($_SESSION['sessionHash'] == $sessionHash){
			return true;
		}else{
			return false;
		}
	}

	public function newSessionHash(){
		$ip = $_SERVER['REMOTE_ADDR'];
		$cookie = $_SERVER['HTTP_COOKIE'];
		$browser = $_SERVER['HTTP_USER_AGENT'];

		$sessionHash = md5($ip.$cookie.$browser); 

		return $sessionHash; 
	}

	public function newToken(){

		$token = password_hash(rand(99,999), PASSWORD_DEFAULT);

		// Session Token;
		$_SESSION['token']['CSRF'] = $token;

		return $token;
	}

	public function destinoHttp(){

		$httpReferer = "http://localhost/login_unico/";

		if(!empty($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] == $httpReferer){
			return true;

		}else{
			return false;
		}
	}	

	public function wornings(){

		$worning = filter_input(INPUT_GET, 'worning', FILTER_SANITIZE_STRING);

		switch($worning){
			case "login": echo "Login ou senha inválido"; break;
			case "token": echo "Token inválido"; break;
			case "request": echo "Requisição inválida"; break;
		}
	}

	public function msmCarro(){
		if(filter_input(INPUT_GET, 'excluido', FILTER_SANITIZE_STRING)){

			$valor = filter_input(INPUT_GET, 'excluido', FILTER_SANITIZE_STRING);

			switch($valor){
				case "true": echo"Veículo excluído com sucesso"; break;
				case "false": echo"Erro ao excluir veículo"; break;
			}
		}

		if(filter_input(INPUT_GET, 'cadastrado', FILTER_SANITIZE_STRING)){

			$valor = filter_input(INPUT_GET, 'cadastrado', FILTER_SANITIZE_STRING);

			switch($valor){
				case "true": echo"Veículo cadastrado com sucesso"; break;
				case "false": echo"Erro ao cadastrar veículo"; break;
			}
		}

		if(filter_input(INPUT_GET, 'editar', FILTER_SANITIZE_STRING)){

			$valor = filter_input(INPUT_GET, 'editar', FILTER_SANITIZE_STRING);

			switch($valor){
				case "true": echo"Veículo editado com sucesso"; break;
				case "false": echo"Erro ao editar veículo"; break;
			}
		}

		if(filter_input(INPUT_GET, 'worning', FILTER_SANITIZE_STRING)){

			$valor = filter_input(INPUT_GET, 'worning', FILTER_SANITIZE_STRING);

			switch($valor){
				case "token": echo"Token inválido"; break;
			}
		}
	}

	public function criptografarPg($idPg, $valor){
		
		switch($valor){
			case 1: $resultado = base64_encode($idPg); break;
			case 2: $resultado = base64_decode($idPg); break;
		}
		return $resultado;
	}

	public function criptografarSenha($password){

		$senhaCript = password_hash($password, PASSWORD_BCRYPT);

		return $senhaCript;
	}

	public function validarSenha($password, $hash){

		if(password_verify($password, $hash)){
			return true;

		}else{
			return false;
		}
	}
}
