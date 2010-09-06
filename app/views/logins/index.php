<?php
	session_start();
	
	# limpa a sessão do usuario
	limparSessao();
	
	require_once(CONTROLLERS . 'loginsController.php');
	
	$loginsController = new LoginsController();
	
	if(post('action'))
	{
		$usuarios = new Usuarios();
		
		$usuarios->login = post('usuario');
		$usuarios->senha = post('senha');
		
		if(empty($usuarios->login)) $erro = 1;
		if(empty($usuarios->senha)) $erro = 2;
		
		if(empty($erro))
		{		
			$usuarios = $loginsController->logar($usuarios->login, $usuarios->senha);

			if($usuarios->count() == 1)
			{
				# registrar as seções
				$_SESSION['USUARIO_TIPO_ID'] = $usuarios[0]->tipo_id;
				$_SESSION['USUARIO_ID'] = $usuarios[0]->id;
				$_SESSION['USUARIO_REGIONAL_ID'] = $usuarios[0]->regional_id;
				$_SESSION['USUARIO_NOME'] = $usuarios[0]->nome;
				$_SESSION['USUARIO_ULTIMO_ACESSO'] = $usuarios[0]->ultimo_acesso;
				$_SESSION['USUARIO_ACESSOS'] = $usuarios[0]->acessos + 1;
				
				# atualiza os acessos e a data
				$loginsController->atualizarDados($usuarios[0]->id);
				
				# redirecionamento
				header('Location: /home/index');
				exit;
			}
			else
			{
				$usuarios->login = post('usuario');
				
				setMensagem('Usuário não encontrado');
			}
		}
		else
		{
			setMensagem('Todos os campos devem ser digitados corretamente');
		}
	}
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
	
	<script type="text/javascript" src="<?=JS_URL?>validacoes.js"></script>
	
</head>

<body class="no-bg">
	
    <div id="content" class="ajustes">
        
        <div id="meio" class="no-bg">			
			
			<div class="login">
				<div class="center"><img src="<?=IMG_URL?>logo.jpg" title="AICEB" /></div>
				
				<span>Acessar o Sistema</span>
				
				<?
					$_mensagem = getMensagem();
					if(!empty($_mensagem))
					{
				?>
				<div class="erro-login">
					<span><?=$_mensagem?></span>
				</div>
				<?
					}
				?>
				
				<form name="logar" method="post" action="/logins/index" id="form-login">
					<label>USUÁRIO: </label>
					<input class="input-field" type="text" name="usuario" id="usuario" value="<?=$usuarios->login?>" maxlength="15" />
					
					<label>SENHA: </label>
					<input class="input-field" type="password" name="senha" id="senha" value="" maxlength="15" />
					
					<input type="hidden" name="action" value="logar" />
					
					<input type="submit" class="botao-login" name="enviar" value="Entrar" />
				</form>
			</div>
			
        </div>
		
    </div>
    	
</body>
</html>