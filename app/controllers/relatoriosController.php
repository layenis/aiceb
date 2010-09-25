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

		function buscaTodasEntradas($mes, $ano)
		{
			$q = Doctrine_Query::create()
				->from('Entradas e')
				->leftJoin('e.Igrejas i')
				->where('1=1 and i.id = e.igreja_id and mes_deposito =  ' . "'" . $mes . "'" . ' and year(data_entrada) = ' . $ano)
				->orderby('e.data_entrada asc');	
			
			$entradas = $q->execute();
						
			return $entradas;
			
		}
	}
?>
