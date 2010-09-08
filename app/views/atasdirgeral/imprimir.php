<?php
  
	session_start();
	
	require_once(CONTROLLERS . 'atasdirgeralController.php');
		
	$atasdirgeralController = new AtasDirGeralController();
	$atasdirgeral = new AtasDirgeral();
	
	if(($id = (int) $_GET['id']) != 0)
	{
		# pesquisa pelo id
		$atasdirgeral = $atasdirgeralController->buscaPorId($id);
				
		if($atasdirgeral == false)
		{
			setMensagem("Registro inválido");
			header('Location: ' . URL . 'atasdirgeral/index'); 
			exit;
		}
		
		# validar alguns campos
		$atasdirgeral->data_ata = formataData($atasdirgeral->data_ata);
	}
	else
	{
		setMensagem("Registro inválido");
		header('Location: ' . URL . 'atasdirgeral/index'); 
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
				<font color="#ac95" size="5"> Ata da diretoria geral </font><br>
			</td>			
		</tr>
		
		<tr>
			<td align="left">
			Número: <?=$atasdirgeral->numero;?> <br>
			Data: <?=$atasdirgeral->data_ata;?> <br>
			Título: <?=$atasdirgeral->titulo;?> <br>
			Descrição: <?=$atasdirgeral->descricao;?> <br>
			</td>
		</tr>
        
		
	</table>
	
	<a href="javascript:window.print();">Imprimir</a>
	&nbsp;&nbsp;&nbsp;&nbsp;   
    <a href="<?= URL . 'atasdirgeral'?>"> Voltar</a>
             
</center>
</body>
</html>

<script>
	javascript:window.print();
</script>
