<?php
	session_start();
	
	require_once(CONTROLLERS . 'atasdirgeralController.php');
	
	$atasdirgeralController = new AtasDirGeralController();
	$atasdirgeral = new AtasDirgeral();
	
	if(($id = (int) $_GET['id']) != 0)
	{
		# pesquisa pelo id
		$atasdirgeral = $atasdirgeralController->buscaPorId($id);
		
		if($atasdirgeral == false)
		{
			setMensagem("Registro inválido");
			header('Location: ' . URL . 'atasdirgeral/index'); 
			exit;
		}
		
		# validar alguns campos
		$atasdirgeral->data_ata = formataData($atasdirgeral->data_ata);
	}
	else
	{
		setMensagem("Registro inválido");
		header('Location: ' . URL . 'atasdirgeral/index'); 
		exit;
	}
	
<<<<<<< HEAD
=======
	# ativar a aba
	$encurtar_tamanho = 'encurtar_tamanho';
	$othersAction = 'active';
	$labelAction = 'Visualizar';
	
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
	
	<script type="text/javascript" src="<?=JS_URL?>validacoes.js"></script>
</head>

<body>
	
    <div id="content">
		
		<? include(LAYOUTS . 'topo.php'); ?>
        
        <div id="meio">
			
			<? include(VIEWS . 'atasdirgeral' . DS . 'sub-menu.php'); ?>
			
			<div class="meio-conteudo-borda">
				<div class="meio-conteudo">

					<div class="print-vs">
						<span><a href="<?=URL . 'atasdirgeral/imprimir/?id=' . $id?>">Imprimir</a></span>
<<<<<<< HEAD
						<span>Enviar por Email</span>
=======
						<span><a href="<?=URL . 'atasdirgeral/enviar_email/?id=' . $id?>">Enviar por Email</a></span>
>>>>>>> layenis/master
					</div>
					
					<div class="conteudo-rg">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela-vs">
							
							<tr class="marcador-vs">
								<td colspan="2">Dados da Agenda</td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Número:&nbsp;</td>
								<td><?=$atasdirgeral->numero?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Data:&nbsp;</td>
								<td><?=$atasdirgeral->data_ata?></td>
							</tr>	
							
							<tr class="dados-vs">
								<td class="label-vs">Título:&nbsp;</td>
								<td><?=$atasdirgeral->titulo?></td>
							</tr>	
							
							<tr class="dados-vs">
								<td class="label-vs">Descrição:&nbsp;</td>
								<td><?=$atasdirgeral->descricao?></td>
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