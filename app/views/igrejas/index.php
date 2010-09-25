<?php
	session_start();

	require_once(CONTROLLERS . 'igrejasController.php');
	
	$igrejasController = new IgrejasController();
	
	# paginacao
	$pg = (int) get('pg');
	
	#####
	$cep = get('cep');
	if(!empty($cep))
	{
		$queryString = '&cep=' . $cep;
		$sqlString = ' and i.cep = "'.$cep.'"';
	}
	
	$nome_fantasia = get('nome_fantasia');
	if(!empty($nome_fantasia))
	{
		$queryString .= '&nome_fantasia=' . $nome_fantasia;
		$sqlString .= ' and i.nome_fantasia like "%'.$nome_fantasia.'%"';
	}
	
	$regional_id = (int) get('regional_id');
	if(!empty($regional_id))
	{
		$queryString .= '&regional_id=' . $regional_id;
		$sqlString .= ' and i.regional_id = '.$regional_id;
	}
	#
	
	# chama a action index
	$objIndex = $igrejasController->index($pg, $queryString, $sqlString); 
	
	# extrair as variaveis do array
	extract($objIndex);
	
	# total de registros
	$total = count($igrejas);
	
	# ativar a aba
	$actionPesquisar = 'active';
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
			
			<? include(VIEWS . 'igrejas' . DS . 'sub-menu.php'); ?>
			
			<div class="meio-conteudo-borda">
				<div class="meio-conteudo">
	
					<div class="conteudo-ft">

						<?
							$_mensagem = getMensagem();
							if(!empty($_mensagem))
							{
						?>
						<div class="mensagem-sistema conf-s">
							<span><?=$_mensagem?></span>
						</div>
						<?
							}
						?>

						<form name="filtros" method="get" action="<?=URL . 'igrejas/index/'?>">
							<div class="bloco-ft">
								<label>Cep</label>
								<input class="text-edit" type="text" name="cep" id="cep" value="<?=$cep?>" size="20" maxlength="9" />
							</div>
							
							<div class="bloco-ft">
								<label>Nome Fantasia</label>
								<input class="text-edit" type="text" name="nome_fantasia" id="nome_fantasia" value="<?=$nome_fantasia?>" size="40" maxlength="42" />
							</div>
			
							<div class="bloco-ft">
								<label>Regional</label>							
								<?=listBox('text-edit listbox', 'regional_id', 'Regionais', 
												 'nome', $regional_id, 'status = 1', 
												 'nome asc');
    							?>
							</div>	
							
							<div class="box-botao">
								<input type="submit" name="enviar-filtro" value="Enviar" class="botao-filtro" />
							</div>
						</form>
					</div>
					
					<!-- paginacao -->
					<? include(LAYOUTS . 'paginacao.php'); ?>
					
					<div class="conteudo-rg">					
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela-rg">
							
							<!-- titulo dos campos listados -->
							<tr class="menu-rg">
								<th align="left">Nome Fantasia / Cidade / Estado</th>
								<th width="90">Fundação</th>
								<!--<th width="60">Status</th>-->
								
								<!-- -->
								<th class="no-borda-right">Ações</th>
							</tr>
							
							<!-- campos a serem listados > bg > active-tr -->
							<?
								$x = 0;
								
								for($i=0; $i<$total; $i++)
								{
									if($x % 2 == 0) $bg = 'active-tr'; else $bg = '';
									
									# regras de negócios para status
									if($igrejas[$i]['status'] == 1)
									{
										$status = '<img onClick="javascript: atualizarStatus(0, '.$igrejas[$i]['id'].', \'igrejas\');" src="'.IMG_URL.'status-ok.png" alt="Alterar Status" />';
									}
									elseif($igrejas[$i]['status'] == 0)
									{
										$status = '<img onClick="javascript: atualizarStatus(1, '.$igrejas[$i]['id'].', \'igrejas\');" src="'.IMG_URL.'status-no.png" alt="Alterar Status" />';
									}
							?>
							<tr class="listar-rg <?=$bg?>">
								
								<td align="left">
									<strong><a href="<?=URL?>igrejas/editar/?id=<?=$igrejas[$i]['id']?>" title="<?=$igrejas[$i]['nome_fantasia']?>"><?=$igrejas[$i]['nome_fantasia']?></a></strong>
									<?
										if(!empty($igrejas[$i]['cidade']))
										{
											echo '<br>';
											echo $igrejas[$i]['cidade'];
											
											if(!empty($igrejas[$i]['estado']))
												echo ' / ' . $igrejas[$i]['estado'];
										}										
									?>
								</td>
								
								<td><?=formataData($igrejas[$i]['data_fundacao'])?></td>
								
								<!-- status -->
								<!--<td id="status-<?=$igrejas[$i]['id']?>"><?=$status?></td>-->
								
								<!-- -->
								<td width="65" class="no-borda-right">
									<a class="no-borda" href="<?=URL?>igrejas/visualizar/?id=<?=$igrejas[$i]['id']?>" title="Visualizar Registro"><img src="<?=IMG_URL?>visualizar.png" />&nbsp;
									<a href="<?=URL?>igrejas/excluir/?id=<?=$igrejas[$i]['id']?>" title="Remover Registro"><img src="<?=IMG_URL?>remover.png" />								
								</td>						
							</tr>
							<?
									$x++;
								}
								
								# se não haver nenhum registro
								if($paginacao['total_resultados'] == 0)
								{
							?>
							<tr class="listar-rg">
								
								<td align="left" colspan="5" style="font-size: 16px;"><strong>Nenhum registro encontrado.</strong></td>
							
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