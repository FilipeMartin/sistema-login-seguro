<?php
require_once 'Bdcarro.class.php';
require_once 'Buscar.class.php';

class Paginacao {

	private $bdCarro;
	private $limitePgPadrao = 5;
	private $buscar;

	public function __construct(){
		$this->bdCarro = new Bdcarro();
		$this->buscar = new Buscar();
	} 

	public function listarCarros(){

		// Inicializar ordem da listagem
		$this->controlePg();
		$this->getOrdem();
		$this->setWhereBd();
		$this->buscar->pesquisaVeiculo();
		$this->buscar->cancelarBusca();

		//Buscar
		if($_SESSION['buscar']['status']){

			$listagem = $this->bdCarro->buscarVeiculo();

		}else{
			$listagem = $this->bdCarro->listarCarroPaginacao($this->getPg());
		}	

		return $listagem;
	}

	public function getPg(){

		if(filter_input(INPUT_GET, 'pg', FILTER_VALIDATE_INT)){
			$pg = filter_input(INPUT_GET, 'pg', FILTER_SANITIZE_NUMBER_INT);

			$pg = ($pg - 1) * $_SESSION['limitePg'];

			return $pg;

		}else{
			return 0;
		}
	}

	public function getOrdem(){

		if(filter_input(INPUT_POST, 'ordem', FILTER_SANITIZE_STRING)){
			$ordem = filter_input(INPUT_POST, 'ordem', FILTER_SANITIZE_STRING);

			if($ordem == "primeiro"){
				$ordem = "DESC";

			} elseif($ordem == "ultimo"){
				$ordem = "ASC";
			}
				$_SESSION['ordem'] = $ordem;

		}else{
			if(empty($_SESSION['ordem'])){
				$_SESSION['ordem'] = "DESC";
			}
		}
	}

	public function controlePg(){

		if(filter_input(INPUT_POST, 'controlePg', FILTER_VALIDATE_INT)){
			$controlePg = filter_input(INPUT_POST, 'controlePg');

			$_SESSION['limitePg'] = intval($controlePg);

			$this->limitePg = $controlePg;

			header("Location: restrito.php");

		}else{
			if(empty($_SESSION['limitePg'])){
				$_SESSION['limitePg'] = $this->limitePgPadrao;
			}
		}
	}

	public function totalPg(){

		if($_SESSION['buscar']['status']){
			$valor = 1;

		}else{
			$valor = $this->bdCarro->totalCarros();

			$valor = ($valor / $_SESSION['limitePg']);
		}

			return ceil($valor);
	}

	public function setWhereBd(){

		if(filter_input(INPUT_POST, 'groupCarros', FILTER_SANITIZE_STRING)){
			$carro = filter_input(INPUT_POST, 'groupCarros', FILTER_SANITIZE_STRING);

			if($carro == "todos"){
				$status = false;
			}else{
				$status = true;
			}

			$_SESSION['setWhereBd']["nome"] = strval($carro);
			$_SESSION['setWhereBd']["status"] = $status;

			header("Location: restrito.php");

		}else{
			if(empty($_SESSION['setWhereBd'])){
				$_SESSION['setWhereBd']["status"] = false;
				$_SESSION['setWhereBd']["nome"] = '';
			}
		}
	}
}