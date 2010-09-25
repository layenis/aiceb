<?    
	session_start();
	
    require_once(CONTROLLERS . 'relatoriosController.php');
	
  	$relatoriosController = new RelatoriosController();
  	
	$entradas = new Entradas();
    
    if(isset($_POST['action']))
    {
        $entradas = $relatoriosController->buscaTodasEntradas($_POST['mes'], $_POST['ano']);
		
		$_SESSION['entradas'] = $entradas;
		$_SESSION['mes'] = $_POST['mes'];
		$_SESSION['ano'] = $_POST['ano'];
		
		header('Location: ' . URL . 'relatorios/show');
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
	
</head>

<body>
	
    <div id="content">
		
		<? include(LAYOUTS . 'topo.php'); ?>
        
        <div id="meio">
	  
    <? include(VIEWS . 'relatorios' . DS . 'sub-menu.php'); ?>
        
	<div class="meio-conteudo-borda">
		<div class="meio-conteudo">
			<div class="conteudo-rg">
				<form action="" method="post" name="form-salvar">  
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela-vs">
					<tr class="dados-vs">
						<td class="label-vs">Mês do relatório:&nbsp;</td>
		
						<td>
						<select name="mes" id="mes">
							<option>Janeiro</option>
							<option>Fevereiro</option>
							<option>Março</option>
							<option>Abril</option>
							<option>Maio</option>
							<option>Junho</option>
							<option>Julho</option>
							<option>Agosto</option>
							<option>Setembro</option>
							<option>Outubro</option>
							<option>Novembro</option>
							<option>Dezembro</option>
						</select>
						</td>
					</tr>
					
					<tr class="dados-vs">
						<td class="label-vs">Ano:&nbsp;</td>
		
						<td>
						<select name="ano" id="ano">
						<?  for ($i=2010; $i<=2020; $i++ ) {?>
							<option><?=$i?></option>
						<?  }  ?>	
						</select>
						</td>
					</tr>
					
					<tr class="dados-vs">
						<td colspan="2" align="center">
							<input type="submit" name="enviar-filtro" value="Enviar" class="botao-filtro" />
							<input type="button" name="enviar-filtro" value="Voltar" class="botao-filtro" />
						</td>
					</tr>

					<input type="hidden" name="action" value="salvar" />
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