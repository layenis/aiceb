<?php	
	require_once(CONTROLLERS . 'controller.php');
	
	class UsuariosController extends Controller
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
			$resultsPerPage = 10;
			
			# query
			$q = Doctrine_Query::create()
					->from('Usuarios')
					->where('1=1 ' . $sqlString)
					->orderby('id desc');

			# criando o objeto pager
			$pager = new Doctrine_Pager($q, $currentPage, $resultsPerPage);
			
			# executa o pager
			$pager->execute();

			# dados da paginação
			$paginacao = array('pagina_atual' => $pager->getPage(),
							   'primeiro_indice' => $pager->getFirstIndice(),
							   'ultimo_indice' => $pager->getLastIndice(),
							   'total_resultados' => $pager->getNumResults(),
							   'primeiro' => URL . 'usuarios/index/?pg=' . $pager->getFirstPage(),
							   'anterior' => URL . 'usuarios/index/?pg=' . $pager->getPreviousPage(),
							   'proximo' => URL . 'usuarios/index/?pg=' . $pager->getNextPage(),
							   'ultimo' => URL . 'usuarios/index/?pg=' . $pager->getLastPage());
			
			return array('usuarios' => $pager->execute()->toArray(),
						 'paginacao' => $paginacao);
		}
		
		function novo()
		{
			
		}
		
		function salvar($usuarios)
		{	
			try
			{
				$usuarios->save();
				
				setMensagem("Registro gravado com sucesso!");
				header('Location: ' . URL . 'usuarios/index'); 
				exit;
			}
			catch(Doctrine_Connection_Exception $e) 
			{
				echo 'Código: ' . $e->getPortableCode();
				echo '<br>Mensagem: ' . $e->getPortableMessage();
			}
		}
		
		function editar($usuarios)
		{				
		
		}
		
		function excluir($id)
		{
			$igrejaTable = Doctrine_Core::getTable("Usuarios");
			
			$igreja = $igrejaTable->find($id);
			
			if($igreja !== false) 
			{
				$igreja->delete();
			}
		}
		
		function buscaPorId($id)
		{
			$usuariosTable = Doctrine::getTable("Usuarios");
			$usuarios = $usuariosTable->find($id);
			
			return $usuarios;
		}
		
		function buscaPorLogin($login=null, $id=null)
		{
			if(!empty($id))
				$criterio = ' and id != ' . $id;
			
			$q = Doctrine_Query::Create()
					->from('Usuarios')
					->where('login = "' . $login .'"'. $criterio);
			$results = $q->execute();
			
			return $results->count();
		}
	}
?>