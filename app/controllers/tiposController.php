<?php	
	require_once(CONTROLLERS . 'controller.php');
	
	class TiposController extends Controller
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
					->from('Tipos')
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
							   'primeiro' => URL . 'tipos/index/?pg=' . $pager->getFirstPage(),
							   'anterior' => URL . 'tipos/index/?pg=' . $pager->getPreviousPage(),
							   'proximo' => URL . 'tipos/index/?pg=' . $pager->getNextPage(),
							   'ultimo' => URL . 'tipos/index/?pg=' . $pager->getLastPage());
			
			return array('tipos' => $pager->execute()->toArray(),
						 'paginacao' => $paginacao);
		}
		
		function novo()
		{
			
		}
		
		function salvar($tipos)
		{	
			try
			{
				$tipos->save();
				
				setMensagem("Registro gravado com sucesso!");
				header('Location: ' . URL . 'tipos/index'); 
				exit;
			}
			catch(Doctrine_Connection_Exception $e) 
			{
				echo 'Código: ' . $e->getPortableCode();
				echo '<br>Mensagem: ' . $e->getPortableMessage();
			}
		}
		
		function editar($tipos)
		{				
		
		}
		
		function excluir($id)
		{
			$igrejaTable = Doctrine_Core::getTable("Tipos");
			
			$igreja = $igrejaTable->find($id);
			
			if($igreja !== false) 
			{
				$igreja->delete();
			}
		}
		
		function buscaPorId($id)
		{
			$tiposTable = Doctrine::getTable("Tipos");
			$tipos = $tiposTable->find($id);
			
			return $tipos;
		}
		
		
		function permissoes($tipo_id)
		{
			session_start();
			
			$q = Doctrine_Query::Create()
					->select('t.id, t.nome, tt.permissao')
					->from('Tabelas t')
					->leftJoin('t.TabelasTipos tt WITH tt.tipo_id = ?', $tipo_id)
					->where('t.status = 1')
					->orderby('t.nome asc');
			$objeto = $q->execute();

			return $objeto->toArray();
		}
		
		function mudarPermissao($tipo_id, $tabela_id, $permissao)
		{			
			# verifica se o registro existe
			$tabelasTiposTable = Doctrine::getTable("TabelasTipos");
			$tabelas_tipos = $tabelasTiposTable->findByTipo_idAndTabela_id($tipo_id, $tabela_id);
			
			if($tabelas_tipos->count() == 0)
			{
				$tabelasTipos = new TabelasTipos();
				
				$tabelasTipos->tipo_id = $tipo_id;
				$tabelasTipos->tabela_id = $tabela_id;
				$tabelasTipos->permissao = $permissao;
				
				$tabelasTipos->save();
			}
			else
			{
				$q = Doctrine_Query::Create()
						->update('TabelasTipos')
						->set('permissao', '?', $permissao)
						->where('tipo_id = ? and tabela_id = ?', array($tipo_id, $tabela_id));
				$q->execute();
			}
		}
	}
?>
