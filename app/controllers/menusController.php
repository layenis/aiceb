<?php	
	require_once(CONTROLLERS . 'controller.php');
	
	class MenusController extends Controller
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
					->from('Menus')
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
							   'primeiro' => URL . 'menus/index/?pg=' . $pager->getFirstPage(),
							   'anterior' => URL . 'menus/index/?pg=' . $pager->getPreviousPage(),
							   'proximo' => URL . 'menus/index/?pg=' . $pager->getNextPage(),
							   'ultimo' => URL . 'menus/index/?pg=' . $pager->getLastPage());
			
			return array('menus' => $pager->execute()->toArray(),
						 'paginacao' => $paginacao);
		}
		
		function novo()
		{
			
		}
		
		function salvar($menus)
		{	
			try
			{
				$menus->save();
				
				setMensagem("Registro gravado com sucesso!");
				header('Location: ' . URL . 'menus/index'); 
				exit;
			}
			catch(Doctrine_Connection_Exception $e) 
			{
				echo 'Código: ' . $e->getPortableCode();
				echo '<br>Mensagem: ' . $e->getPortableMessage();
			}
		}
		
		function editar($menus)
		{				
		
		}
		
		function excluir($id)
		{
			$igrejaTable = Doctrine_Core::getTable("Menus");
			
			$igreja = $igrejaTable->find($id);
			
			if($igreja !== false) 
			{
				$igreja->delete();
			}
		}
		
		function buscaPorId($id)
		{
			$menusTable = Doctrine::getTable("Menus");
			$menus = $menusTable->find($id);
			
			return $menus;
		}
	}
?>
