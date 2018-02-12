<?php
require_once 'classes/Usuario.class.php';
require_once 'classes/Paginacao.class.php';
require_once 'classes/Carro.class.php';
require_once 'classes/Seguranca.class.php';

$usuario =  new Usuario();
$paginacao =  new Paginacao();
$carross =  new Carro();
$seguranca =  new Seguranca();

// Status do login
$usuario->statusDeslogado();

// Deslogar
$usuario->deslogar();

// Listagem carro
$listaCarro = $paginacao->listarCarros();

// Excluir Carro
$carross->excluirCarro();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Área Restrita</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<?php require_once 'menuTopo.php';?>

	<div class="containerCont">

		<div class="txtLista">Lista de Veículo</div>
		<div class="txtStatus"><?php $seguranca->msmCarro();?></div>
		<div class="lista">

			<?php if(!$listaCarro){ 
				$_SESSION['buscar']['status'] = false;
				echo "<div class='txtPagaInvalida'>Página inválida</div><br/><a class='txtAtualizar' href='restrito.php'>Atualizar</a>";
			}else{ ?>

			<table>
				<?php if($_SESSION['buscar']['status']){?>
				<div class="txtVoltar"><a href="?cancelarBusca=true">Voltar</a></div>
				<?php }else{?>
				<div class="divSelectOrdem">
				<form method="POST">
					<select onchange="this.form.submit()" class="select" name="ordem">
							<option <?php echo $_SESSION['ordem'] == 'DESC'? "selected":"";?> value="primeiro">Primeiro</option>
							<option <?php echo $_SESSION['ordem'] == 'ASC'? "selected":"";?> value="ultimo">Último</option>
					</select>
				</form>
				</div>
				<div class="divSelectNum">
				<form method="POST">
					Número de Veículos
					<select onchange="this.form.submit()" class="selectNumero" name="controlePg">
							<option <?php echo $_SESSION['limitePg'] == '5'? "selected":"";?> value="5">5</option>
							<option <?php echo $_SESSION['limitePg'] == '10'? "selected":"";?> value="10">10</option>
							<option <?php echo $_SESSION['limitePg'] == '15'? "selected":"";?> value="15">15</option>
							<option <?php echo $_SESSION['limitePg'] == '20'? "selected":"";?> value="20">20</option>
					</select>
				</form>
				</div>
				<div class="divSelectNum">
				<form method="POST">
					Veículos
					<select onchange="this.form.submit()" class="selectNumero" name="groupCarros">

							<?php foreach($carross->selectCarros() as $veiculo){ ?>
								<option <?php echo $_SESSION['setWhereBd']['nome'] == $veiculo['carro'] ? "selected":"";?> 
									    value="<?=$veiculo['carro']?>"><?=$veiculo['carro']?></option>
							<?php }?>
							
							<option <?php echo $_SESSION['setWhereBd']['status'] == false ? "selected":"";?> value="todos">Todos</option>
					</select>
				</form>
				</div>
				<div style="clear: both;"></div>
				<?php }?>
				<hr/>
				<tr>
					<th>Carro</th>
					<th>Placa</th>
					<th>Telefone</th>
					<th>Senha</th>
					<th>Excluir</th>
					<th>Editar</th>
				</tr>

				<?php	
				foreach($listaCarro as $carro){
					$id = $seguranca->criptografarPg($carro['id'], 1);
				?>
				<tr>
					<td><?=$carro['carro']?></td>
					<td><?=$carro['placa']?></td>
					<td><?=$carro['telefone']?></td>
					<td><?=$carro['senha']?></td>
					<td class="center"><a href="?<?=$carross->capturaPg()?>excluir=<?=$id?>">Excluir</a></td>
					<td class="center"><a href="cadastrar.php?editar=<?=$id?>">Editar</a></td>
				</tr>
				<?php }}?>
			</table>
			<div class="paginacao">
				<?php if($paginacao->totalPg() != 1){
					echo "Páginas ";

					for($x=0; $x< $paginacao->totalPg(); $x++){ $valor = $x+1; ?>

						<a style="color: <?php echo $_GET['pg'] == $valor ? "red":"";?>" href="?pg=<?=$valor?>">[<?=$valor?>]</a>

				<?php }}?>
			</div>
		</div>
	</div>
</body>
</html>