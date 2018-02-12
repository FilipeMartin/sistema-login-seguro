<?php
session_start();
require_once '../classes/Seguranca.class.php';
require_once '../classes/Bd.class.php';

// Inicializar classes
$seguranca = new Seguranca();
$bd = new Bd();

// Retorno
$resposta = array("status" => false, "alerta" => "", "novoToken" => "");

if($seguranca->destinoHttp()){

	$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

		if($_SESSION['token']['CSRF'] == $token){
            $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
	        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

			if($bd->consultar($login, $senha)){

				// Iniciar Sessão
				$_SESSION['login'] = true;

				$sessionHash = $seguranca->newSessionHash();

				$_SESSION['sessionHash'] = $sessionHash; 

				$resposta["status"] = true;

			}else{
				$resposta["alerta"] = 1;
			}
								
		}else{
			$resposta["alerta"] = 2;	
	    }

}else{
	$resposta["alerta"] = 3;
}

// Novo token
$resposta['novoToken'] = $seguranca->newToken();

echo json_encode($resposta);