<?php
	session_start();
	
	# limpa a sess�o do usuario
	limparSessao();
	
	header('Location: /logins/index');
?>