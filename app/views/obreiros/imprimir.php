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

<html>

<head>
  <title> Obreiro
</head>
    
<body> 
<center>
        
    <table width="70%" height="300" border="2" cellpadding="5" style="border-collapse: collapse; font-family:Calibri; font-size:16px">
        <tr>
			<td colspan="0">
				<p align="center"><img src="<?=IMG_URL?>cabecalho.png" /></p>
			</td>
        </tr>
		
        <tr style="border-color: white">
           	<td align="center" border="none">
				<font color="#ac95" size="5"> Cadastro de Obreiro </font><br>
			</td>			
		</tr>
		
		<!------------------   Dados Pessoais ---------------------->
		<tr>
			<td>Nome:<?=$obreiros->nome?></td>
		</tr>
		
		<tr>
			<td>CPF: <?=$obreiros->cpf?></td>
		</tr>	
		
		<tr>
			<td>RG: <?=$obreiros->rg?></td>
		</tr>	
		
		<tr>
			<td>Órgão Emissor: <?=$obreiros->orgao_emissor?></td>
		</tr>
		
		<tr>
			<td>Data de nascimento: <?=$obreiros->data_nasc?></td>
		</tr>
		
		<tr>
			<td>Nome do pai: <?=$obreiros->pai?></td>
		</tr>
		
		<tr>
			<td>Nome da mãe: <?=$obreiros->mae?></td>
		</tr>
		
		
		<!------------------   Dados Conjugais ---------------------->
		<tr>
			<td>Nome da esposa:<?=$obreiros->nome_esposa?></td>
		</tr>
		
		<tr>
			<td>Data de nascimento da esposa: <?=$obreiros->data_nasc_esposa?></td>
		</tr>
		
		<tr>
			<td>Formação da esposa:<?=$obreiros->formacao_esposa?></td>
		</tr>
		
		<tr>
			<td>Número de filhos: <?=$obreiros->num_filhos?></td>
		</tr>
		
		
		<!------------------   Dados Residenciais ---------------------->
		<tr>
			<td>Endereço: <?=$obreiros->endereco?></td>
		</tr>
		
		<tr>
			<td>Complemento: <?=$obreiros->complemento?></td>
		</tr>
		
		<tr>
			<td>Bairro: <?=$obreiros->bairro?></td>
		</tr>
		
		<tr>
			<td>Cep: <?=$obreiros->cep?></td>
		</tr>
		
		<tr>
			<td>Cidade: <?=$obreiros->cidade_id?></td>
		</tr>
		
		<tr>
			<td>Estado: <?=$obreiros->estado_id?></td>
		</tr>
		
		<tr>
			<td>Telefone: <?=$obreiros->telefone?></td>
		</tr>
		
		<tr>
			<td>Celular: <?=$obreiros->celular?></td>
		</tr>
		
		<tr>
			
			<td>E-mail: <?=$obreiros->email?></td>
		</tr>
		
		
		<!------------------   Formação ---------------------->
		<tr>			
			<td>Grau de instrução: <?=$obreiros->grau_instrucao?></td>
		</tr>
		
		<tr>			
			<td>Curso: <?=$obreiros->curso?></td>
		</tr>
		
		<tr>			
			<td>Local de formação pastoral: <?=$obreiros->local_formacao_pastoral?></td>
		</tr>
		
		<tr>			
			<td>Data da formação pastoral: <?=$obreiros->data_formacao_pastoral?></td>
		</tr>
		
		<tr>			
			<td>Data do exame pastoral: <?=$obreiros->data_exame_pastoral?></td>
		</tr>
		
		<tr>			
			<td>Classificação: <?=$obreiros->classificacao?></td>
		</tr>
		
		<tr>
			<td>Data da ordenacao: <?=$obreiros->data_ordenacao?></td>
		</tr>
		
		<tr>			
			<td>Experiência ministerial: <?=$obreiros->experiencia_ministerial?></td>
		</tr>
		
		<tr>			
			<td>Informações adicionais: <?=$obreiros->info_adicionais?></td>
		</tr>
	
	</table>
	
	<a href="javascript:window.print();">Imprimir</a>
	&nbsp;&nbsp;&nbsp;&nbsp;   
    <a href="<?= URL . 'obreiros'?>"> Voltar</a>
             
</center>
</body>
</html>

<script>
	javascript:window.print();
</script>
