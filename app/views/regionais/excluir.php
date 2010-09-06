<?php
	session_start();
	
	require_once(CONTROLLERS . 'regionaisController.php');
	
	$regionaisController = new RegionaisController();
	
	if(isset($_POST['action']))
	{
		$regionais = new Regionais();
		
		$regionais->id = get('id');
		
		if(!empty($regionais->id))
		{
			# pesquisa pelo id
			$regionais = $regionaisController->buscaPorId($regionais->id);
			
			if($regionais == false)
			{
				setMensagem("Registro inválido");
				header('Location: ' . URL . 'regionais/index'); 
				exit;
			}
			else
			{
				$regionaisController->excluir($regionais->id);
				
				setMensagem("Registro removido com sucesso");
				header('Location: ' . URL . 'regionais/index'); 
				exit;
			}
		}
	}
	elseif(($id = (int) $_GET['id']) != 0)
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
	$labelAction = 'Remover';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>Sistema Administrativo - AICEB</title>
    
	<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>style.css" />
	<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>superfish.css" media="screen">
	
</head>

<body>
	
    <div id="content">
		
		<? include(LAYOUTS . 'topo.php'); ?>
		
        <div id="meio">
			
			<? include(VIEWS . 'regionais' . DS . 'sub-menu.php'); ?>
			
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
								
								<input type="hidden" name="id" id="id" value="<?=$regionais->id?>" />
								
								<tr class="dados-vs">
									<td style="text-align: center; font-size: 16px;" class="label-vs" colspan="2">Deseja realmente remover este registro?&nbsp;</td>
								</tr>
								
								<tr class="dados-vs">
									<td colspan="2" align="center">
										<input type="submit" name="enviar-filtro" value="Sim" class="botao-filtro" />
										<input onclick="javascript:history.back();" type="button" name="enviar-filtro" value="Não" class="botao-filtro" />
									</td>
								</tr>

								<input type="hidden" name="action" value="enviar" />	
								
							</table>
						</form>
					</div>
					
				</div>
			</div>
        </div>
	</div>	   
</body>
</html>