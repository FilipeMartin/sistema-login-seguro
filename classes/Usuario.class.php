<?php
session_start();

require_once 'Bd.class.php';
require_once 'Seguranca.class.php';

class Usuario{
	private $bd;
	private $seguranca;

	public function __construct(){
		$this->bd = new Bd();
		$this->seguranca = new Seguranca();
	}

	public function statusLogado(){

		if(!empty($_SESSION['login']) && $_SESSION['login'] == true && $this->seguranca->autentificarSession()){
			header('Location: restrito.php');
			exit;
		}
	}

	public function statusDeslogado(){

		if(empty($_SESSION['login']) || !$this->seguranca->autentificarSession()){
			header('Location: http://localhost/login_unico/');
			exit;

		} elseif($this->bd->consultarIp()){
			session_destroy();
			unset($_SESSION);
			header('Location: http://localhost/login_unico/');
			exit;
		}
	}

	public function deslogar(){

		if(filter_input(INPUT_GET, 'deslogar', FILTER_SANITIZE_STRING) == 'sim'){
			session_destroy();
			unset($_SESSION);
		}
	}

}