<?php
	################# CONFIGURAÇÃO #####################
	define('CONTROLLER_APP', 'home');
	define('VIEW_APP', 'index');
	
	define('PASTA', 'aiceb');
	
	if($_SERVER['HTTP_HOST'] == 'localhost')
	{
		$_base = 'http://' . $_SERVER['HTTP_HOST'] . '/' . PASTA . '/';
	}
	else
	{
		$_base = 'http://' . $_SERVER['HTTP_HOST'] . '/';
	}
	
	define('URL', $_base);
	
	################# CONFIGURAÇÃO #####################	
	
	# paths	
	if (!defined('ROOT')) 
	{
		define('ROOT', '../');
	}
	
	if (!defined('WEBROOT_DIR')) 
	{
		define('WEBROOT_DIR', 'webroot');
	}
	
	define('CORE', CORE_PATH.'core'.DS);
	
	if (!defined('APP')) 
	{
		define('APP', ROOT.DS.APP_DIR.DS);
	}

	define('MODELS', APP.'models'.DS);
	
	define('CONTROLLERS', APP.'controllers'.DS);
	
	define('APPLIBS', APP.'libs'.DS);
	
	define('VIEWS', APP.'views'.DS);
	
	define('LAYOUTS', VIEWS.'layouts'.DS);
	
	if (!defined('CONFIGS')) 
	{
		define('CONFIGS', APP.'config'.DS);
	}
	
	define('CSS', WWW_ROOT.'css'.DS);
	define('JS', WWW_ROOT.'js'.DS);
	define('IMAGES', WWW_ROOT.'img'.DS);
	define('PLUGIN', WWW_ROOT.'plugins'.DS);

	if (!defined('IMG_URL')) 
	{
		define('IMG_URL',  URL . 'app/webroot/img/');
	}
	
	if (!defined('CSS_URL')) 
	{
		define('CSS_URL',  URL . 'app/webroot/css/');
	}
	
	if (!defined('JS_URL')) 
	{
		define('JS_URL', URL . 'app/webroot/js/');
	}
	
	if (!defined('PLUGIN_URL')) 
	{
		define('PLUGIN_URL', URL . 'app/webroot/plugins/');
	}
?>