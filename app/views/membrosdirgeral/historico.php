<?php
	session_start();
	
	require_once(CONTROLLERS . 'membrosdirgeralController.php');
	require_once(CONTROLLERS . 'igrejasController.php');
	
	$membrosdirgeralController = new MembrosDirgeralController();
	$membrosdirgeral = new MembrosDirgeral();
	
	$igrejasController = new IgrejasController();
	$igrejas = new Igrejas();
	
	# pesquisa pelo id
	$membrosdirgeral = $membrosdirgeralController->listarTodos();
	
	foreach($membrosdirgeral as $membro)
	{
		#pesquisa a igreja pelo id
		$igrejas = $igrejasController->buscaPorId($membro->igreja_id);
			
		if ($membro->status == 1)
		{
			## Array para os membros da atual gestão
			$membrosatuais[] = $membro;				
			
			## Array para os nomes das igrejas a qual pertecem os membros
			$igreja_atual[] = $igrejas->nome_fantasia;
		}
		else
		{
			## Array para os membros da atual anterior
			$membrosanteriores[] = $membro;
			
			## Array para os nomes das igrejas a qual pertecem os membros
			$igreja_anterior[] = $igrejas->nome_fantasia;
		}
	}
		
	# ativar a aba
	$encurtar_tamanho = 'encurtar_tamanho';
	$othersAction = 'active';
	$labelAction = 'Histórico';
	
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
					
					<div class="conteudo-rg">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela-vs">
							
							<tr class="marcador-vs">
								<td colspan="2">Gestão atual</td>
							</tr>
							
							<tr>
								<th>Nome do membro </th>
								<th>Igreja </th>
								<th>Função </th>
								<th>Membro desde </th>
							</tr>
							
							<?
								for ($i=0; $i<count($membrosatuais); $i++)
								{
							?>
								<tr>
									<td><?=$membrosatuais[$i]['nome']?></td>
									<td><?=$igreja_atual[$i]?></td>
									<td><?=$membrosatuais[$i]['funcao']?></td>
									<td><?=$membrosatuais[$i]['inicio_gestao']?></td>
								</tr>	
							<?
								}
							?>	
							
							<tr>
								<td><br><br></td>
							</tr>
							
							<tr class="marcador-vs">
								<td colspan="2">Gestão anterior</td>
							</tr>
							
							<tr>
								<th>Nome do membro </th>
								<th>Igreja </th>
								<th>Função </th>
								<th>Período da gestão </th>
							</tr>
							
							<?
								for ($i=0; $i<count($membrosanteriores); $i++)
								{
							?>
								<tr>
									<td><?=$membrosanteriores[$i]['nome']?></td>
									<td><?=$igreja_anterior[$i]?></td>
									<td><?=$membrosanteriores[$i]['funcao']?></td>
									<td>
										<?=$membrosanteriores[$i]['inicio_gestao']?> até <?=$membrosanteriores[$i]['final_gestao']?> 
									</td>
								</tr>	
							<?
								}
							?>	
								
						</table>
					</div>
					
				</div>
			</div>
        </div>
        
		<? include(LAYOUTS . 'rodape.php'); ?>
		
    </div>
    	
</body>
</html>