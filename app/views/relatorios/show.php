<?php
  
	session_start();

	$entradas = $_SESSION['entradas'];
	
	# total de registros
	$total = count($entradas);
  
?>
<html>

<head>
  <title> Relatório Financeiro
</head>
    
<body> 
<center>
        
    <table width="70%" height="300" border="2" cellpadding="5" style="border-collapse: collapse; font-family:Calibri; font-size:16px">
        <tr>
			<td colspan="6">
				<p align="center"><img src="<?=IMG_URL?>cabecalho.png" /></p>
			</td>
        </tr>
		
        <tr>
           	<td colspan="6" align="center">
				<font color="#ac95" size="5"> Relatório Financeiro de <?=$_SESSION['mes']?> de <?=$_SESSION['ano']?> </font><br>
			</td>
        </tr>

        <tr align="center" style="font-weight: bold; background:#CCCCCC;">
			<td width="10%">Código</td>
			<td width="30%">Igreja</td>
			<td width="10%">Depósito</td>
			<td width="10%">Banco</td>
			<td width="10%">Data</td>
			<td width="10%">Valor</td>
        </tr>
<?
	$valorTotal = 0;
	
	for($i=0; $i<$total; $i++)
	{
?>
		<tr align="center" onMouseOver="javascript:this.style.backgroundColor='#F8F2E4'" onMouseOut="javascript:this.style.backgroundColor=''">
			<td width="10%"><?=$entradas[$i]['Igrejas']['codigo']?></td>
			<td width="30%"><?=$entradas[$i]['Igrejas']['nome_fantasia']?></td>
			<td width="10%"><?=$entradas[$i]['numero_deposito']?></td>
			<td width="10%"><?=$entradas[$i]['nome_banco']?></td>
			<td width="10%"><?=formataData($entradas[$i]['data_entrada'])?></td>
			<td width="10%"><?=$entradas[$i]['valor']?></td>
		</tr>
<?
		$valorTotal+= $entradas[$i]['valor'];
	}
?>
		      
		<tr style="font-weight: bold; background:#CCCCCC;">
			<td height="54" colspan="5" align="right"> Valor Total (R$): </td>
			<td align="center"><?=$valorTotal?></td>
        </tr>          
	</table>
	
	<a href="javascript:window.print();">Imprimir</a>
	&nbsp;&nbsp;&nbsp;&nbsp;   
    <a href="<?= URL . 'relatorios/entradas'?>"> Voltar</a>
             
</center>
</body>
</html>
