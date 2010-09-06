<?php
	session_start();
	
	require_once(CONTROLLERS . 'tiposController.php');
	
	$tiposController = new TiposController();
	
	$tipo_id = (int) get('tipo_id');
	$tabela_id = (int) get('tabela_id');
	$permissao = (int) get('permissao');
	
	if(!empty($tipo_id) && !empty($tabela_id) && ($permissao == 0 or $permissao == 1 or $permissao == 2 or $permissao == 3))
	{
		$tiposController->mudarPermissao($tipo_id, $tabela_id, $permissao);
		
		switch($permissao)
		{
			case 0:
				$img_permissao_zero = '<img src="'.IMG_URL.'status-ok.png" />';
				$img_permissao_um = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$tabela_id.', 1);"><img src="'.IMG_URL.'status-no.png" /></a>';
				$img_permissao_dois = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$tabela_id.', 2);"><img src="'.IMG_URL.'status-no.png" /></a>';
				$img_permissao_tres = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$tabela_id.', 3);"><img src="'.IMG_URL.'status-no.png" /></a>';
				break;
				
			case 1:										
				$img_permissao_um = '<img src="'.IMG_URL.'status-ok.png" />';
				$img_permissao_zero = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$tabela_id.', 0);"><img src="'.IMG_URL.'status-no.png" /></a>';
				$img_permissao_dois = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$tabela_id.', 2);"><img src="'.IMG_URL.'status-no.png" /></a>';
				$img_permissao_tres = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$tabela_id.', 3);"><img src="'.IMG_URL.'status-no.png" /></a>';
				break;
				
			case 2:
				$img_permissao_dois = '<img src="'.IMG_URL.'status-ok.png" />';
				$img_permissao_zero = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$tabela_id.', 0);"><img src="'.IMG_URL.'status-no.png" /></a>';
				$img_permissao_um = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$tabela_id.', 1);"><img src="'.IMG_URL.'status-no.png" /></a>';
				$img_permissao_tres = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$tabela_id.', 3);"><img src="'.IMG_URL.'status-no.png" /></a>';
				break;
				
			case 3:
				$img_permissao_tres = '<img src="'.IMG_URL.'status-ok.png" />';
				$img_permissao_zero = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$tabela_id.', 0);"><img src="'.IMG_URL.'status-no.png" /></a>';
				$img_permissao_um = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$tabela_id.', 1);"><img src="'.IMG_URL.'status-no.png" /></a>';
				$img_permissao_dois = '<a href="javascript:;" onClick="javascrip: mudarPermissao('.$tipo_id.', '.$tabela_id.', 2);"><img src="'.IMG_URL.'status-no.png" /></a>';
				break;
		}
?>

	<li style="margin-top: 5px; width: 110px;text-align: left; padding-left: 10px;"><?=utf8_encode(select('Tabelas', 'nome', $tabela_id))?></li>
	<li><?=$img_permissao_zero?></li>
	<li><?=$img_permissao_um?></li>
	<li><?=$img_permissao_dois?></li>
	<li><?=$img_permissao_tres?></li>
	
<?
	}
?>