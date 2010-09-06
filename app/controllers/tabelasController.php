<?php	
	require_once(CONTROLLERS . 'controller.php');
	
	class TabelasController extends Controller
	{
		function __construct()
		{
			
		}
		
		function index($pg=null, $queryString=null, $sqlString=null)
		{
			# definindo variaveis iniciais
			if(empty($pg))
				$currentPage = 1;
			else
				$currentPage = $pg;
			
			# resultados por página
			$resultsPerPage = 10;
			
			# query
			$q = Doctrine_Query::create()
					->from('Tabelas')
					->where('1=1 ' . $sqlString)
					->orderby('id desc');

			# criando o objeto pager
			$pager = new Doctrine_Pager($q, $currentPage, $resultsPerPage);
			
			# executa o pager
			$pager->execute();

			# dados da paginação
			$paginacao = array('pagina_atual' => $pager->getPage(),
							   'primeiro_indice' => $pager->getFirstIndice(),
							   'ultimo_indice' => $pager->getLastIndice(),
							   'total_resultados' => $pager->getNumResults(),
							   'primeiro' => URL . 'tabelas/index/?pg=' . $pager->getFirstPage(),
							   'anterior' => URL . 'tabelas/index/?pg=' . $pager->getPreviousPage(),
							   'proximo' => URL . 'tabelas/index/?pg=' . $pager->getNextPage(),
							   'ultimo' => URL . 'tabelas/index/?pg=' . $pager->getLastPage());
			
			return array('tabelas' => $pager->execute()->toArray(),
						 'paginacao' => $paginacao);
		}
		
		function novo()
		{
			
		}
		
		function salvar($tabelas)
		{	
			try
			{
				$tabelas->save();
				
				setMensagem("Registro gravado com sucesso!");
				header('Location: ' . URL . 'tabelas/index'); 
				exit;
			}
			catch(Doctrine_Connection_Exception $e) 
			{
				echo 'Código: ' . $e->getPortableCode();
				echo '<br>Mensagem: ' . $e->getPortableMessage();
			}
		}
		
		function editar($tabelas)
		{				
		
		}
		
		function excluir($id)
		{
			$igrejaTable = Doctrine_Core::getTable("Tabelas");
			
			$igreja = $igrejaTable->find($id);
			
			if($igreja !== false) 
			{
				$igreja->delete();
			}
		}
		
		function buscaPorId($id)
		{
			$tabelasTable = Doctrine::getTable("Tabelas");
			$tabelas = $tabelasTable->find($id);
			
			return $tabelas;
		}
	}
?>
