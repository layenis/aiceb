<?php
	session_start();
	
	require_once(CONTROLLERS . 'regionaisController.php');
	
	$regionaisController = new RegionaisController();
	$regionais = new Regionais();
	
	if(($id = (int) $_GET['id']) != 0)
	{
		# pesquisa pelo id
		$regionais = $regionaisController->buscaPorId($id);
		
		if($regionais == false)
		{
			setMensagem("Registro inválido");
			header('Location: ' . URL . 'regionais/index'); 
			exit;
		}
	}
	else
	{
		setMensagem("Registro inválido");
		header('Location: ' . URL . 'regionais/index'); 
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
	
	<script type="text/javascript" src="<?=JS_URL?>jquery-1.4.2.min.js"></script>
	
	<script type="text/javascript" src="<?=PLUGIN_URL?>fancybox/jquery.mousewheel-3.0.2.pack.js"></script>
	<script type="text/javascript" src="<?=PLUGIN_URL?>fancybox/jquery.fancybox-1.3.1.js"></script>
	<link rel="stylesheet" type="text/css" href="<?=PLUGIN_URL?>fancybox/jquery.fancybox-1.3.1.css" media="screen" />
	
	<script type="text/javascript" src="<?=JS_URL?>core.js"></script>
	
	<script type="text/javascript" src="<?=JS_URL?>hoverIntent.js"></script>
	<script type="text/javascript" src="<?=JS_URL?>superfish.js"></script>
	
</head>

<body>
	
    <div id="content">
		
		<? include(LAYOUTS . 'topo.php'); ?>
        
        <div id="meio">
			
			<? include(VIEWS . 'regionais' . DS . 'sub-menu.php'); ?>
			
			<div class="meio-conteudo-borda">
				<div class="meio-conteudo">

					<div class="print-vs">
						<span>Imprimir</span>
						<span><a id="enviar-email" href="/regionais/enviar-email">Enviar por Email</a></span>
					</div>
					
					<div class="conteudo-rg">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela-vs">
							
							<tr class="marcador-vs">
								<td colspan="2">Dados Gerais</td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Código Seguência:&nbsp;</td>
								<td><?=$regionais->id?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Código:&nbsp;</td>
								<td><?=$regionais->codigo?></td>
							</tr>	
							
							<tr class="dados-vs">
								<td class="label-vs">Nome:&nbsp;</td>
								<td><?=stripslashes($regionais->nome)?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Descrição:&nbsp;</td>
								<td><?=stripslashes($regionais->descricao)?></td>
							</tr>

							<tr class="dados-vs">
								<td class="label-vs">Criado:&nbsp;</td>
								<td><?=formataData($regionais->created_at, 'datetime', 'datetime')?></td>
							</tr>			

							<tr class="dados-vs">
								<td class="label-vs">Status:&nbsp;</td>
								<td><? if($regionais->status == 1) echo 'Ativo'; else echo 'Desativo'; ?></td>
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