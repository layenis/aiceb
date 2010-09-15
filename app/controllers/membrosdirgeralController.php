<?php

	require_once(CONTROLLERS . 'controller.php');

	class MembrosDirgeralController extends Controller
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
				$criterio_permissao = ' and m.regional_id = ' . $_SESSION['USUARIO_REGIONAL_ID'];
			}
			###

			#query
			$q = Doctrine_Query::create()
				->from('MembrosDirgeral m')
				//->leftJoin('m.Igrejas i')
				->where('1=1 ' . $sqlString . $criterio_permissao)
				->orderby('m.nome');

			# criando o objeto pager
			$pager = new Doctrine_Pager($q, $currentPage, $resultsPerPage);

			# executa o pager
			$pager->execute();

			# dados da paginação
			$paginacao = array('pagina_atual' => $pager->getPage(),
							   'primeiro_indice' => $pager->getFirstIndice(),
							   'ultimo_indice' => $pager->getLastIndice(),
							   'total_resultados' => $pager->getNumResults(),
							   'primeiro' => URL . 'membrosdirgeral/index/?pg=' . $pager->getFirstPage(),
							   'anterior' => URL . 'membrosdirgeral/index/?pg=' . $pager->getPreviousPage(),
							   'proximo' => URL . 'membrosdirgeral/index/?pg=' . $pager->getNextPage(),
							   'ultimo' => URL . 'membrosdirgeral/index/?pg=' . $pager->getLastPage());
			
			return array('membrosdirgeral' => $pager->execute()->toArray(),
						 'paginacao' => $paginacao);
		}
		
		function salvar($membrosdirgeral)
		{
			try
			{
				$membrosdirgeral->save();
				setMensagem("Registro gravado com sucesso!");
				header('Location: ' . URL . 'membrosdirgeral/index'); exit;
			}
			catch(Doctrine_Connection_Exception $e) 
			{
				echo 'Código: ' . $e->getPortableCode();
				echo '<br>Mensagem: ' . $e->getPortableMessage();
			}
		}

		function buscaPorId($id)
		{
			$membrosTable = Doctrine::getTable("MembrosDirgeral");
			$membro = $membrosTable->find($id);
		  
			return $membro;
		}
	  
		function listarTodos()
		{
			$membrosTable = Doctrine::getTable("MembrosDirgeral");
			$membrosdirgeral = $membrosTable->findAll();
		  
			return $membrosdirgeral;
		}
	  
		function excluir($id)
		{
			$q = Doctrine_Query::create()
				->delete('MembrosDirgeral m')
				->where('m.id = ?', $id);
		  
			$q->execute();
		  
			setMensagem("Registro excluído com sucesso!");
			header('Location: ' . URL . 'membrosdirgeral/index');
		}
	}
?>
