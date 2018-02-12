<?php
require_once 'classes/Usuario.class.php';
require_once 'classes/Seguranca.class.php';

$usuario = new Usuario();
$seguranca = new Seguranca();

// Status do login
$usuario->statusLogado();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Área de login</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<script type="text/javascript" src="js/jquery-3.3.1.min"></script>
</head>
<body>

	<div class="txt">
		<h1>Área de login<h1>
	</div>
	<div class="container">
		<form method="POST" id="form">

			<label for="login">Login</label><br/>
			<input class="campo" type="text" name="login" id="login" placeholder="Digite seu login"><br/>
			<div class="txtAvisoCampo" id="avisoLogin"></div>

			<label for="senha">Senha</label><br/>
			<input class="campo" type="password" name="senha" id="senha" placeholder="Digite sua senha"><br/>
			<div class="txtAvisoCampo" id="avisoSenha"></div>

			<input type="hidden" name="token" id="token" value="<?php echo $seguranca->newToken();?>">

			<input class="btn" type="submit" name="entrar" id="btnLogar" value="Entrar">

		</form>
		<div class="txtAviso" id="txtAviso"></div>
	</div>
	<script type="text/javascript" src="js/script.js"></script>
</body>
</html>