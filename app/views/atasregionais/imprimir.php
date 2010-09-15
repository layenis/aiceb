<?php
  
	session_start();
	
	require_once(CONTROLLERS . 'atasregionaisController.php');
	require_once(CONTROLLERS . 'regionaisController.php');
	
	$atasregionaisController = new AtasRegionaisController();
	$atasregionais = new AtasRegionais();
	
	$regionaisController = new RegionaisController();
	$regionais = new Regionais();
	
	if(($id = (int) $_GET['id']) != 0)
	{
		# pesquisa pelo id
		$atasregionais = $atasregionaisController->buscaPorId($id);
		
		# pesquisa a regional pelo id
		$regionais = $regionaisController->buscaPorId($atasregionais->regional_id);
				
		if($atasregionais == false)
		{
			setMensagem("Registro inválido");
			header('Location: ' . URL . 'atasregionais/index'); 
			exit;
		}
		
		# validar alguns campos
		$atasregionais->data_ata = formataData($atasregionais->data_ata);
	}
	else
	{
		setMensagem("Registro inválido");
		header('Location: ' . URL . 'atasregionais/index'); 
		exit;
	}
	
?>

<html>

<head>
  <title> Ata
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
				<font color="#ac95" size="5"> Ata - <?=$regionais->nome?> </font><br>
			</td>			
		</tr>
		
		<tr>
			<td align="left">
			Número: <?=$atasregionais->numero;?> <br>
			Data: <?=$atasregionais->data_ata;?> <br>
			Título: <?=$atasregionais->titulo;?> <br>
			Descrição: <?=$atasregionais->descricao;?> <br>
			</td>
		</tr>
        
		
	</table>
	
	<a href="javascript:window.print();">Imprimir</a>
	&nbsp;&nbsp;&nbsp;&nbsp;   
    <a href="<?= URL . 'atasregionais'?>"> Voltar</a>
             
</center>
</body>
</html>

<script>
	javascript:window.print();
</script>
