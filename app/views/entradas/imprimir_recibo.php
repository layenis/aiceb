<?php
  
	session_start();
	
	require_once(CONTROLLERS . 'entradasController.php');
	require_once(CONTROLLERS . 'igrejasController.php');
	
	$entradasController = new EntradasController();
	$entradas = new Entradas();
	
	$igrejasController = new IgrejasController();
	$igrejas = new Igrejas();
	
	if(($id = (int) $_GET['id']) != 0)
	{
		# pesquisa pelo id
		$entradas = $entradasController->buscaPorId($id);
		
		# pesquisa a regional pelo id
		$igrejas = $igrejasController->buscaPorId($entradas->igreja_id);
				
		if($entradas == false)
		{
			setMensagem("Registro inválido");
			header('Location: ' . URL . 'entradas/index'); 
			exit;
		}
		
		# validar alguns campos
		$entradas->data_entrada = formataData($entradas->data_entrada);
	}
	else
	{
		setMensagem("Registro inválido");
		header('Location: ' . URL . 'entradas/index'); 
		exit;
	}
	
?>

<html>

<head>
  <title> Recibo
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
				<font color="#ac95" size="5"> Impressão de recibo </font><br>
			</td>			
		</tr>
		
		<tr>
			<td align="left">
				Recibo R$<?=$entradas->valor?> <br>
				Recebemos de <?=$igrejas->nome_fantasia?> <br> 
				a importância de <?=extenso($entradas->valor)?> <br>
				referente ao mês de <?=$entradas->mes_deposito?> <br>
				
				<?=$igrejas->cidade_id . '-' . $igrejas->estado_id . ', ' . $entradas->data_entrada?>
			</td>
		</tr>
        
		
	</table>
	
	<a href="javascript:window.print();">Imprimir</a>
	&nbsp;&nbsp;&nbsp;&nbsp;   
    <a href="<?= URL . 'entradas'?>"> Voltar</a>
             
</center>
</body>
</html>

<script>
	javascript:window.print();
</script>
