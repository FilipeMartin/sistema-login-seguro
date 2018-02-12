<?php
require_once 'Bdcarro.class.php';

class Carro {
	private $Bd;

	public function __construct(){
		$this->bd = new Bdcarro();
		$this->seguranca = new Seguranca();
	}

	public function excluirCarro(){
		
		if(filter_input(INPUT_GET, 'excluir', FILTER_SANITIZE_STRING)){
			$idCarro = filter_input(INPUT_GET, 'excluir', FILTER_SANITIZE_STRING);

			if($this->bd->excluir($idCarro)){
				header('Location: restrito.php?'.$this->capturaPg().'excluido=true');
			}else{
				header('Location: restrito.php?'.$this->capturaPg().'excluido=false');
			}
		}
	}

	public function capturaPg(){

		if(filter_input(INPUT_GET, 'pg', FILTER_SANITIZE_STRING)){
			$valor = filter_input(INPUT_GET, 'pg', FILTER_SANITIZE_STRING);

			$valor = 'pg='.$valor.'&';

		}else{
			$valor = '';
		}

		return $valor;
	}

	public function cadastrarCarro(){

		if(filter_input(INPUT_POST, 'cadastrar', FILTER_SANITIZE_STRING) == "Cadastrar"){
			$id_usuario = $_SESSION['usuario']['id'];
			$carro = filter_input(INPUT_POST, 'veiculo', FILTER_SANITIZE_STRING);
			$placa = filter_input(INPUT_POST, 'placa', FILTER_SANITIZE_STRING);
			$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
			$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
			$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

			if($_SESSION['token']['CSRF'] == $token){
				
				$carro = array(
					"id_usuario" => $id_usuario,
					"carro" => $carro,
					"placa" => $placa,
					"telefone" => $telefone,
					"senha" => $senha
				);

				if($this->bd->inserir($carro)){
					header('Location: restrito.php?cadastrado=true');
				}else{
					header('Location: restrito.php?cadastrado=false');
				}
			}else{
				header('Location: restrito.php?worning=token');
			}

		}
	}

	public function mostrarCarro(){

		if(filter_input(INPUT_GET, 'editar', FILTER_SANITIZE_STRING)){
			$id_carro = filter_input(INPUT_GET, 'editar', FILTER_SANITIZE_STRING);

			return $this->bd->getCarro($id_carro);
		}
	}

	public function editarCarro(){
		// Cancelar Buscar
		$_SESSION['buscar']['status'] = false;

		if(filter_input(INPUT_POST, 'editar', FILTER_SANITIZE_STRING) == "Editar"){
			$id_carro = filter_input(INPUT_POST, 'id');
			$carro = filter_input(INPUT_POST, 'veiculo', FILTER_SANITIZE_STRING);
			$placa = filter_input(INPUT_POST, 'placa', FILTER_SANITIZE_STRING);
			$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
			$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
			$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

			if($_SESSION['token']['CSRF'] == $token){

				$carro = array(
					"id_carro" => $id_carro,
					"carro" => $carro,
					"placa" => $placa,
					"telefone" => $telefone,
					"senha" => $senha
				);

				if($this->bd->editar($carro)){
					header('Location: restrito.php?editar=true');
				}else{
					header('Location: restrito.php?editar=false');
				}

			}else{
				header('Location: restrito.php?worning=token');
			}
		}
	}

	public function selectCarros(){
		
		return $this->bd->getGroup();
	}

}