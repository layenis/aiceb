<?php

	session_start();
	
	$id = $_GET['id'];
  
	require_once(CONTROLLERS . 'entradasController.php');
	require_once(CONTROLLERS . 'igrejasController.php');
	
	$igrejasController = new IgrejasController();
	$igreja = new Igrejas();
		
	$entradasController = new EntradasController();
	$entrada = new Entradas();
  
  	# pesquisa pelo id
	$entrada = $entradasController->buscaPorId($id);
	
	$igreja = $igrejasController->buscaPorId($entrada->igreja_id);
		
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
	
</head>

<body>
	
    <div id="content">
		
		<? include(LAYOUTS . 'topo.php'); ?>
        
        <div id="meio">
	  
    <? include(VIEWS . 'entradas' . DS . 'sub-menu.php'); ?>
        
	<div class="meio-conteudo-borda">
				<div class="meio-conteudo">
										
					<div class="conteudo-rg">
					Recibo R$<?=$entrada->valor?> <br>
					Recebemos de <?=$igreja->nome_fantasia?> <br> 
					a importância de <?=extenso($entrada->valor)?> <br>
					referente ao mês de <?=$entrada->mes_deposito?> <br>
										
					Cidade-UF, <?=formataData($entrada->data_entrada)?>
					</div>
					
				</div>
			</div>
        </div>
        
		<? include(LAYOUTS . 'rodape.php'); ?>
		
    </div>
    	
</body>
</html>