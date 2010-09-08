<?php
	session_start();
	
	require_once(CONTROLLERS . 'agendasgeraisController.php');
	
	$agendasgeraisController = new AgendasGeraisController();
	$agendasgerais = new AgendasGerais();
	
	if(($id = (int) $_GET['id']) != 0)
	{
		# pesquisa pelo id
		$agendasgerais = $agendasgeraisController->buscaPorId($id);
		
		if($agendasgerais == false)
		{
			setMensagem("Registro inv�lido");
			header('Location: ' . URL . 'agendasgerais/index'); 
			exit;
		}
		
		# validar alguns campos
		$agendasgerais->data_agenda = formataData($agendasgerais->data_agenda);
	}
	else
	{
		setMensagem("Registro inv�lido");
		header('Location: ' . URL . 'agendasgerais/index'); 
		exit;
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

<body>
	
    <div id="content">
		
		<? include(LAYOUTS . 'topo.php'); ?>
        
        <div id="meio">
			
			<? include(VIEWS . 'agendasgerais' . DS . 'sub-menu.php'); ?>
			
			<div class="meio-conteudo-borda">
				<div class="meio-conteudo">

					<div class="print-vs">
						<span><a href="<?=URL . 'agendasgerais/imprimir/?id=' . $id?>">Imprimir</a></span>
						<span>Enviar por Email</span>
					</div>
					
					<div class="conteudo-rg">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela-vs">
							
							<tr class="marcador-vs">
								<td colspan="2">Dados da Agenda</td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Data:&nbsp;</td>
								<td><?=$agendasgerais->data_agenda?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Local:&nbsp;</td>
								<td><?=$agendasgerais->local?></td>
							</tr>	
							
							<tr class="dados-vs">
								<td class="label-vs">T�tulo:&nbsp;</td>
								<td><?=$agendasgerais->titulo?></td>
							</tr>	
							
							<tr class="dados-vs">
								<td class="label-vs">Descri��o:&nbsp;</td>
								<td><?=$agendasgerais->descricao?></td>
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