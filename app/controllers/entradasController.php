<?php
  
	require_once(CONTROLLERS . 'controller.php');
	  
	class EntradasController extends Controller
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
				
			$resultsPerPage = 10;
			
			## PERMISSOES
			if(!empty($_SESSION['USUARIO_REGIONAL_ID']))
			{
				$criterio_permissao = ' and i.id = e.igreja_id and i.regional_id = ' . $_SESSION['USUARIO_REGIONAL_ID'];
			}

			#query
			$q = Doctrine_Query::create()
				->from('Entradas e')
				->leftJoin('e.Igrejas i')
				->where('1=1 ' . $sqlString . $criterio_permissao)
				->orderby('e.data_entrada asc');			
			
			# criando o objeto pager
			$pager = new Doctrine_Pager($q, $currentPage, $resultsPerPage);
			
			# executa o pager
			$pager->execute();

			# dados da paginação
			$paginacao = array('pagina_atual' => $pager->getPage(),
							   'primeiro_indice' => $pager->getFirstIndice(),
							   'ultimo_indice' => $pager->getLastIndice(),
							   'total_resultados' => $pager->getNumResults(),
							   'primeiro' => URL . 'entradas/index/?pg=' . $pager->getFirstPage(),
							   'anterior' => URL . 'entradas/index/?pg=' . $pager->getPreviousPage(),
							   'proximo' => URL . 'entradas/index/?pg=' . $pager->getNextPage(),
							   'ultimo' => URL . 'entradas/index/?pg=' . $pager->getLastPage());
			
			return array('entradas' => $pager->execute()->toArray(),
						 'paginacao' => $paginacao);
		}
		
		  function salvar($entradas)
		  {
			try
				{
					$entradas->save();
					setMensagem("Registro gravado com sucesso!");
					header('Location: ' . URL . 'entradas/index'); exit;
				}
				catch(Doctrine_Connection_Exception $e) 
				{
					echo 'Código: ' . $e->getPortableCode();
					echo '<br>Mensagem: ' . $e->getPortableMessage();
				}
		  }

		  function buscaPorId($id)
		  {
			  $entradaTable = Doctrine::getTable("entradas");
			  $entrada = $entradaTable->find($id);
			  
			  return $entrada;
		  }
		  
		  function listarTodos()
		  {
			  $entradaTable = Doctrine::getTable("entradas");
			  $entradas = $entradaTable->findAll();
			  
			  return $entradas;
		  }
		  
		  function excluir($id)
		  {
			  $q = Doctrine_Query::create()
				   ->delete('Entradas s')
				   ->where('s.id = ?', $id);
			  
			  $q->execute();
			  
			  setMensagem("Registro excluído com sucesso!");
					header('Location: ' . URL . 'entradas/index');
		  }
	  }
	?>
