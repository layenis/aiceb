<?php
  
	session_start();
  
	require_once(CONTROLLERS . 'membrosregionaisController.php');
	
	$membrosregionaisController = new MembrosRegionaisController();
	$membrosregionais = new MembrosRegionais();	
	
	# inicializar erro
	$erro = array();
	
	if(isset($_POST['action']))
	{
		# recuperar os campos
		$membrosregionais = $membrosregionais->recuperarCampos($membrosregionais, $_POST, 'novo');

		# validacao 
		$erro = $membrosregionais->validar($membrosregionais);

		if (count($erro) == 0)
		{
			## recupera o id da regional do usu�rio logado
			$membrosregionais->regional_id = $_SESSION['USUARIO_REGIONAL_ID'];
			
			$membrosregionais->created_at = date('Y-m-d H:i:s');
			
			$membrosregionais->status = 1;
			
			$membrosregionaisController->salvar($membrosregionais);
		}  
		else
		{
			# mensagem de erro
			setMensagem('Todos os campos em destaque devem ser digitados corretamente');
		}    
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
	
</head>

<script>

jQuery(function($)
{
   $("#telefone").mask("(99)9999-9999");
});

$(document).ready(function()
{	
	$('#nome').limit('80', '#count-nome');
	$('#funcao').limit('40', '#count-funcao');
	$('#email').limit('40', '#count-email');
});

</script>

<body>
	
    <div id="content">
		
		<? include(LAYOUTS . 'topo.php'); ?>
        
        <div id="meio">
	  
    <? include(VIEWS . 'membrosregionais' . DS . 'sub-menu.php'); ?>
        
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