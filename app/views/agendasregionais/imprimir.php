<?php
  
	session_start();
	
	require_once(CONTROLLERS . 'agendasregionaisController.php');
	require_once(CONTROLLERS . 'regionaisController.php');
	
	$agendasregionaisController = new AgendasRegionaisController();
	$agendasregionais = new AgendasRegionais();
	
	$regionaisController = new RegionaisController();
	$regionais = new Regionais();
	
	if(($id = (int) $_GET['id']) != 0)
	{
		# pesquisa pelo id
		$agendasregionais = $agendasregionaisController->buscaPorId($id);
		
		# pesquisa a regional pelo id
		$regionais = $regionaisController->buscaPorId($agendasregionais->regional_id);
				
		if($agendasregionais == false)
		{
			setMensagem("Registro inválido");
			header('Location: ' . URL . 'agendasregionais/index'); 
			exit;
		}
		
		# validar alguns campos
		$agendasregionais->data_agenda = formataData($agendasregionais->data_agenda);
	}
	else
	{
		setMensagem("Registro inválido");
		header('Location: ' . URL . 'agendasregionais/index'); 
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
				<font color="#ac95" size="5"> Agenda do presidente - <?=$regionais->nome?> </font><br>
			</td>			
		</tr>
		
		<tr>
			<td align="left">
			Data: <?=$agendasregionais->data_agenda;?> <br>
			Local: <?=$agendasregionais->local;?> <br>
			Título: <?=$agendasregionais->titulo;?> <br>
			Descrição: <?=$agendasregionais->descricao;?> <br>
			</td>
		</tr>
        
		
	</table>
	
	<a href="javascript:window.print();">Imprimir</a>
	&nbsp;&nbsp;&nbsp;&nbsp;   
    <a href="<?= URL . 'agendasregionais'?>"> Voltar</a>
             
</center>
</body>
</html>

<script>
	javascript:window.print();
</script>
