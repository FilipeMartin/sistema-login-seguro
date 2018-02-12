<?php
require_once 'Conexao.class.php';
require_once 'Seguranca.class.php';

class Bdcarro {

	private $con;
	private $seguranca;

	public function __construct(){
		$this->con = new Conexao();
		$this->seguranca = new Seguranca();
	}

	public function listarCarroPaginacao($pg){
		try {
			$idUsuario = $_SESSION['usuario']['id'];
			$limitePg = $_SESSION['limitePg'];
			$nome_carro = $_SESSION['setWhereBd']['nome'];

			if($_SESSION['setWhereBd']['status']){

				$query = "SELECT * FROM `carros`
			              WHERE `id_usuario` = :id_usuario AND `carro` = :carro
			 		      ORDER BY `id` DESC
			              LIMIT :valorPg, :totalPg;";

				if($_SESSION['ordem'] == "ASC"){
				$query = "SELECT * FROM `carros`
			              WHERE `id_usuario` = :id_usuario AND `carro` = :carro
			 		      ORDER BY `id` ASC
			              LIMIT :valorPg, :totalPg;";
				}

				$query = $this->con->conectar()->prepare($query);
				$query->bindValue(":id_usuario", $idUsuario, PDO::PARAM_INT);
				$query->bindValue(":carro", $nome_carro, PDO::PARAM_STR);
				$query->bindValue(":valorPg", $pg, PDO::PARAM_INT);
				$query->bindValue(":totalPg", $limitePg, PDO::PARAM_INT);
				$query->execute();

			}else{
				$query = "SELECT * FROM `carros`
			              WHERE `id_usuario` = :id_usuario 
			 		      ORDER BY `id` DESC
			              LIMIT :valorPg, :totalPg;";

				if($_SESSION['ordem'] == "ASC"){
				$query = "SELECT * FROM `carros`
			              WHERE `id_usuario` = :id_usuario 
			 		      ORDER BY `id` ASC
			              LIMIT :valorPg, :totalPg;";
				}

				$query = $this->con->conectar()->prepare($query);
				$query->bindValue(":id_usuario", $idUsuario, PDO::PARAM_INT);
				$query->bindValue(":valorPg", $pg, PDO::PARAM_INT);
				$query->bindValue(":totalPg", $limitePg, PDO::PARAM_INT);
				$query->execute();

			}

			if($query->rowCount() > 0){

				return $query->fetchAll();

			}else{
				$_SESSION['setWhereBd']['status'] = false;
				header('Location: restrito.php');
				return false;
			}

		} catch (PDOException $ex){
			echo "Erro gerado ".$ex->getMessage();
		}
	}

	public function totalCarros(){
		try {
			$idUsuario = $_SESSION['usuario']['id'];
			$nome_carro = $_SESSION['setWhereBd']['nome'];

			if($_SESSION['setWhereBd']['status']){

				$query = "SELECT COUNT(*) as resultado FROM `carros` WHERE `id_usuario` = :id_usuario AND `carro` = :carro;";
				$query = $this->con->conectar()->prepare($query);
				$query->bindValue(":id_usuario", $idUsuario, PDO::PARAM_INT);
				$query->bindValue(":carro", $nome_carro, PDO::PARAM_STR);
				$query->execute();	

			}else{
				$query = "SELECT COUNT(*) as resultado FROM `carros` WHERE `id_usuario` = :id_usuario;";
				$query = $this->con->conectar()->prepare($query);
				$query->bindValue(":id_usuario", $idUsuario, PDO::PARAM_INT);
				$query->execute();

			}

			if($query->rowCount() > 0){
				$query = $query->fetch();

				return ceil($query['resultado']);

			}else{
				return 0;
			}

		} catch (PDOException $ex){
			echo "Erro gerado ".$ex->getMessage();
		}
	}

	public function excluir($idCarro){

		$idCarro = $this->seguranca->criptografarPg($idCarro, 2);

		try {
			$query = "DELETE FROM `carros` WHERE `id` = :id;";
			$query = $this->con->conectar()->prepare($query);
			$query->bindValue(":id", $idCarro, PDO::PARAM_INT);
			$query->execute();

			if($query->rowCount() > 0){
				return true;
			}else{
				return false;
			}

		} catch(PDOException $ex) {
			echo "Erro gerado".$ex->getMessage();
		}
	}

	public function inserir($carro) {
		try {
			$query = "INSERT INTO `carros`(`id_usuario`, `carro`, `placa`, `telefone`, `senha`) 
					  VALUES (:id, :carro, :placa, :telefone, :senha);";
			$query = $this->con->conectar()->prepare($query);
			$query->bindValue(":id", $carro['id_usuario'], PDO::PARAM_INT);
			$query->bindValue(":carro", $carro['carro'], PDO::PARAM_STR);		
			$query->bindValue(":placa", $carro['placa'], PDO::PARAM_STR);		
			$query->bindValue(":telefone", $carro['telefone'], PDO::PARAM_STR);	
			$query->bindValue(":senha", $carro['senha'], PDO::PARAM_STR);
			$query->execute();

			if($query->rowCount() > 0){
				return true;

			}else{
				return false;
			}			  

		} catch (PDOException $ex){
			echo "Erro gerado ".$ex->getMessage();
		}
	}

	public function editar($carro) {
		try {
			$id_carro = $this->seguranca->criptografarPg($carro['id_carro'], 2);	

			$query = "UPDATE `carros` SET `carro` = :carro, `placa` = :placa, `telefone` = :telefone, `senha` = :senha WHERE `id` = :id;";
			$query = $this->con->conectar()->prepare($query);
			$query->bindValue(":id", $id_carro, PDO::PARAM_INT);
			$query->bindValue(":carro", $carro['carro'], PDO::PARAM_STR);		
			$query->bindValue(":placa", $carro['placa'], PDO::PARAM_STR);		
			$query->bindValue(":telefone", $carro['telefone'], PDO::PARAM_STR);	
			$query->bindValue(":senha", $carro['senha'], PDO::PARAM_STR);
			$query->execute();

			if($query->rowCount() > 0){
				return true;

			}else{
				return false;
			}			  

		} catch (PDOException $ex){
			echo "Erro gerado ".$ex->getMessage();
		}
	}

	public function getCarro($id_carro){
		try {
			$id_carro = $this->seguranca->criptografarPg($id_carro, 2);	

			$query = "SELECT * FROM `carros` WHERE `id` = :id;";
			$query = $this->con->conectar()->prepare($query);
			$query->bindValue(":id", $id_carro, PDO::PARAM_INT);
			$query->execute();

			if($query->rowCount() > 0){
				$query = $query->fetch();
				$query['id'] = $this->seguranca->criptografarPg($query['id'], 1);
				
				return $query;

			}else{
				return false;
			}

		} catch (PDOException $ex){
			echo "Erro gerado ".$ex->getMessage();
		}
	}

	public function getGroup(){
		try {
			$id_usuario = $_SESSION['usuario']['id'];

			$query = "SELECT `carro` FROM `carros` WHERE id_usuario = :id_usuario GROUP BY `carro`;";
			$query = $this->con->conectar()->prepare($query);
			$query->bindValue(":id_usuario", $id_usuario, PDO::PARAM_INT);
			$query->execute();

			if($query->rowCount() > 0){

				return $query->fetchAll();

			}else{	
				return false;
			}

		} catch (PDOException $ex){
			echo "Erro gerado ".$ex->getMessage();
		}
	}

	public function buscarVeiculo(){
		try {
			$id_usuario = $_SESSION['usuario']['id'];
			$carro = $_SESSION['buscar']['valorBusca'];

			$query = "SELECT * FROM `carros` WHERE `id_usuario` = :id_usuario AND `carro` LIKE '%".$carro."%';";
			$query = $this->con->conectar()->prepare($query);
			$query->bindValue(":id_usuario", $id_usuario, PDO::PARAM_INT);
			$query->execute();

			if($query->rowCount() > 0){
				return $query->fetchAll();

			}else{
				return false;
			}

		} catch (PDOException $ex){
			echo "Erro gerado ".$ex->getMessage();
		}
	}

}