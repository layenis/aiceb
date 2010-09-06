<?php
	session_start();
	
	# verificar se o usuario está logado
	verificaLogin();
	
	require_once(CONTROLLERS . 'usuariosController.php');
	
	$usuariosController = new UsuariosController();
	
	# inicializar erro
	$erro = array();
	
	if(isset($_POST['action']))
	{
		$usuarios = new Usuarios();
		
		# recupera o id para editar
		$usuarios->assignIdentifier(post('id'));
		
		# recuperar os campos -> retorna um objeto
		$usuarios = $usuarios->recuperarCampos($usuarios, $_POST, 'editar');
		
		# validação -> retorna um array
		$erro = $usuarios->validar($usuarios);
		
		if(count($erro) == 0)
		{		
			# validar o login do usuário
			if($usuariosController->buscaPorLogin($usuarios->login, $usuarios->id) == 0)
				$login_disponivel = true;
			else
				$login_disponivel = false;
			
			if($login_disponivel == true)
			{
				$usuarios->modified_at = date('Y-m-d H:i:s');
				
				# salvar
				$usuariosController->salvar($usuarios);
			}
			else
			{
				# seta o erro
				$erro[] = 'login_erro';
				
				# mensagem de erro
				setMensagem('Este login já se encontra em uso. Digite um login disponível');
			}
		}
		else
		{
			# mensagem de erro
			setMensagem('Todos os campos em destaque devem ser digitados corretamente');
		}
	}
	elseif(($id = (int) get('id')) != 0)
	{
		# pesquisa pelo id
		$usuarios = $usuariosController->buscaPorId($id);
		
		if($usuarios == false)
		{
			setMensagem("Registro inválido");
			header('Location: ' . URL . 'usuarios/index'); 
			exit;
		}
	}
	else
	{
		setMensagem("Registro inválido");
		header('Location: ' . URL . 'usuarios/index'); 
		exit;
	}
	
	# ativar a aba
	$actionInserir = 'active';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Sistema Administrativo - AICEB</title>
    
	<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>style.css" />
	<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>superfish.css" media="screen">
	
	<script type="text/javascript" src="<?=JS_URL?>jquery-1.2.6.min.js"></script>
	
	<script type="text/javascript" src="<?=JS_URL?>core.js"></script>
	
	<script type="text/javascript" src="<?=JS_URL?>hoverIntent.js"></script>
	<script type="text/javascript" src="<?=JS_URL?>superfish.js"></script>
	<script src="<?=JS_URL?>jquery.maskedinput-1.2.2.min.js" type="text/javascript"></script>
	
	<script>
		jQuery(function($)
		{
		   $("#telefone").mask("(99) 9999-9999");
		   $("#celular").mask("(99) 9999-9999");
		});

		$(document).ready(function()
		{
			$('#nome').limit('65', '#count-nome');
			$('#email').limit('60', '#count-email');
			$('#telefone').limit('14', '#count-telefone');
			$('#celular').limit('14', '#count-celular');
			$('#login').limit('15', '#count-login');
			$('#senha').limit('15', '#count-senha');
		});
	</script>
</head>

<body>
	
    <div id="content">
		
		<? include(LAYOUTS . 'topo.php'); ?>
        
        <div id="meio">
			
			<? include(VIEWS . 'usuarios' . DS . 'sub-menu.php'); ?>
			
			<div class="meio-conteudo-borda">
				<div class="meio-conteudo">
					
					<?
						$_mensagem = getMensagem();
						if(!empty($_mensagem))
						{
					?>
					<div class="mensagem-sistema erro-s">
						<span><?=$_mensagem?></span>
					</div>
					<?
						}
					?>
					
					<div class="conteudo-rg">
						<form name="" method="post" action="">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela-vs">
							
								<? include('z-campos.php'); ?>		
								
							</table>
						</form>
					</div>
					
				</div>
			</div>
        </div>
        
		<? include(LAYOUTS . 'rodape.php'); ?>
		
    </div>
    	
</body>
</html>