<div class="containerMenu">
	<div class="menuTopo">
			<div class="logo">
				Área Restrita - <?=$_SESSION['usuario']['login']?>
			</div>
			<div class="boxBuscar">
				<form method="POST">
					<input class="campoBusca" type="search" name="buscar" placeholder="Buscar...">
				</form>
			</div>
			<div class="listaMenuTopo">
				<ul>
					<li><a href="restrito.php" alt="Início" title="Início">Início</a></li>
					<li><a href="cadastrar.php" alt="Cadastrar" title="Cadastrar">Cadastrar</a></li>
					<li><a href="?deslogar=sim" alt="Deslogar" title="Deslogar">Deslogar</a></li>
				</ul>
			</div>
			<div style="clear: both;"></div>
		</div>	
</div>