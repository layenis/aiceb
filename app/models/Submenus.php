<?php

/**
 * Submenus
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Submenus extends BaseSubmenus
{
	function recuperarCampos($submenus, $post, $action=null)
	{
		if($action == 'editar')
			$submenus->id = (int) $post['id'];
		
		$submenus->menu_id = (int) $post['menu_id'];
		$submenus->posicao = (int) $post['posicao'];
		$submenus->nome = trim($post['nome']);
		$submenus->status = (int) $post['status'];
		
		return $submenus;
	}
	
	function validar($submenus, $action=null)
	{
		$erro = array();
		
		if(empty($submenus->menu_id)) $erro[] = 'menu_id_erro';
		if(empty($submenus->nome)) $erro[] = 'nome_erro';
		
		return $erro;
	}
}