<?php
  
  require_once(CONTROLLERS . 'controller.php');
  
  class ObreirosController extends Controller
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
  					->from('Obreiros o')
  					->where('1=1 ' . $sqlString)				
					->orderby('o.id desc');
        
        # criando o objeto pager
         $pager = new Doctrine_Pager($q, $currentPage, $resultsPerPage);
			
  			# executa o pager
  			$pager->execute();
  
  			# dados da paginação
  			$paginacao = array('pagina_atual' => $pager->getPage(),
  							   'primeiro_indice' => $pager->getFirstIndice(),
  							   'ultimo_indice' => $pager->getLastIndice(),
  							   'total_resultados' => $pager->getNumResults(),
  							   'primeiro' => URL . 'obreiros/index/?pg=' . $pager->getFirstPage(),
  							   'anterior' => URL . 'obreiros/index/?pg=' . $pager->getPreviousPage(),
  							   'proximo' => URL . 'obreiros/index/?pg=' . $pager->getNextPage(),
  							   'ultimo' => URL . 'obreiros/index/?pg=' . $pager->getLastPage());
  			
  			return array('obreiros' => $pager->execute()->toArray(),
  						 'paginacao' => $paginacao);
  			
  		}
		
      function salvar($obreiros)
      {
			try
  			{
  				$obreiros->save();
  				setMensagem("Registro gravado com sucesso!");
  				header('Location: ' . URL . 'obreiros/index'); exit;
  			}
  			catch(Doctrine_Connection_Exception $e) 
  			{
  				echo 'Código: ' . $e->getPortableCode();
  				echo '<br>Mensagem: ' . $e->getPortableMessage();
  			}
      }

      function buscaPorId($id)
      {
          $obreiroTable = Doctrine::getTable("obreiros");
          $obreiro = $obreiroTable->find($id);
          
          return $obreiro;
      }
      
      function listarTodos()
      {
          $obreiroTable = Doctrine::getTable("obreiros");
          $obreiros = $obreiroTable->findAll();
          
          return $obreiros;
      }
      
      function excluir($id)
      {
          $q = Doctrine_Query::create()
               ->delete('Obreiros o')
               ->where('o.id = ?', $id);
          
          $q->execute();
          
          setMensagem("Registro excluído com sucesso!");
  				header('Location:' . URL . 'obreiros/index');
      }

  }
?>
