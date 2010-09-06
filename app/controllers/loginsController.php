<?php	
	require_once(CONTROLLERS . 'controller.php');
	
	class LoginsController extends Controller
	{
		function __construct()
		{
			
		}
		
		function index()
		{

		}
		
		function logout()
		{
			
		}
		
		function logar($p_login, $p_senha)
		{
			$p_senha = geraSenhaAdmin($p_senha);
			
			$q = Doctrine_Query::Create()
					->from('Usuarios')
					->where('login = "'.$p_login.'" and senha = "'.$p_senha.'"');
			return $q->execute();
		}
		
		function expirou()
		{
			
		}
		
		function atualizarDados($p_id)
		{
			$q = Doctrine_Query::Create()
					->update('Usuarios')
					->set('acessos', 'acessos + 1')
					->set('ultimo_acesso', 'now()')
					->where('id = ?', $p_id);
			$q->execute();
		}
	}
?>