<?php
	session_start();
	
	require_once(CONTROLLERS . 'obreirosController.php');
	
	$obreirosController = new ObreirosController();
	$obreiros = new Obreiros();
	
	if(($id = (int) $_GET['id']) != 0)
	{
		# pesquisa pelo id
		$obreiros = $obreirosController->buscaPorId($id);
		
		if($obreiros == false)
		{
			setMensagem("Registro inválido");
			header('Location: ' . URL . 'obreiros/index'); 
			exit;
		}
		
		# validar alguns campos
		$obreiros->data_nasc              = formataData($obreiros->data_nasc);
		$obreiros->data_nasc_esposa       = formataData($obreiros->data_nasc_esposa);
		$obreiros->data_formacao_pastoral = formataData($obreiros->data_formacao_pastoral);
		$obreiros->data_exame_pastoral    = formataData($obreiros->data_exame_pastoral);
		$obreiros->data_ordenacao         = formataData($obreiros->data_ordenacao);
	}
	else
	{
		setMensagem("Registro inválido");
		header('Location: ' . URL . 'obreiros/index'); 
		exit;
	}
	
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
	
	<script type="text/javascript" src="<?=JS_URL?>validacoes.js"></script>
</head>

<body>
	
    <div id="content">
		
		<? include(LAYOUTS . 'topo.php'); ?>
        
        <div id="meio">
			
			<? include(VIEWS . 'obreiros' . DS . 'sub-menu.php'); ?>
			
			<div class="meio-conteudo-borda">
				<div class="meio-conteudo">

					<div class="print-vs">
						<span><a href="<?=URL . 'obreiros/imprimir/?id=' . $id?>">Imprimir</a></span>
						<span>Enviar por Email</span>
					</div>
					
					<div class="conteudo-rg">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela-vs">
							
							<tr class="marcador-vs">
								<td colspan="2">Dados do obreiro</td>
							</tr>
							
							<!------------------   Dados Pessoais ---------------------->
							<tr class="dados-vs">
								<td class="label-vs">Nome:&nbsp;</td>
								<td><?=$obreiros->nome?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">CPF:&nbsp;</td>
								<td><?=$obreiros->cpf?></td>
							</tr>	
							
							<tr class="dados-vs">
								<td class="label-vs">rg:&nbsp;</td>
								<td><?=$obreiros->rg?></td>
							</tr>	
							
							<tr class="dados-vs">
								<td class="label-vs">Órgão Emissor:&nbsp;</td>
								<td><?=$obreiros->orgao_emissor?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Data de nascimento:&nbsp;</td>
								<td><?=$obreiros->data_nasc?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Nome do pai:&nbsp;</td>
								<td><?=$obreiros->pai?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Nome da mãe:&nbsp;</td>
								<td><?=$obreiros->mae?></td>
							</tr>
							
							
							<!------------------   Dados Conjugais ---------------------->
							<tr class="dados-vs">
								<td class="label-vs">Nome da esposa:&nbsp;</td>
								<td><?=$obreiros->nome_esposa?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Data de nascimento da esposa:&nbsp;</td>
								<td><?=$obreiros->data_nasc_esposa?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Formação da esposa:&nbsp;</td>
								<td><?=$obreiros->formacao_esposa?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Número de filhos:&nbsp;</td>
								<td><?=$obreiros->num_filhos?></td>
							</tr>
							
							
							<!------------------   Dados Residenciais ---------------------->
							<tr class="dados-vs">
								<td class="label-vs">Endereço:&nbsp;</td>
								<td><?=$obreiros->endereco?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Complemento:&nbsp;</td>
								<td><?=$obreiros->complemento?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Bairro:&nbsp;</td>
								<td><?=$obreiros->bairro?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Cep:&nbsp;</td>
								<td><?=$obreiros->cep?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Cidade:&nbsp;</td>
								<td><?=$obreiros->cidade_id?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Estado:&nbsp;</td>
								<td><?=$obreiros->estado_id?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Telefone:&nbsp;</td>
								<td><?=$obreiros->telefone?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Celular:&nbsp;</td>
								<td><?=$obreiros->celular?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">E-mail:&nbsp;</td>
								<td><?=$obreiros->email?></td>
							</tr>
							
							
							<!------------------   Formação ---------------------->
							<tr class="dados-vs">
								<td class="label-vs">Grau de instrução:&nbsp;</td>
								<td><?=$obreiros->grau_instrucao?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Curso:&nbsp;</td>
								<td><?=$obreiros->curso?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Local de formação pastoral:&nbsp;</td>
								<td><?=$obreiros->local_formacao_pastoral?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Data da formação pastoral:&nbsp;</td>
								<td><?=$obreiros->data_formacao_pastoral?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Data do exame pastoral:&nbsp;</td>
								<td><?=$obreiros->data_exame_pastoral?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Classificação:&nbsp;</td>
								<td><?=$obreiros->classificacao?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Data da ordenacao:&nbsp;</td>
								<td><?=$obreiros->data_ordenacao?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Experiência ministerial:&nbsp;</td>
								<td><?=$obreiros->experiencia_ministerial?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Informações adicionais:&nbsp;</td>
								<td><?=$obreiros->info_adicionais?></td>
							</tr>
														
						</table>
					</div>
					
				</div>
			</div>
        </div>
        
		<? include(LAYOUTS . 'rodape.php'); ?>
		
    </div>
    	
</body>
</html>