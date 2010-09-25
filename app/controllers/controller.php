<?php
	class Controller
	{
		function paginacao($p_query, $p_tabela, $p_currentPage, $p_resultsPerPage)
		{
			# criando o objeto pager
			$pager = new Doctrine_Pager($p_query, $p_currentPage, $p_resultsPerPage);

			# executa o pager
			$pager->execute();

			# dados da paginaчуo
			$paginacao = array('pagina_atual' => $pager->getPage(),
							   'primeiro_indice' => $pager->getFirstIndice(),
							   'ultimo_indice' => $pager->getLastIndice(),
							   'total_resultados' => $pager->getNumResults(),
							   'primeiro' => URL . strtolower($p_tabela) . '/index/?pg=' . $pager->getFirstPage(),
							   'anterior' => URL . strtolower($p_tabela) . '/index/?pg=' . $pager->getPreviousPage(),
							   'proximo' => URL . strtolower($p_tabela) . '/index/?pg=' . $pager->getNextPage(),
							   'ultimo' => URL . strtolower($p_tabela) . '/index/?pg=' . $pager->getLastPage(),
							   'ultimo_numero' => $pager->getLastPage(),
							   'anterior_numero' => $pager->getPreviousPage(),
							   'proximo_numero' => $pager->getNextPage());
			
			return array(strtolower($p_tabela) => $pager->execute()->toArray(),
						 'paginacao' => $paginacao);
		}
	}
?>