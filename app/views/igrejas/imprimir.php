<?php
  
	session_start();
	
	require_once(CONTROLLERS . 'igrejasController.php');
	require_once(CONTROLLERS . 'regionaisController.php');
		
	$igrejasController = new IgrejasController();
	$igrejas = new Igrejas();
	
	$regionaisController = new RegionaisController();
	$regionais = new Regionais();
	
	if(($id = (int) $_GET['id']) != 0)
	{
		# pesquisa pelo id
		$igrejas = $igrejasController->buscaPorId($id);
		
		# pesquisa pelo id
		$regionais = $regionaisController->buscaPorId($igrejas->regional_id);
				
		if($igrejas == false)
		{
			setMensagem("Registro inv�lido");
			header('Location: ' . URL . 'igrejas/index'); 
			exit;
		}
		
		# validar alguns campos
		$igrejas->data_fundacao = formataData($igrejas->data_fundacao);
	}
	else
	{
		setMensagem("Registro inv�lido");
		header('Location: ' . URL . 'igrejas/index'); 
		exit;
	}
	
?>

<html>

<head>
  <title> Igreja
</head>
    
<body> 
<center>
        
    <table width="70%" height="300" border="2" cellpadding="5" style="border-collapse: collapse; font-family:Calibri; font-size:16px">
        <tr>
			<td colspan="6">
				<p align="center"><img src="<?=IMG_URL?>cabecalho.png" /></p>
			</td>
        </tr>
		
        <tr style="border-color: white">
           	<td align="center" border="none">
				<font color="#ac95" size="5"> Dados da <?=$igrejas->nome_fantasia?> </font><br>
			</td>			
		</tr>
		
		<tr>
			<td align="left">
				Regional: <?=$regionais->nome;?> <br>
				C�digo: <?=$igrejas->codigo;?> <br>				
				Raz�o Social: <?=$igrejas->razao_social;?> <br>
				CNPJ: <?=$igrejas->cnpj;?> <br>
				Endere�o: <?=$igrejas->endereco;?> <br>
				N�mero: <?=$igrejas->numero;?> <br>
				Complemento: <?=$igrejas->complemento;?> <br>
				Bairro: <?=$igrejas->bairro;?> <br>
				CEP: <?=$igrejas->cep;?> <br>
				Cidade: <?=$igrejas->cidade_id;?> <br>
				Estado: <?=$igrejas->estado_id;?> <br>
				Data da funda��o: <?=$igrejas->data_fundacao;?> <br>
				Hist�ria: <?=$igrejas->historia;?> <br>				
			</td>
		</tr>
        
		
	</table>
	
	<a href="javascript:window.print();">Imprimir</a>
	&nbsp;&nbsp;&nbsp;&nbsp;   
    <a href="<?= URL . 'igrejas'?>"> Voltar</a>
             
</center>
</body>
</html>

<script>
	javascript:window.print();
</script>
