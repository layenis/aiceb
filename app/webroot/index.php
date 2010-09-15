<?php
	# PHP versгo 5
	# Data: 19 de Julho de 2010
	# Desenvolvedores: Fabrнcio Souza e Layenis Sobrinho
	# Projeto: Zodiaco
	# Versгo: Бries
	
	if (!defined('DS')) 
		define('DS', DIRECTORY_SEPARATOR);

	if (!defined('ROOT')) 
		define('ROOT', dirname(dirname(dirname(__FILE__))));

	if (!defined('APP_DIR')) 
		define('APP_DIR', basename(dirname(dirname(__FILE__))));

	if (!defined('ZODIACO_CORE_INCLUDE_PATH')) 
		define('ZODIACO_CORE_INCLUDE_PATH', ROOT);

	if (!defined('WEBROOT_DIR')) 
		define('WEBROOT_DIR', basename(dirname(__FILE__)));
	
	if (!defined('WWW_ROOT')) 
		define('WWW_ROOT', dirname(__FILE__) . DS);
	
	define('APP_PATH', ROOT . DS . APP_DIR . DS);
	define('CORE_PATH', ZODIACO_CORE_INCLUDE_PATH . DS . 'core' . DS);
	

	if (!include(CORE_PATH . DS . 'bootstrap.php')) 
	{
		echo 'Arquivo de configuraзгo nгo encontrado bootstrap.php';
	}
	
	if (isset($_GET['url']) && $_GET['url'] === 'favicon.ico') 
	{
		return;
	} 
	else 
	{		
		require_once(CORE_PATH . 'dispatcher.php');
	}
?>