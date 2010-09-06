<?php
	session_start();
	
	# verificar se o usuario está logado
	verificaLogin();
	
	require_once(CONTROLLERS . 'tiposController.php');
	
	# usuario -> id
	$tipo_id = (int) get('id');
	
	$tiposController = new tiposController();
	
	$objPermissao = $tiposController->permissoes($tipo_id);
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
			
			<? include(VIEWS . 'tipos' . DS . 'sub-menu.php'); ?>
			
			<div class="meio-conteudo-borda">
				<div class="meio-conteudo">
					<div class="permissao">
						<ul style="margin-left: 120px;">
							<li>Nenhuma</li>
							<li>Leitura</li>
							<li>Leitura / Escrita</li>
							<li>Leitura / Escrita / Remoção</li>
						</ul>
						
						<?
							$x = 0;
							
							for($i=0; $i<count($objPermissao); $i++)
							{				
								if(empty($objPermissao[$i]['TabelasTipos'][0]['permissao']))
								{
									$permissao = 0;
								}
								else
								{
									$permissao = $objPermissao[$i]['TabelasTipos'][0]['permissao'];
								}
								
								switch($permissao)
								{
									case 0:
										$img_permissao_zero = '<img src="'.IMG_URL.'status-ok.png" />';
										$img_permissao_um = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$objPermissao[$i]['id'].', 1);"><img src="'.IMG_URL.'status-no.png" /></a>';
										$img_permissao_dois = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$objPermissao[$i]['id'].', 2);"><img src="'.IMG_URL.'status-no.png" /></a>';
										$img_permissao_tres = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$objPermissao[$i]['id'].', 3);"><img src="'.IMG_URL.'status-no.png" /></a>';
										break;
										
									case 1:										
										$img_permissao_um = '<img src="'.IMG_URL.'status-ok.png" />';
										$img_permissao_zero = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$objPermissao[$i]['id'].', 0);"><img src="'.IMG_URL.'status-no.png" /></a>';
										$img_permissao_dois = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$objPermissao[$i]['id'].', 2);"><img src="'.IMG_URL.'status-no.png" /></a>';
										$img_permissao_tres = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$objPermissao[$i]['id'].', 3);"><img src="'.IMG_URL.'status-no.png" /></a>';
										break;
										
									case 2:
										$img_permissao_dois = '<img src="'.IMG_URL.'status-ok.png" />';
										$img_permissao_zero = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$objPermissao[$i]['id'].', 0);"><img src="'.IMG_URL.'status-no.png" /></a>';
										$img_permissao_um = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$objPermissao[$i]['id'].', 1);"><img src="'.IMG_URL.'status-no.png" /></a>';
										$img_permissao_tres = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$objPermissao[$i]['id'].', 3);"><img src="'.IMG_URL.'status-no.png" /></a>';
										break;
										
									case 3:
										$img_permissao_tres = '<img src="'.IMG_URL.'status-ok.png" />';
										$img_permissao_zero = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$objPermissao[$i]['id'].', 0);"><img src="'.IMG_URL.'status-no.png" /></a>';
										$img_permissao_um = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$objPermissao[$i]['id'].', 1);"><img src="'.IMG_URL.'status-no.png" /></a>';
										$img_permissao_dois = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$objPermissao[$i]['id'].', 2);"><img src="'.IMG_URL.'status-no.png" /></a>';
										break;
								}
								
								if($x % 2 == 0) $bg = 'background-color: #f5f5f1;'; else $bg = '';
						?>
						<ul style="width: 100%; <?=$bg?>" id="permissao_tabela_<?=$objPermissao[$i]['id']?>">
							<li style="margin-top: 5px; width: 110px;text-align: left; padding-left: 10px;"><?=$objPermissao[$i]['nome']?></li>
							<li><?=$img_permissao_zero?></li>
							<li><?=$img_permissao_um?></li>
							<li><?=$img_permissao_dois?></li>
							<li><?=$img_permissao_tres?></li>
						</ul>						
						<?
								$x++;
							}
						?>
						
					</div>										
				</div>
			</div>
        </div>
        
		<? include(LAYOUTS . 'rodape.php'); ?>
		
    </div>
    	
</body>
</html>