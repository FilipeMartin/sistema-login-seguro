<?php
require_once 'classes/Usuario.class.php';
require_once 'classes/Carro.class.php';
require_once 'classes/Seguranca.class.php';

$usuario =  new Usuario();
$carros =  new Carro();
$seguranca =  new Seguranca();

// Status do login
$usuario->statusDeslogado();

// Deslogar
$usuario->deslogar();

// Cadastrar carro
$carros->cadastrarCarro();

// Mostrar Veículo
$carro = $carros->mostrarCarro();

// Editar Veículo
$carros->editarCarro();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Área Restrita</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<link rel="stylesheet" type="text/css" href="estilo_editar.css">
</head>
<body>
	<?php require_once 'menuTopo.php';?>

	<div class="containerCont">
		<div class="lista tamanho">
			<form method="POST">
				<label for="veiculo">Veículo</label><br/>
				<input class="campo cadastrar" type="text" required name="veiculo" id="veiculo" value="<?=$carro['carro']?>" placeholder="Digite o nome do veículo"><br/>

				<label for="placa">Placa</label><br/>
				<input class="campo cadastrar" type="text" required name="placa" id="placa" value="<?=$carro['placa']?>" placeholder="Digite o número da placa"><br/>

				<label for="telefone">Telefone</label><br/>
				<input class="campo cadastrar" type="number" required name="telefone" id="telefone" value="<?=$carro['telefone']?>" placeholder="Digite o número do telefone"><br/>

				<label for="senha">Senha</label><br/>
				<input class="campo cadastrar" type="password" required name="senha" id="senha" value="<?=$carro['senha']?>" placeholder="Digite sua senha"><br/>

				<input type="hidden" name="id" value="<?=$carro['id']?>">

				<input type="hidden" name="token" value="<?=$seguranca->newToken()?>">

				<input class="btn" type="submit" 
				name="<?php echo !empty($_GET['editar']) != "" ? "editar":"cadastrar";?>" 
				value="<?php echo !empty($_GET['editar']) != "" ? "Editar":"Cadastrar";?>">
			</form>
		</div>
		
	</div>
</body>
</html>