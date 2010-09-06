<?php
	session_start();
	
	require_once(CONTROLLERS . 'menusController.php');
	
	$menusController = new MenusController();
	
	# paginacao
	$pg = (int) get('pg');
	
	#####	
	$nome = get('nome');
	if(!empty($nome))
	{
		$queryString .= '&nome=' . $nome;
		$sqlString .= ' and nome like "%'.$nome.'%"';
	}
	#
	
	# chama a action index
	$objIndex = $menusController->index($pg, $queryString, $sqlString); 
	
	# extrair as variaveis do array
	extract($objIndex);
	
	# total de registros
	$total = count($menus);
	
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
			
			<? include(VIEWS . 'menus' . DS . 'sub-menu.php'); ?>
			
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

						<form name="filtros" method="get" action="<?=URL . 'menus/index/'?>">
							<div class="bloco-ft">
								<label>Nome</label>
								<input class="text-edit" type="text" name="nome" id="nome" value="<?=$nome?>" size="42" maxlength="40" />
							</div>
							
							<div class="box-botao">
								<input type="submit" name="enviar-filtro" value="Enviar" class="botao-filtro" />
							</div>
						</form>
					</div>
					
					<div class="conteudo-pg">
						<span class="info-pg">Listando <?=$paginacao['primeiro_indice']?> até <?=$paginacao['ultimo_indice']?> de <?=$paginacao['total_resultados']?> registros</span>
						
						<div class="paginacao">
							<div class="botoes-pg radios-left"><a href="<?=$paginacao['primeiro']?>" title="Primeiro">Primeiro</a></div>
							<div class="botoes-pg"><a href="<?=$paginacao['anterior']?>" title="Anterior">Anterior</a></div>
							<div class="botoes-pg"><?=$paginacao['pagina_atual']?></div>
							<div class="botoes-pg"><a href="<?=$paginacao['proximo']?>" title="Próximo">Próximo</a></div>
							<div class="botoes-pg radios-right"><a href="<?=$paginacao['ultimo']?>" title="Último">Último</a></div>
						</div>
					</div>
					
					<div class="conteudo-rg">					
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela-rg">
							
							<!-- titulo dos campos listados -->
							<tr class="menu-rg">
								<th width="90">Posição</th>
								<th align="left" width="575">Nome</th>
								<th width="90">Criado</th>								
								<th width="60">Status</th>
								
								<!-- -->
								<th class="no-borda-right" colspan="2">Ações</th>
							</tr>
							
							<!-- campos a serem listados > bg > active-tr -->
							<?
								$x = 0;
								
								for($i=0; $i<$total; $i++)
								{
									if($x % 2 == 0) $bg = 'active-tr'; else $bg = '';
									
									# regras de negócios para status
									if($menus[$i]['status'] == 1)
									{
										$status = '<img onClick="javascript: atualizarStatus(0, '.$menus[$i]['id'].', \'menus\');" src="'.IMG_URL.'status-ok.png" alt="Alterar Status" />';
									}
									elseif($menus[$i]['status'] == 0)
									{
										$status = '<img onClick="javascript: atualizarStatus(1, '.$menus[$i]['id'].', \'menus\');" src="'.IMG_URL.'status-no.png" alt="Alterar Status" />';
									}
							?>
							<tr class="listar-rg <?=$bg?>">
								
								<td><?=$menus[$i]['posicao']?></td>
								
								<td align="left"><strong><a href="<?=URL?>menus/editar/?id=<?=$menus[$i]['id']?>" title="<?=$menus[$i]['nome']?>"><?=$menus[$i]['nome']?></a></strong></td>
								
								<td><?=$menus[$i]['created_at']?></td>
								
								<!-- status -->
								<td id="status-<?=$menus[$i]['id']?>"><?=$status?></td>
								
								<!-- -->
								<!--<td class="no-borda-right" align="right"><a href="visualizar.html" title="Visualizar Registro"><img src="<?=IMG_URL?>visualizar.png" /></td>-->
								<td class="no-borda-right"><a href="<?=URL?>menus/remover/?id=<?=$menus[$i]['id']?>" title="Remover Registro"><img src="<?=IMG_URL?>remover.png" /></td>
							
							</tr>
							<?
									$x++;
								}
								
								# se não haver nenhum registro
								if($paginacao['total_resultados'] == 0)
								{
							?>
							<tr class="listar-rg">
								
								<td align="left" colspan="6" style="font-size: 16px;"><strong>Nenhum registro encontrado.</strong></td>
							
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