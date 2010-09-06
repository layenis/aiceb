<?php

/**
 * Igrejas
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Igrejas extends BaseIgrejas
{
	function recuperarCampos($igrejas, $post, $action=null)
	{
		if($action == 'editar')
			$igrejas->id = $post['id'];
		
		$igrejas->regional_id = $post['regional_id'];
		$igrejas->estado_id = $post['estado_id'];
		$igrejas->cidade_id = $post['cidade_id'];
		$igrejas->codigo = $post['codigo'];
		$igrejas->nome_fantasia = $post['nome_fantasia'];
		$igrejas->razao_social = $post['razao_social'];
		$igrejas->cnpj = $post['cnpj'];
		$igrejas->historia = $post['historia'];
		$igrejas->data_fundacao = $post['data_fundacao'];
		$igrejas->endereco = $post['endereco'];
		$igrejas->numero = $post['numero'];
		$igrejas->complemento = $post['complemento'];
		$igrejas->bairro = $post['bairro'];
		$igrejas->cep = $post['cep'];
		$igrejas->status = $post['status'];
		
		return $igrejas;
	}
	
	function validar($igrejas, $action=null)
	{
		$erro = array();
		
		if(empty($igrejas->regional_id)) $erro[] = 'regional_id_erro';
		# if(empty($igrejas->estado_id)) $erro[] = 'estado_id_erro';
		# if(empty($igrejas->cidade_id)) $erro[] = 'cidade_id_erro';
		if(empty($igrejas->nome_fantasia)) $erro[] = 'nome_fantasia_erro';
		if(empty($igrejas->codigo)) $erro[] = 'codigo_erro';		
		if(empty($igrejas->razao_social)) $erro[] = 'razao_social_erro';
		if(empty($igrejas->cnpj)) $erro[] = 'cnpj_erro';
		if(empty($igrejas->historia)) $erro[] = 'historia_erro';
		if(empty($igrejas->data_fundacao)) $erro[] = 'data_fundacao_erro';
		if(empty($igrejas->endereco)) $erro[] = 'endereco_erro';
		if(empty($igrejas->numero)) $erro[] = 'numero_erro';
		if(empty($igrejas->complemento)) $erro[] = 'complemento_erro';
		if(empty($igrejas->bairro)) $erro[] = 'bairro_erro';
		if(empty($igrejas->cep)) $erro[] = 'cep_erro';
		
		return $erro;
	}
	
    public function setUp()
    {		
		$this->hasOne('Regionais', array(
                'local' => 'regional_id',
                'foreign' => 'id'
            )
        );
		
        $this->hasMany('Entradas', array(
                'local' => 'id',
                'foreign' => 'igreja_id'
            )
        );
    }
}