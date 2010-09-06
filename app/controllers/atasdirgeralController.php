<?php

require_once(CONTROLLERS . 'controller.php');

class AtasDirgeralController extends Controller
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

		#query
		$q = Doctrine_Query::create()
			->from('AtasDirgeral a')
			->where('1=1 ' . $sqlString)
			->orderby('a.data_ata asc');

		# criando o objeto pager
		$pager = new Doctrine_Pager($q, $currentPage, $resultsPerPage);

		# executa o pager
		$pager->execute();

		# dados da paginação
		$paginacao = array('pagina_atual' => $pager->getPage(),
						   'primeiro_indice' => $pager->getFirstIndice(),
						   'ultimo_indice' => $pager->getLastIndice(),
						   'total_resultados' => $pager->getNumResults(),
						   'primeiro' => URL . 'atasdirgeral/index/?pg=' . $pager->getFirstPage(),
						   'anterior' => URL . 'atasdirgeral/index/?pg=' . $pager->getPreviousPage(),
						   'proximo' => URL . 'atasdirgeral/index/?pg=' . $pager->getNextPage(),
						   'ultimo' => URL . 'atasdirgeral/index/?pg=' . $pager->getLastPage());
		
		return array('atasdirgeral' => $pager->execute()->toArray(),
					 'paginacao' => $paginacao);
	}
	
	function salvar($atasdirgeral)
	{
		try
		{
			$atasdirgeral->save();
			setMensagem("Registro gravado com sucesso!");
			header('Location: ' . URL . 'atasdirgeral/index'); exit;
		}
		catch(Doctrine_Connection_Exception $e) 
		{
			echo 'Código: ' . $e->getPortableCode();
			echo '<br>Mensagem: ' . $e->getPortableMessage();
		}
	}

	function buscaPorId($id)
	{
		$atasTable = Doctrine::getTable("AtasDirgeral");
		$ata = $atasTable->find($id);
	  
		return $ata;
	}
  
	function listarTodos()
	{
		$atasTable = Doctrine::getTable("AtasDirgeral");
		$atasdirgeral = $atasTable->findAll();
	  
		return $atasdirgeral;
	}
  
	function excluir($id)
	{
		$q = Doctrine_Query::create()
			->delete('AtasDirgeral a')
			->where('a.id = ?', $id);
	  
		$q->execute();
	  
		setMensagem("Registro excluído com sucesso!");
		header('Location: ' . URL . 'atasdirgeral/index');
	}
}
?>
