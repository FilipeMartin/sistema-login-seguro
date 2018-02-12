<?php

class Buscar{

	public function pesquisaVeiculo(){

		if(filter_input(INPUT_POST, 'buscar', FILTER_SANITIZE_STRING)){
			$valorBusca = filter_input(INPUT_POST, 'buscar', FILTER_SANITIZE_STRING);

			$_SESSION['buscar']['status'] = true;
			$_SESSION['buscar']['valorBusca'] = $valorBusca ;

		}else{
			if(empty($_SESSION['buscar'])){
				$_SESSION['buscar']['status'] = false;
			}
		}
	}

	public function cancelarBusca(){
		if(filter_input(INPUT_GET, 'cancelarBusca', FILTER_SANITIZE_STRING) == "true"){

			$_SESSION['buscar']['status'] = false;
			header("Location: restrito.php");

		}
	}
}