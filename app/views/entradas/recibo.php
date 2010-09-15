<?php
	session_start();
	
	require_once(CONTROLLERS . 'entradasController.php');
	require_once(CONTROLLERS . 'igrejasController.php');
	
	$entradasController = new EntradasController();
	$entradas = new Entradas();
	
	$igrejasController = new IgrejasController();
	$igrejas = new Igrejas();
	
	if(($id = (int) $_GET['id']) != 0)
	{
		# pesquisa pelo id
		$entradas = $entradasController->buscaPorId($id);
		
		# pesquisa a regional pelo id
		$igrejas = $igrejasController->buscaPorId($entradas->igreja_id);
				
		if($entradas == false)
		{
			setMensagem("Registro inválido");
			header('Location: ' . URL . 'entradas/index'); 
			exit;
		}
		
<<<<<<< HEAD
=======
		# validar alguns campos
		$entradas->data_entrada = formataData($entradas->data_entrada);
	}
	else
	{
		setMensagem("Registro inválido");
		header('Location: ' . URL . 'entradas/index'); 
		exit;
	}		
>>>>>>> layenis/master
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
	
</head>

<body>
	
    <div id="content">
		
		<? include(LAYOUTS . 'topo.php'); ?>
        
        <div id="meio">
	  
    <? include(VIEWS . 'entradas' . DS . 'sub-menu.php'); ?>
        
	<div class="meio-conteudo-borda">
				<div class="meio-conteudo">
				
					<div class="print-vs">
<<<<<<< HEAD
						<span><a href="<?=URL . 'entradas/imprimir/?id=' . $id?>">Imprimir</a></span>
						<span>Enviar por Email</span>
=======
						<span><a href="<?=URL . 'entradas/imprimir_recibo/?id=' . $id?>">Imprimir</a></span>
						<span><a href="<?=URL . 'entradas/email_recibo/?id=' . $id?>">Enviar por Email</a></span>
>>>>>>> layenis/master
					</div>
										
					<div class="conteudo-rg">
						Recibo R$<?=$entradas->valor?> <br>
						Recebemos de <?=$igrejas->nome_fantasia?> <br> 
						a importância de <?=extenso($entradas->valor)?> <br>
						referente ao mês de <?=$entradas->mes_deposito?> <br>
											
						<?=$igrejas->cidade_id . '-' . $igrejas->estado_id . ', ' . $entradas->data_entrada?>
					</div>
					
				</div>
			</div>
        </div>
        
		<? include(LAYOUTS . 'rodape.php'); ?>
		
    </div>
    	
</body>
</html>