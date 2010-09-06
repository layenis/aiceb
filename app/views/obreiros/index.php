<?php
  session_start();
  	
	require_once(CONTROLLERS . 'obreirosController.php');
	
	$obreirosController = new ObreirosController();
	
	# paginacao
	$pg = (int) $_GET['pg'];
	
	#####
	$nome = $_GET['nome'];
	if(!empty($nome))
	{
		$queryString = '&endereco=' . $nome;
		$sqlString = ' and o.nome like "%'.$nome.'%"';
	}
	
	$email = $_GET['$email'];
	if(!empty($email))
	{
		$queryString .= '&bairro=' . $email;
		$sqlString .= ' and o.email like "%'.$email.'%"';
	}
	
	
  # chama a action index
	$objIndex = $obreirosController->index($pg, $queryString, $sqlString); 
	
	# extrair as variaveis do array
	extract($objIndex);
	
	# total de registros
	$total = count($obreiros);
	
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
			
			<? include(VIEWS . 'obreiros' . DS . 'sub-menu.php'); ?>
			
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

						<form name="filtros" method="get" action="<?=URL . 'obreiros/index/'?>">
						
							<div class="bloco-ft">
								<label>Nome</label>
								<input class="text-edit" type="text" name="nome" id="nome" value="<?=$nome?>" size="40" maxlength="40" />
							</div>
							
							<div class="bloco-ft">
								<label>E-mail</label>
								<input class="text-edit" type="text" name="email" id="email" value="<?=$email?>" size="40" maxlength="40" />
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
								<th align="left" width="355">Nome</th>
								<th width="200">E-mail</th>
								<th width="100">Telefone</th>
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
									if($obreiros[$i]['status'] == 1)
									{
										$status = '<img onClick="javascript: atualizarStatus(0, '.$obreiros[$i]['id'].', \'obreiros\');" src="'.IMG_URL.'status-ok.png" alt="Alterar Status" />';
									}
									elseif($obreiros[$i]['status'] == 0)
									{
										$status = '<img onClick="javascript: atualizarStatus(1, '.$obreiros[$i]['id'].', \'obreiros\');" src="'.IMG_URL.'status-no.png" alt="Alterar Status" />';
									}
							?>
							<tr class="listar-rg <?=$bg?>">
								
                <td align="left">
									<strong><a href="<?=URL?>obreiros/editar/?id=<?=$obreiros[$i]['id']?>" title="<?=$obreiros[$i]['nome']?>"><?=$obreiros[$i]['nome']?></a></strong>
								</td>
								
								<td><?=$obreiros[$i]['email']?></td>
								
								<td><?=$obreiros[$i]['telefone']?></td>
								
								<!-- status -->
								<td id="status-<?=$obreiros[$i]['id']?>"><?=$status?></td>
								
								<!-- -->
								<!--<td class="no-borda-right" align="right"><a href="visualizar.html" title="Visualizar Registro"><img src="<?=IMG_URL?>visualizar.png" /></td>-->
								<td class="no-borda-right"><a href="<?=URL?>obreiros/excluir/?id=<?=$obreiros[$i]['id']?>" title="Remover Registro"><img src="<?=IMG_URL?>remover.png" /></td>
							
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