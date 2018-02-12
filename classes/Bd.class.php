<?php
require_once 'Conexao.class.php';
require_once 'Seguranca.class.php';

class Bd{
	private $con;
	private $seguranca;

	public function __construct(){
		$this->con = new Conexao();
		$this->seguranca = new Seguranca();
	}

	public function consultar($login, $password){
		try {
				$query = "SELECT * FROM `usuarios` WHERE `login` = :login;";
				$query = $this->con->conectar()->prepare($query);
				$query->bindValue(":login", $login, PDO::PARAM_STR);
				$query->execute();

				if($query->rowCount() > 0){
					$query = $query->fetch();

					if($this->seguranca->validarSenha($password, $query['senha'])){

						if($this->addIp($query['id'])){
							$_SESSION['usuario'] = $query;

							return true;
						}
						
						return false;

					}else{
						return false;
					}

				}else{
					return false;
				}

			} catch (PDOException $ex){
				echo "Erro gerado".$ex->getMessage();
			}
	}

	private function addIp($id){
		try{
			$sessionHash = $this->seguranca->newSessionHash();

			$query = "UPDATE `usuarios` SET `ip` = :ip WHERE `id` = :id;";
			$query = $this->con->conectar()->prepare($query);
			$query->bindValue(":ip", $sessionHash);
			$query->bindValue(":id", $id);

			if($query->execute()){
				return true;

			}else{
				return false;
			}

		} catch (PDOException $ex){
			echo "Erro gerado ".$ex->getMessage();
		}
	}

	public function consultarIp(){

		try{
			$sessionHash = $this->seguranca->newSessionHash();

			$id = $_SESSION['usuario']['id'];

			$query = "SELECT `ip` FROM `usuarios` WHERE `id` = :id AND `ip` = :ip;";
			$query = $this->con->conectar()->prepare($query);
			$query->bindValue(":id", $id);
			$query->bindValue(":ip", $sessionHash);
			$query->execute();

			if($query->rowCount() > 0){
				return false;

			}else{
				return true;
			}

		} catch (PDOException $ex){
			echo "Erro gerado ".$ex->getMessage();
		} 
	}

}