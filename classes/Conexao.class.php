<?php

class Conexao {
	private $servidor;
	private $banco;
	private $usuario;
	private $senha;
	private static $pdo;

	public function __construct(){
		$this->servidor = "localhost";
		$this->banco = "login";
		$this->usuario = "root";
		$this->senha = "";
	}

	public function conectar(){
		try {

			if(is_null(self::$pdo)){
				$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
				self::$pdo = new PDO("mysql:host=".$this->servidor.";dbname=".$this->banco, $this->usuario, $this->senha, $options);
				self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}

			return self::$pdo;

		} catch (PDOException $ex){
			echo "Erro gerado ".$ex->getMessage();
		}
	}
}