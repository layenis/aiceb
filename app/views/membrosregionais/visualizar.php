<?php
	session_start();
	
	require_once(CONTROLLERS . 'membrosregionaisController.php');
	require_once(CONTROLLERS . 'igrejasController.php');
	
	$membrosregionaisController = new MembrosRegionaisController();
	$membrosregionais = new MembrosRegionais();
	
	$igrejasController = new IgrejasController();
	$igrejas = new Igrejas();
	
	if(($id = (int) $_GET['id']) != 0)
	{
		# pesquisa pelo id
		$membrosregionais = $membrosregionaisController->buscaPorId($id);
		
		# pesquisa a igreja pelo id
		$igrejas = $igrejasController->buscaPorId($membrosregionais->igreja_id);
		
		if($membrosregionais == false)
		{
			setMensagem("Registro inválido");
			header('Location: ' . URL . 'membrosregionais/index'); 
			exit;
		}
	}
	else
	{
		setMensagem("Registro inválido");
		header('Location: ' . URL . 'membrosregionais/index'); 
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
			
			<? include(VIEWS . 'membrosregionais' . DS . 'sub-menu.php'); ?>
			
			<div class="meio-conteudo-borda">
				<div class="meio-conteudo">
					
					<div class="conteudo-rg">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela-vs">
							
							<tr class="marcador-vs">
								<td colspan="2">Dados do membro da regional</td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Igreja:&nbsp;</td>
								<td><?=$igrejas->nome_fantasia?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Nome:&nbsp;</td>
								<td><?=$membrosregionais->nome?></td>
							</tr>	
							
							<tr class="dados-vs">
								<td class="label-vs">Função:&nbsp;</td>
								<td><?=$membrosregionais->funcao?></td>
							</tr>	
							
							<tr class="dados-vs">
								<td class="label-vs">Telefone:&nbsp;</td>
								<td><?=$membrosregionais->telefone?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">E-mail:&nbsp;</td>
								<td><?=$membrosregionais->email?></td>
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