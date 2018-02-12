$(document).ready(function(){

	$('#form').submit(function(){
		var login = $('#login');
		var senha = $('#senha');
		var controle = true;
			
		var caixaLogin = $('#avisoLogin');
		if(login.val() === ""){
			caixaLogin.html('Campo login obrigatório');
			controle = false;
		}else{
			caixaLogin.empty();
		}

		var caixaSenha = $('#avisoSenha');
		if(senha.val() === ""){
			caixaSenha.html("Campo senha obrigatorio");
			controle = false;

		}else if(senha.val().length < 6){
			caixaSenha.html("A senha deve conter no mínimo 6 dígitos");
			controle = false;

		}else{
			caixaSenha.empty();
		}

		if(controle){
			logar();
		}
		return false;
	});	

	function logar(){
		var url = "requisicoes/validar_login.php";
		var dadosForm = $('#form').serialize();
		var btn = $('#btnLogar');
		var txtAviso = $('#txtAviso');
		var token = $('#token');

		$.ajax({
			url: url,
			type: 'POST',
			data: dadosForm,
			cache: false,
			dataType: 'JSON',

			beforeSend: function(){
				btn.val('Autentificando...');
				btn.attr('disabled', 'disabled');
				txtAviso.empty();
			},

			success: function(resultado){

				if(resultado.status){
					btn.val('Redirecionando...');
					window.location = "restrito.php";

				}else{
					switch(resultado.alerta){
						case 1: txtAviso.html('Login ou senha inválido'); break;
						case 2: txtAviso.html('Token inválido'); break;
						case 3: txtAviso.html('Origem da requisição inválida');
					}

					// Novo Token
					token.val(resultado.novoToken);

					btn.val('Entrar');
				}

				btn.removeAttr('disabled');				
			},

			error: function(){
				txtAviso.html('Erro no envio da requisição');
				btn.removeAttr('disabled');
				btn.val('Entrar');
			}

		});
	}
});