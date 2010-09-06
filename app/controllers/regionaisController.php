<?php
  
  require_once(CONTROLLERS . 'controller.php');
  
  class RegionaisController extends Controller
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
				$criterio_permissao = ' and r.id = ' . $_SESSION['USUARIO_REGIONAL_ID'];
			}
			###
			
  			# query
  			$q = Doctrine_Query::create()
  					 ->from('Regionais r')
  					 ->where('1=1 ' . $sqlString . $criterio_permissao)
             ->orderby('r.id desc');
             
        # criando o objeto pager
  			$pager = new Doctrine_Pager($q, $currentPage, $resultsPerPage);
  
  			# executa o pager
  			$pager->execute();
  
  			# dados da paginação
			$paginacao = array('pagina_atual' => $pager->getPage(),
							   'primeiro_indice' => $pager->getFirstIndice(),
							   'ultimo_indice' => $pager->getLastIndice(),
							   'total_resultados' => $pager->getNumResults(),
							   'primeiro' => URL . 'regionais/index/?pg=' . $pager->getFirstPage(),
							   'anterior' => URL . 'regionais/index/?pg=' . $pager->getPreviousPage(),
							   'proximo' => URL . 'regionais/index/?pg=' . $pager->getNextPage(),
							   'ultimo' => URL . 'regionais/index/?pg=' . $pager->getLastPage(),
							   'ultimo_numero' => $pager->getLastPage(),
							   'anterior_numero' => $pager->getPreviousPage(),
							   'proximo_numero' => $pager->getNextPage());
  			
  			return array('regionais' => $pager->execute()->toArray(),
  						 'paginacao' => $paginacao);
  		}
		
      function salvar($regionais)
      {
        try
  			{
  				$regionais->save();
  				setMensagem("Registro gravado com sucesso!");
  				header('Location: ' . URL . 'regionais/index'); 
				exit;
  			}
  			catch(Doctrine_Connection_Exception $e) 
  			{
  				echo 'Código: ' . $e->getPortableCode();
  				echo '<br>Mensagem: ' . $e->getPortableMessage();
  			}
      }

      function buscaPorId($id)
      {
          $regionaisTable = Doctrine::getTable("Regionais");
          $regionais = $regionaisTable->find($id);
          
          return $regionais;
      }
      
      function listarTodos()
      {
          $regionalTable = Doctrine::getTable("regionais");
          $regionais = $regionalTable->findAll();
          
          return $regionais;
      }
      
      function excluir($id)
      {
			$q = Doctrine_Query::create()
				->delete('Regionais r')
				->where('r.id = ?', $id);
			$q->execute();

			setMensagem("Registro excluído com sucesso!");
			header('Location: ' . URL . 'regionais/index');
      }
  }
?>
