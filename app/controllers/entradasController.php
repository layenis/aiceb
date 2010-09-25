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
			
			return $this->paginacao($q, 'entradas', $currentPage, $resultsPerPage);
		}
		
		function salvar($entradas)
		{	
			$entradas->save();
			
			try
			{
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
