<?php	
	require_once(CONTROLLERS . 'controller.php');
	
	class SubmenusController extends Controller
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
					->from('Submenus')
					->where('1=1 ' . $sqlString)
					->orderby('posicao asc, id desc');

			# criando o objeto pager
			$pager = new Doctrine_Pager($q, $currentPage, $resultsPerPage);
			
			# executa o pager
			$pager->execute();

			# dados da paginação
			$paginacao = array('pagina_atual' => $pager->getPage(),
							   'primeiro_indice' => $pager->getFirstIndice(),
							   'ultimo_indice' => $pager->getLastIndice(),
							   'total_resultados' => $pager->getNumResults(),
							   'primeiro' => URL . 'submenus/index/?pg=' . $pager->getFirstPage(),
							   'anterior' => URL . 'submenus/index/?pg=' . $pager->getPreviousPage(),
							   'proximo' => URL . 'submenus/index/?pg=' . $pager->getNextPage(),
							   'ultimo' => URL . 'submenus/index/?pg=' . $pager->getLastPage());
			
			return array('submenus' => $pager->execute()->toArray(),
						 'paginacao' => $paginacao);
		}
		
		function novo()
		{
			
		}
		
		function salvar($submenus)
		{	
			try
			{
				$submenus->save();
				
				setMensagem("Registro gravado com sucesso!");
				header('Location: ' . URL . 'submenus/index'); 
				exit;
			}
			catch(Doctrine_Connection_Exception $e) 
			{
				echo 'Código: ' . $e->getPortableCode();
				echo '<br>Mensagem: ' . $e->getPortableMessage();
			}
		}
		
		function editar($submenus)
		{				
		
		}
		
		function excluir($id)
		{
			$igrejaTable = Doctrine_Core::getTable("Submenus");
			
			$igreja = $igrejaTable->find($id);
			
			if($igreja !== false) 
			{
				$igreja->delete();
			}
		}
		
		function buscaPorId($id)
		{
			$submenusTable = Doctrine::getTable("Submenus");
			$submenus = $submenusTable->find($id);
			
			return $submenus;
		}
	}
?>
