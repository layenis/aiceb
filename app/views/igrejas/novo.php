<?php
	session_start();
	
	require_once(CONTROLLERS . 'igrejasController.php');
	
	$igrejasController = new IgrejasController();
	$igrejas = new Igrejas();
	
	# inicializar erro
	$erro = array();
	
	if(isset($_POST['action']))
	{
		# recuperar os campos -> retorna um objeto
		$igrejas = $igrejas->recuperarCampos($igrejas, $_POST, 'novo');
		
		# valida��o -> retorna um array
		$erro = $igrejas->validar($igrejas);

		if(count($erro) == 0)
		{
			# validar alguns campos
			$igrejas->data_fundacao = formataDataBanco($igrejas->data_fundacao);
			
			$igrejas->created_at = date('Y-m-d H:i:s');
			$igrejas->modified_at = date('Y-m-d H:i:s');
			$igrejas->status = 1;
				
		    # salvar
			$igrejasController->salvar($igrejas);
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">
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
	
	<script type="text/javascript" src="<?=PLUGIN_URL?>appservice/Ajax.js"></script>	
	<script type="text/javascript" src="<?=PLUGIN_URL?>appservice/Index.js"></script>
	
	<script>
		jQuery(function($)
		{
		   $("#cep").mask("99999-999");
		   $("#cnpj").mask("99.999.999/9999-99");
		   $("#data_fundacao").mask("99/99/9999");
		});
		
		$(document).ready(function()
		{
			$('#nome_fantasia').limit('80', '#count-nome_fantasia');
			$('#razao_social').limit('250', '#count-razao_social');
			$('#cnpj').limit('18', '#count-cnpj');
			$('#historia').limit('65535', '#count-historia');
			$('#data_fundacao').limit('10', '#count-data_fundacao');
			
			$('#endereco').limit('120', '#count-endereco');
			$('#numero').limit('10', '#count-numero');
			$('#complemento').limit('80', '#count-complemento');
			$('#cep').limit('9', '#count-cep');
			$('#bairro').limit('80', '#count-bairro');
			$('#cidade').limit('120', '#count-cidade');
			$('#estado').limit('2', '#count-estado');
		});
	</script>
	
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
						<form name="formIgrejas" method="post" action="/igrejas/novo/">
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