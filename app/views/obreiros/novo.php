<?php

  session_start();
  
	require_once(CONTROLLERS . 'obreirosController.php');
	
	$obreirosController = new ObreirosController();
	$obreiros = new Obreiros();	
	
	#inicializar erro
	$erro = array();
	
	if(isset($_POST['action']))
	{
      # recuperar os campos
      $obreiros = $obreiros->recuperarCampos($obreiros, $_POST, 'novo');
      
      #validacao 
      $erro = $obreiros->validar($obreiros);
      
      if (count($erro) == 0)
      {
          #validar alguns campos 
          $obreiros->data_nasc              = formataDataBanco($obreiros->data_nasc);
          $obreiros->data_nasc_esposa       = formataDataBanco($obreiros->data_nasc_esposa);
          $obreiros->data_formacao_pastoral = formataDataBanco($obreiros->data_formacao_pastoral);
          $obreiros->data_exame_pastoral    = formataDataBanco($obreiros->data_exame_pastoral);
          $obreiros->data_ordenacao         = formataDataBanco($obreiros->data_ordenacao);
                              
          $obreiros->created_at = date('Y-m-d H:i:s');
          $obreiros->status = 1;
          
          $obreirosController->salvar($obreiros);
      }  
      else
      {
			# mensagem de erro
			setMensagem('Todos os campos em destaque devem ser digitados corretamente');
      }    
	}
	
	# ativar a aba
	$actionInserir = 'active';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Sistema Administrativo - AICEB</title>
    
	<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>style.css" />
	<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>superfish.css" media="screen">
	
	<script type="text/javascript" src="<?=JS_URL?>jquery-1.2.6.min.js"></script>
	
	<script type="text/javascript" src="<?=JS_URL?>core.js"></script>
	
	<script type="text/javascript" src="<?=JS_URL?>hoverIntent.js"></script>
	<script type="text/javascript" src="<?=JS_URL?>superfish.js"></script>
	<script src="<?=JS_URL?>jquery.maskedinput-1.2.2.min.js" type="text/javascript"></script>
	
</head>

<script>

jQuery(function($)
{
   $("#cep").mask("99999-999");
   $("#cpf").mask("999.999.999-99");
   $("#data_nasc").mask("99/99/9999");
   $("#data_nasc_esposa").mask("99/99/9999");
   $("#telefone").mask("(99)9999-9999");
   $("#celular").mask("(99)9999-9999");
   $("#data_formacao_pastoral").mask("99/99/9999");
   $("#data_exame_pastoral").mask("99/99/9999");
   $("#data_ordenacao").mask("99/99/9999");
});

$(document).ready(function()
{	
	$('#nome').limit('100', '#count-nome');
	$('#rg').limit('10', '#count-rg');
	$('#orgao_emissor').limit('10', '#count-orgao_emissor');
	$('#pai').limit('100', '#count-pai');
	$('#mae').limit('100', '#count-mae');
	$('#nome_esposa').limit('100', '#count-nome_esposa');
	$('#formacao_esposa').limit('50', '#count-formacao_esposa');
	$('#num_filhos').limit('2', '#count-num_filhos');
	$('#endereco').limit('100', '#count-endereco');
	$('#complemento').limit('40', '#count-complemento');
	$('#bairro').limit('40', '#count-bairro');
	$('#email').limit('40', '#count-email');
	$('#grau_instrucao').limit('40', '#count-grau_instrucao');
	$('#curso').limit('40', '#count-curso');
	$('#local_formacao_pastoral').limit('40', '#count-local_formacao_pastoral');
	$('#experiencia_ministerial').limit('65535', '#count-experiencia_ministerial');
	$('#info_adicionais').limit('65535', '#count-info_adicionais');
	
});

</script>

<body>
	
    <div id="content">
		
		<? include(LAYOUTS . 'topo.php'); ?>
        
        <div id="meio">
	  
    <? include(VIEWS . 'obreiros' . DS . 'sub-menu.php'); ?>
        
	<div class="meio-conteudo-borda">
				<div class="meio-conteudo">
					
					<?
						$_mensagem = getMensagem();
						if(!empty($_mensagem))
						{
					?>
					<div class="mensagem-sistema erro-s">
						<span><?=$_mensagem?></span>
					</div>
					<?
						}
					?>
					
					<div class="conteudo-rg">
						<form name="" method="post" action="">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela-vs">
							
								<? include('z-campos.php'); ?>		
								
							</table>
						</form>
					</div>
					
				</div>
			</div>
        </div>
        
		<? include(LAYOUTS . 'rodape.php'); ?>
		
    </div>
    	
</body>
</html>
