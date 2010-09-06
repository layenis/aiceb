<?php

	require_once(CONTROLLERS . 'controller.php');

	class RelatoriosController extends Controller
	{
		function __construct()
		{

		}
		
		function buscaEntradasRegional($regional_id, $mes, $ano)
		{
			$q = Doctrine_Query::create()
				->from('Entradas e')
				->leftJoin('e.Igrejas i')
				->where('1=1 and i.id = e.igreja_id and i.regional_id = ' . $_SESSION['USUARIO_REGIONAL_ID'] 
						. " and mes_deposito =  '" . $mes . "'"	. 'and year(data_entrada) = ' . $ano)
				->orderby('e.data_entrada asc');	
			
			$entradas = $q->execute();
			
			return $entradas;
		}

		function view($id)
		{
			$atasTable = Doctrine::getTable("AgendasGerais");
			$ata = $atasTable->find($id);
		  
			return $ata;
		}
	  
		function listarTodos()
		{
			$atasTable = Doctrine::getTable("AgendasGerais");
			$agendasgerais = $atasTable->findAll();
		  
			return $agendasgerais;
		}
	  
		function excluir($id)
		{
			$q = Doctrine_Query::create()
				->delete('AgendasGerais a')
				->where('a.id = ?', $id);
		  
			$q->execute();
		  
			setMensagem("Registro exclu�do com sucesso!");
			header('Location: ' . URL . 'agendasgerais/index');
		}
	}
?>
