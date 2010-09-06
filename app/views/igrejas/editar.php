<?php
	session_start();
	
	require_once(CONTROLLERS . 'igrejasController.php');
	
	$igrejasController = new IgrejasController();
	
	# inicializar erro
	$erro = array();
	
	if(isset($_POST['action']))
	{
		$igrejas = new Igrejas();
		
		# recupera o id para editar
		$igrejas->assignIdentifier($_POST['id']);
		
		# recuperar os campos -> retorna um objeto
		$igrejas = $igrejas->recuperarCampos($igrejas, $_POST, 'editar');
		
		# validação -> retorna um array
		$erro = $igrejas->validar($igrejas);
		
		if(count($erro) == 0)
		{
			# validar alguns campos
			$igrejas->data_fundacao = formataDataBanco($igrejas->data_fundacao);
			
			$igrejas->modified_at = date('Y-m-d H:i:s');
			
		    # salvar
			$igrejasController->salvar($igrejas);
		}
		else
		{
			# mensagem de erro
			setMensagem('Todos os campos em destaque devem ser digitados corretamente');
		}
	}
	elseif(($id = (int) $_GET['id']) != 0)
	{
		# pesquisa pelo id
		$igrejas = $igrejasController->buscaPorId($id);
		
		if($igrejas == false)
		{
			setMensagem("Registro inválido");
			header('Location: ' . URL . 'igrejas/index'); 
			exit;
		}
		
		# validar alguns campos
		$igrejas->data_fundacao = formataData($igrejas->data_fundacao);
	}
	else
	{
		setMensagem("Registro inválido");
		header('Location: ' . URL . 'igrejas/index'); 
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
	
	<script type="text/javascript" src="<?=JS_URL?>validacoes.js"></script>
</head>

<body>
	
    <div id="content">
		
		<? include(LAYOUTS . 'topo.php'); ?>
        
        <div id="meio">
			
			<? include(VIEWS . 'igrejas' . DS . 'sub-menu.php'); ?>
			
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