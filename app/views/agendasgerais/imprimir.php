<?php
  
	session_start();
	
	require_once(CONTROLLERS . 'agendasgeraisController.php');
		
	$agendasgeraisController = new AgendasGeraisController();
	$agendasgerais = new AgendasGerais();
	
	if(($id = (int) $_GET['id']) != 0)
	{
		# pesquisa pelo id
		$agendasgerais = $agendasgeraisController->buscaPorId($id);
				
		if($agendasgerais == false)
		{
			setMensagem("Registro inválido");
			header('Location: ' . URL . 'agendasgerais/index'); 
			exit;
		}
		
		# validar alguns campos
		$agendasgerais->data_agenda = formataData($agendasgerais->data_agenda);
	}
	else
	{
		setMensagem("Registro inválido");
		header('Location: ' . URL . 'agendasgerais/index'); 
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
				<font color="#ac95" size="5"> Agenda do diretor geral </font><br>
			</td>			
		</tr>
		
		<tr>
			<td align="left">
			Data: <?=$agendasgerais->data_agenda;?> <br>
			Local: <?=$agendasgerais->local;?> <br>
			Título: <?=$agendasgerais->titulo;?> <br>
			Descrição: <?=$agendasgerais->descricao;?> <br>
			</td>
		</tr>
        
		
	</table>
	
	<a href="javascript:window.print();">Imprimir</a>
	&nbsp;&nbsp;&nbsp;&nbsp;   
    <a href="<?= URL . 'agendasgerais'?>"> Voltar</a>
             
</center>
</body>
</html>

<script>
	javascript:window.print();
</script>
