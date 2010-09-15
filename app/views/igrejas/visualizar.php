<?php
	session_start();
	
	require_once(CONTROLLERS . 'igrejasController.php');
	
	$igrejasController = new IgrejasController();
	$igrejas = new Igrejas();
	
	if(($id = (int) $_GET['id']) != 0)
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
			
			<? include(VIEWS . 'igrejas' . DS . 'sub-menu.php'); ?>
			
			<div class="meio-conteudo-borda">
				<div class="meio-conteudo">

					<div class="print-vs">
						<span><a href="<?=URL . 'igrejas/imprimir/?id=' . $id?>">Imprimir</a></span>
						<span><a href="<?=URL . 'igrejas/enviar_email/?id=' . $id?>">Enviar por Email</a></span>
					</div>
					
					<div class="conteudo-rg">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela-vs">
							
							<tr class="marcador-vs">
								<td colspan="2">Dados Pessoais</td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Código:&nbsp;</td>
								<td><?=$igrejas->id?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Regional:&nbsp;</td>
								<td><?=select('Regionais', 'nome', $igrejas->regional_id)?></td>
							</tr>	
							
							<tr class="dados-vs">
								<td class="label-vs">Estado:&nbsp;</td>
								<td>Piauí</td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Cidade:&nbsp;</td>
								<td>Teresina</td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Nome Fantasia:&nbsp;</td>
								<td><?=stripslashes($igrejas->nome_fantasia)?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Razão Social:&nbsp;</td>
								<td><?=stripslashes($igrejas->razao_social)?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">CNPJ:&nbsp;</td>
								<td><?=$igrejas->cnpj?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">História:&nbsp;</td>
								<td><?=stripslashes($igrejas->historia)?></td>
							</tr>
							
							<tr class="marcador-vs">
								<td colspan="2">Informações Residenciais</td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Endereço:&nbsp;</td>
								<td><?=stripslashes($igrejas->endereco)?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Número:&nbsp;</td>
								<td><?=$igrejas->numero?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Complemento:&nbsp;</td>
								<td><?=stripslashes($igrejas->complemento)?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Bairro:&nbsp;</td>
								<td><?=stripslashes($igrejas->bairro)?></td>
							</tr>	
							
							<tr class="dados-vs">
								<td class="label-vs">CEP:&nbsp;</td>
								<td><?=$igrejas->cep?></td>
							</tr>		

							<tr class="dados-vs">
								<td class="label-vs">Criado:&nbsp;</td>
								<td><?=formataData($igrejas->created_at, 'datetime', 'datetime')?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Modificado:&nbsp;</td>
								<td><?=formataData($igrejas->modified_at, 'datetime', 'datetime')?></td>
							</tr>			

							<tr class="dados-vs">
								<td class="label-vs">Status:&nbsp;</td>
								<td><? if($igrejas->status == 1) echo 'Ativo'; else echo 'Desativo'; ?></td>
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