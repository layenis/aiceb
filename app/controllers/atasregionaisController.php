<?php

require_once(CONTROLLERS . 'controller.php');

class AtasRegionaisController extends Controller
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
			$criterio_permissao = ' and a.regional_id = ' . $_SESSION['USUARIO_REGIONAL_ID'];
		}
		###
			
		#query
		$q = Doctrine_Query::create()
			->from('AtasRegionais a')
			->where('1=1 ' . $sqlString . $criterio_permissao)
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
						   'primeiro' => URL . 'atasregionais/index/?pg=' . $pager->getFirstPage(),
						   'anterior' => URL . 'atasregionais/index/?pg=' . $pager->getPreviousPage(),
						   'proximo' => URL . 'atasregionais/index/?pg=' . $pager->getNextPage(),
						   'ultimo' => URL . 'atasregionais/index/?pg=' . $pager->getLastPage());
		
		return array('atasregionais' => $pager->execute()->toArray(),
					 'paginacao' => $paginacao);
	}
	
	function salvar($atasregionais)
	{
		try
		{
			$atasregionais->save();
			setMensagem("Registro gravado com sucesso!");
			header('Location: ' . URL . 'atasregionais/index'); exit;
		}
		catch(Doctrine_Connection_Exception $e) 
		{
			echo 'Código: ' . $e->getPortableCode();
			echo '<br>Mensagem: ' . $e->getPortableMessage();
		}
	}

	function buscaPorId($id)
	{
		$atasTable = Doctrine::getTable("AtasRegionais");
		$ata = $atasTable->find($id);
	  
		return $ata;
	}
  
	function listarTodos()
	{
		$atasTable = Doctrine::getTable("AtasRegionais");
		$atasregionais = $atasTable->findAll();
	  
		return $atasregionais;
	}
  
	function excluir($id)
	{
		$q = Doctrine_Query::create()
			->delete('AtasRegionais a')
			->where('a.id = ?', $id);
	  
		$q->execute();
	  
		setMensagem("Registro excluído com sucesso!");
		header('Location: ' . URL . 'atasregionais/index');
	}
}
?>
