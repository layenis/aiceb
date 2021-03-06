<?php
	session_start();
	
	require_once(CONTROLLERS . 'membrosdirgeralController.php');
	
	$membrosdirgeralController = new MembrosDirgeralController();
	
	if(isset($_POST['action']))
	{
		$membrosdirgeral = new MembrosDirgeral();
		
		$membrosdirgeral->id = get('id');
		
		if(!empty($membrosdirgeral->id))
		{
			# pesquisa pelo id
			$membrosdirgeral = $membrosdirgeralController->buscaPorId($membrosdirgeral->id);
			
			if($membrosdirgeral == false)
			{
				setMensagem("Registro inv�lido");
				header('Location: ' . URL . 'membrosdirgeral/index'); 
				exit;
			}
			else
			{
				$membrosdirgeralController->excluir($membrosdirgeral->id);
				
				setMensagem("Registro removido com sucesso");
				header('Location: ' . URL . 'membrosdirgeral/index'); 
				exit;
			}
		}
	}
	elseif(($id = (int) $_GET['id']) != 0)
	{
		# pesquisa pelo id
		$membrosdirgeral = $membrosdirgeralController->buscaPorId($id);
		
		if($membrosdirgeral == false)
		{
			setMensagem("Registro inv�lido");
			header('Location: ' . URL . 'membrosdirgeral/index'); 
			exit;
		}
	}
	else
	{
		setMensagem("Registro inv�lido");
		header('Location: ' . URL . 'membrosdirgeral/index'); 
		exit;
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
	
	<script type="text/javascript" src="<?=JS_URL?>validacoes.js"></script>
</head>

<body>
	
    <div id="content">
		
		<? include(LAYOUTS . 'topo.php'); ?>
        
        <div id="meio">
			
			<? include(VIEWS . 'membrosdirgeral' . DS . 'sub-menu.php'); ?>
			
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
								
								<input type="hidden" name="id" id="id" value="<?=$membrosdirgeral->id?>" />
								
								<tr class="dados-vs">
									<td style="text-align: center; font-size: 16px;" class="label-vs" colspan="2">Deseja realmente remover este registro?&nbsp;</td>
								</tr>
								
								<tr class="dados-vs">
									<td colspan="2" align="center">
										<input type="submit" name="enviar-filtro" value="Sim" class="botao-filtro" />
										<input onclick="javascript:history.back();" type="button" name="enviar-filtro" value="N�o" class="botao-filtro" />
									</td>
								</tr>

								<input type="hidden" name="action" value="enviar" />	
								
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