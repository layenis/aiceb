<?php
	session_start();
  
	require_once(CONTROLLERS . 'agendasregionaisController.php');
	require_once(CONTROLLERS . 'regionaisController.php');
		
	$agendasregionaisController = new AgendasRegionaisController();
	
	$regional_id = $_SESSION['USUARIO_REGIONAL_ID'];

	$sqlString = 'and regional_id = ' . $regional_id;

	# paginacao
	$pg = (int) $_GET['pg'];
	
	#####
	$titulo = $_GET['titulo'];
	if(!empty($titulo))
	{
		$queryString = '&titulo=' . $titulo;
		$sqlString = ' and a.titulo like "%'.$titulo.'%"';
	}

    # chama a action index
	$objIndex = $agendasregionaisController->index($pg, $queryString, $sqlString); 
	
	# extrair as variaveis do array
	extract($objIndex);
	
	# total de registros
	$total = count($agendasregionais);
	
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
			
			<? include(VIEWS . 'agendasregionais' . DS . 'sub-menu.php'); ?>
			
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
						
			   	<form name="filtros" method="get" action="<?=URL . 'agendasregionais/index/'?>">
						
							<div class="bloco-ft">
								<label>T�tulo:</label>
								<input class="text-edit" type="text" name="titulo" id="titulo" value="<?=$titulo?>" size="40" maxlength="40" />
							</div>
		            
            <div class="box-botao">
								<input type="submit" name="enviar-filtro" value="Enviar" class="botao-filtro" />
						</div>
					</form>
				</div>
				
				<div class="conteudo-pg">
						<span class="info-pg">Listando <?=$paginacao['primeiro_indice']?> at� <?=$paginacao['ultimo_indice']?> de <?=$paginacao['total_resultados']?> registros</span>
						
						<div class="paginacao">
							<div class="botoes-pg radios-left"><a href="<?=$paginacao['primeiro']?>" title="Primeiro">Primeiro</a></div>
							<div class="botoes-pg"><a href="<?=$paginacao['anterior']?>" title="Anterior">Anterior</a></div>
							<div class="botoes-pg"><?=$paginacao['pagina_atual']?></div>
							<div class="botoes-pg"><a href="<?=$paginacao['proximo']?>" title="Pr�ximo">Pr�ximo</a></div>
							<div class="botoes-pg radios-right"><a href="<?=$paginacao['ultimo']?>" title="�ltimo">�ltimo</a></div>
						</div>
			 </div>
			 
			 	<div class="conteudo-rg">					
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela-rg">
							
							<!-- titulo dos campos listados -->
							<tr class="menu-rg">
								<th align="left" width="100">Data</th>
								<th align="left" width="150">Local</th>
								<th align="left" width="450">T�tulo</th>
																
								<!-- -->
								<th class="no-borda-right" colspan="2">A��es</th>
							</tr>
							
							<!-- campos a serem listados > bg > active-tr -->
							<?
								$x = 0;
								
								for($i=0; $i<$total; $i++)
								{
							?>
							
							<tr class="listar-rg <?=$bg?>">
								
								<td><?=formataData($agendasregionais[$i]['data_agenda'])?></td>	
								
								<td><?=$agendasregionais[$i]['local']?></td>
								
								<td align="left">
									<strong><a href="<?=URL?>agendasregionais/editar/?id=<?=$agendasregionais[$i]['id']?>" title="<?=$agendasregionais[$i]['titulo']?>"><?=$agendasregionais[$i]['titulo']?></a></strong>
								</td>						
								
								<!-- -->
								<!--<td class="no-borda-right" align="right"><a href="<?=URL?>agendasregionais/recibo/?id=<?=$agendasregionais[$i]['id']?>" title="Emitir Recibo"><img src="<?=IMG_URL?>visualizar.png" /></td>-->
								<td class="no-borda-right"><a href="<?=URL?>agendasregionais/excluir/?id=<?=$agendasregionais[$i]['id']?>" title="Remover Registro"><img src="<?=IMG_URL?>remover.png" /></td>
							
							</tr>
							<?
									$x++;
								}
								
								# se n�o haver nenhum registro
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