<?php
	# Funчуo para Status
	
	$id = (int) get('p_id');
	$status = (int) get('p_status');
	$tabela = get('p_tabela');

	if(!empty($id) && !empty($tabela) && ($status == 1 or $status == 0))
	{
		require_once(CONTROLLERS . 'statusController.php');
		
		$statusController = new StatusController();
		$statusController->mudar_status($id, $status, $tabela);	
	}
	else
	{
		echo 'Nуo foi possivel mudar o Status';
	}
?>