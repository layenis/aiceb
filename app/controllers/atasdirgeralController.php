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

		# query
		$q = Doctrine_Query::create()
			->from('AtasDirgeral a')
			->where('1=1 ' . $sqlString)
			->orderby('a.data_ata asc');

		return $this->paginacao($q, 'atasdirgeral', $currentPage, $resultsPerPage);
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
