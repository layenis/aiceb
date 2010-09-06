<?php

require_once(CONTROLLERS . 'controller.php');

class AgendasGeraisController extends Controller
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
			->from('AgendasGerais a')
			->where('1=1 ' . $sqlString)
			->orderby('a.data_agenda asc');

		# criando o objeto pager
		$pager = new Doctrine_Pager($q, $currentPage, $resultsPerPage);

		# executa o pager
		$pager->execute();

		# dados da paginação
		$paginacao = array('pagina_atual' => $pager->getPage(),
						   'primeiro_indice' => $pager->getFirstIndice(),
						   'ultimo_indice' => $pager->getLastIndice(),
						   'total_resultados' => $pager->getNumResults(),
						   'primeiro' => URL . 'agendasgerais/index/?pg=' . $pager->getFirstPage(),
						   'anterior' => URL . 'agendasgerais/index/?pg=' . $pager->getPreviousPage(),
						   'proximo' => URL . 'agendasgerais/index/?pg=' . $pager->getNextPage(),
						   'ultimo' => URL . 'agendasgerais/index/?pg=' . $pager->getLastPage());
		
		return array('agendasgerais' => $pager->execute()->toArray(),
					 'paginacao' => $paginacao);
	}
	
	function salvar($agendasgerais)
	{
		try
		{
			$agendasgerais->save();
			setMensagem("Registro gravado com sucesso!");
			header('Location: ' . URL . 'agendasgerais/index'); exit;
		}
		catch(Doctrine_Connection_Exception $e) 
		{
			echo 'Código: ' . $e->getPortableCode();
			echo '<br>Mensagem: ' . $e->getPortableMessage();
		}
	}

	function buscaPorId($id)
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
	  
		setMensagem("Registro excluído com sucesso!");
		header('Location: ' . URL . 'agendasgerais/index');
	}
}
?>
