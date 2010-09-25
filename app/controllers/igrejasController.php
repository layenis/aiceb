<?php	
	require_once(CONTROLLERS . 'controller.php');
	
	class IgrejasController extends Controller
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
			$resultsPerPage = 20;
			
			## PERMISSOES
			if(!empty($_SESSION['USUARIO_REGIONAL_ID']))
			{
				$criterio_permissao = ' and i.regional_id = ' . $_SESSION['USUARIO_REGIONAL_ID'];
			}
			###
			
			# query
			$q = Doctrine_Query::create()
					->from('Igrejas i')
					->where('1=1 ' . $sqlString . $criterio_permissao)
					->orderby('i.id desc');

			# criando o objeto pager
			$pager = new Doctrine_Pager($q, $currentPage, $resultsPerPage);
			
			# executa o pager
			$pager->execute();

			# dados da paginação
			$paginacao = array('pagina_atual' => $pager->getPage(),
							   'primeiro_indice' => $pager->getFirstIndice(),
							   'ultimo_indice' => $pager->getLastIndice(),
							   'total_resultados' => $pager->getNumResults(),
							   'primeiro' => URL . 'igrejas/index/?pg=' . $pager->getFirstPage(),
							   'anterior' => URL . 'igrejas/index/?pg=' . $pager->getPreviousPage(),
							   'proximo' => URL . 'igrejas/index/?pg=' . $pager->getNextPage(),
							   'ultimo' => URL . 'igrejas/index/?pg=' . $pager->getLastPage(),
							   'ultimo_numero' => $pager->getLastPage(),
							   'anterior_numero' => $pager->getPreviousPage(),
							   'proximo_numero' => $pager->getNextPage());
			
			return array('igrejas' => $pager->execute()->toArray(),
						 'paginacao' => $paginacao);
		}
		
		function novo()
		{
			
		}
		
		function salvar($igrejas)
		{				
			try
			{					
				$igrejas->save();
				
				setMensagem("Registro gravado com sucesso!");
				header('Location: ' . URL . 'igrejas/index'); 
				exit;
			}
			catch(Doctrine_Connection_Exception $e) 
			{
				echo 'Código: ' . $e->getPortableCode();
				echo '<br>Mensagem: ' . $e->getPortableMessage();
			}
		}
		
		function editar($igrejas)
		{				
		
		}
		
		function buscaPorRegional()
		{
			$igrejas = new Igrejas();

			$q = Doctrine_Query::create()
				->from('Igrejas i')
				->where('i.regional_id = ?' , $_SESSION['USUARIO_REGIONAL_ID'])
				->orderby('i.nome_fantasia');
			
			$igrejas = $q->execute();
			
			return $igrejas;
		}
		
		function excluir($id)
		{
			$igrejasTable = Doctrine_Core::getTable("Igrejas");
			
			$igrejas = $igrejasTable->find($id);
			
			if($igrejas !== false) 
			{
				$igrejas->delete();
			}
		}
		
		function buscaPorId($id)
		{
			$igrejaTable = Doctrine::getTable("Igrejas");
			$igreja = $igrejaTable->find($id);
			
			return $igreja;
		}
	}
?>
