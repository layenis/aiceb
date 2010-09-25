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

		return $this->paginacao($q, 'agendasgerais', $currentPage, $resultsPerPage);
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
