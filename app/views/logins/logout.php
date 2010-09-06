<?php
	session_start();
	
	# limpa a sessão do usuario
	limparSessao();
	
	header('Location: /logins/index');
?>