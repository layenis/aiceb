<?php

/**
 * Obreiros
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Obreiros extends BaseObreiros
{
    
    function recuperarCampos($obreiros, $post, $action=null)
    {
        if ($action == 'editar')
            $obreiros->id = $post['id'];
        
        $obreiros->nome                    = $post['nome'];
        $obreiros->cpf                     = $post['cpf'];
        $obreiros->rg                      = $post['rg'];
        $obreiros->orgao_emissor           = $post['orgao_emissor'];
        $obreiros->data_nasc               = $post['data_nasc'];
        $obreiros->pai                     = $post['pai'];
        $obreiros->mae                     = $post['mae'];
        $obreiros->nome_esposa             = $post['nome_esposa'];
        $obreiros->data_nasc_esposa        = $post['data_nasc_esposa'];
        $obreiros->formacao_esposa         = $post['formacao_esposa'];
        $obreiros->num_filhos              = (int) $post['num_filhos'];
        $obreiros->endereco                = $post['endereco'];
        $obreiros->complemento             = $post['complemento'];
        $obreiros->bairro                  = $post['bairro'];
        $obreiros->cep                     = $post['cep'];
        $obreiros->cidade_id               = (int) $post['cidade_id'];
        $obreiros->estado_id               = (int) $post['estado_id'];
        $obreiros->telefone                = $post['telefone'];
        $obreiros->celular                 = $post['celular'];
        $obreiros->email                   = $post['email'];
        $obreiros->grau_instrucao          = $post['grau_instrucao'];
        $obreiros->curso                   = $post['curso'];
        $obreiros->local_formacao_pastoral = $post['local_formacao_pastoral'];
        $obreiros->data_formacao_pastoral  = $post['data_formacao_pastoral'];
        $obreiros->data_exame_pastoral     = $post['data_exame_pastoral'];
        $obreiros->classificacao           = $post['classificacao'];
        $obreiros->data_ordenacao          = $post['data_ordenacao'];
        $obreiros->experiencia_ministerial = $post['experiencia_ministerial'];
        $obreiros->info_adicionais         = $post['info_adicionais'];
        
        return $obreiros;
    }
    
    function validar ($obreiros, $action=null)
    {
        $erro = array();
        
        if (empty($obreiros->nome))           $erro[] = 'nome_erro'; 
        if (empty($obreiros->cpf))            $erro[] = 'cpf_erro';
        if (empty($obreiros->rg))             $erro[] = 'rg_erro';
        if (empty($obreiros->orgao_emissor))  $erro[] = 'orgao_emissor_erro';
        if (empty($obreiros->data_nasc))      $erro[] = 'data_nasc_erro';
        if (empty($obreiros->endereco))       $erro[] = 'endereco_erro';
        if (empty($obreiros->bairro))         $erro[] = 'bairro_erro';
        if (empty($obreiros->cep))            $erro[] = 'cep_erro';
        if (empty($obreiros->cidade_id))      $erro[] = 'cidade_id_erro';
        if (empty($obreiros->estado_id))      $erro[] = 'estado_id_erro';
        if (empty($obreiros->email))          $erro[] = 'email_erro';
      
        return $erro;
    }

}