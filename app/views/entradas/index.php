<?php
	session_start();
  
	require_once(CONTROLLERS . 'entradasController.php');
	require_once(CONTROLLERS . 'igrejasController.php');
		
	$entradasController = new EntradasController();
	
	# paginacao
	$pg = (int) $_GET['pg'];
	
	#####
	$descricao = $_GET['descricao'];
	if(!empty($descricao))
	{
		$queryString = '&descricao=' . $descricao;
		$sqlString = ' and e.descricao like "%'.$descricao.'%"';
	}

    # chama a action index
	$objIndex = $entradasController->index($pg, $queryString, $sqlString); 
	
	# extrair as variaveis do array
	extract($objIndex);
	
	# total de registros
	$total = count($entradas);
	
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
	
</head>

<body>
	
    <div id="content">
		
		<? include(LAYOUTS . 'topo.php'); ?>
        
        <div id="meio">
			
			<? include(VIEWS . 'entradas' . DS . 'sub-menu.php'); ?>
			
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
						
			   	<form name="filtros" method="get" action="<?=URL . 'entradas/index/'?>">
						
							<div class="bloco-ft">
								<label>Descrição:</label>
								<input class="text-edit" type="text" name="descricao" id="descricao" value="<?=$descricao?>" size="40" maxlength="40" />
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
								<th align="center" width="100">Data</th>
								<th align="left" width="300">Igreja</th>
								<th align="center" width="100">Mês do depósito</th>
								<th width="100">Valor</th>
								
								<!-- -->
								<th class="no-borda-right" colspan="3">Ações</th>
							</tr>
							
							<!-- campos a serem listados > bg > active-tr -->
							<?
								$x = 0;
								
								for($i=0; $i<$total; $i++)
								{
							?>
							
							<tr class="listar-rg <?=$bg?>">
								
								<td align="center"><?=formataData($entradas[$i]['data_entrada'])?></a></strong></td>
								
								<td align="left"><strong><a href="<?=URL?>entradas/editar/?id=<?=$entradas[$i]['id']?>" title="<?=$entradas[$i]['data_entrada']?>"><?=$entradas[$i]['Igrejas']['nome_fantasia']?></a></td>
								
								<td align="center"><?=$entradas[$i]['mes_deposito']?></td>								
								
								<td><?=$entradas[$i]['valor']?></td>								
								
								<!-- -->
								<td class="no-borda-right" align="right"><a href="<?=URL?>entradas/recibo/?id=<?=$entradas[$i]['id']?>" title="Emitir Recibo"><img src="<?=IMG_URL?>recibo.png" /></td>
								<td class="no-borda-right"><a href="<?=URL?>entradas/visualizar/?id=<?=$entradas[$i]['id']?>" title="Visualizar Registro"><img src="<?=IMG_URL?>visualizar.png" /></td>
								<td class="no-borda-right"><a href="<?=URL?>entradas/excluir/?id=<?=$entradas[$i]['id']?>" title="Remover Registro"><img src="<?=IMG_URL?>remover.png" /></td>
							
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