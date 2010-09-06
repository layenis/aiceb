<?php
	class StatusController
	{
		function index()
		{
			
		}
		
		function mudar_status($p_id, $p_status, $p_tabela)
		{
			$q = Doctrine_Query::Create()
					->update(ucfirst($p_tabela))
					->set('status', $p_status)
					->where('id = ?', $p_id);
			$q->execute();
		}
	}
?>