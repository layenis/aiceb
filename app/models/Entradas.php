<?php

/**
 * Entradas
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Entradas extends BaseEntradas
{
    function recuperarCampos($entradas, $post, $action=null)
    {
        if ($action == 'editar')
            $entradas->id = $post['id'];

		$entradas->igreja_id       = $post['igreja_id'];
		$entradas->mes_deposito    = $post['mes_deposito'];
		$entradas->data_entrada    = formataDataBanco($post['data_entrada']);
        $entradas->nome_banco      = $post['nome_banco'];
		$entradas->numero_deposito = $post['numero_deposito'];
        $entradas->valor           = $post['valor'];
        
        return $entradas;
    }
    
    function validar ($entradas, $action=null)
    {
        $erro = array();
        
        if (empty($entradas->igreja_id))  	 $erro[] = 'igreja_id_erro'; 
		if (empty($entradas->mes_deposito))  $erro[] = 'mes_deposito_erro'; 
		if (empty($entradas->data_entrada))  $erro[] = 'data_entrada_erro'; 
        if (empty($entradas->nome_banco))    $erro[] = 'nome_banco_erro';
        if (empty($entradas->valor))         $erro[] = 'valor_erro';
		if (!preg_match('/^\d{4}\-\d{1,2}\-\d{1,2}$/', $entradas->data_entrada)) 
		{
			$erro[] = 'data_entrada_erro';
		}
		else
		{		
			list ($de_ano, $de_mes, $de_dia) = explode('-', $entradas->data_entrada);
			if (!checkdate($de_mes, $de_dia, $de_ano))
			{
				$erro[] = 'data_entrada_erro';
			}
		}
		
        return $erro;
    }

    public function setUp()
    {		
		$this->hasOne('Igrejas', array(
                'local' => 'igreja_id',
                'foreign' => 'id'
            )
        );
    }
}