<?php
	session_start();
	
	require_once(CONTROLLERS . 'entradasController.php');
	require_once(CONTROLLERS . 'igrejasController.php');
	
	$entradasController = new EntradasController();
	$entradas = new Entradas();
	
	$igrejasController = new igrejasController();
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
		
		# validar alguns campos
		$entradas->data_entrada = formataData($entradas->data_entrada);
	}
	else
	{
		setMensagem("Registro inválido");
		header('Location: ' . URL . 'entradas/index'); 
		exit;
	}
	
	# ativar a aba
	$encurtar_tamanho = 'encurtar_tamanho';
	$othersAction = 'active';
	$labelAction = 'Visualizar';
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
			
			<? include(VIEWS . 'entradas' . DS . 'sub-menu.php'); ?>
			
			<div class="meio-conteudo-borda">
				<div class="meio-conteudo">

					<div class="print-vs">
						<span><a href="<?=URL . 'entradas/imprimir/?id=' . $id?>">Imprimir</a></span>
						<span><a href="<?=URL . 'entradas/enviar_email/?id=' . $id?>">Enviar por Email</a></span>
					</div>
					
					<div class="conteudo-rg">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela-vs">
							
							<tr class="marcador-vs">
								<td colspan="2">Dados da Entrada</td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Igreja:&nbsp;</td>
								<td><?=$igrejas->nome_fantasia?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Mês do depósito:&nbsp;</td>
								<td><?=$entradas->mes_deposito?></td>
							</tr>	
							
							<tr class="dados-vs">
								<td class="label-vs">Data:&nbsp;</td>
								<td><?=$entradas->data_entrada?></td>
							</tr>	
							
							<tr class="dados-vs">
								<td class="label-vs">Nome do banco:&nbsp;</td>
								<td><?=$entradas->nome_banco?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Número do depósito:&nbsp;</td>
								<td><?=$entradas->numero_deposito?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Valor:&nbsp;</td>
								<td><?=$entradas->valor?></td>
							</tr>
								
						</table>
					</div>
					
				</div>
			</div>
        </div>
        
		<? include(LAYOUTS . 'rodape.php'); ?>
		
    </div>
    	
</body>
</html>