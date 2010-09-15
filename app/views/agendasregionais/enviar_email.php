<?
	session_start();
	
	require_once(CONTROLLERS . 'agendasregionaisController.php');
	require_once(CONTROLLERS . 'regionaisController.php');
		
	$agendasregionaisController = new agendasRegionaisController();
	$agendasregionais = new AgendasRegionais();
	
	$regionaisController = new RegionaisController();
	$regionais = new Regionais();
	
	if(isset($_POST['action']))
	{
		if(($id = (int) $_GET['id']) != 0)
		{
			# pesquisa pelo id
			$agendasregionais = $agendasregionaisController->buscaPorId($id);
			
			# pesquisa a regional pelo id
			$regionais = $regionaisController->buscaPorId($agendasregionais->regional_id);
					
			# validar alguns campos
			$agendasregionais->data_agenda = formataData($agendasregionais->data_agenda);
			
			if($agendasregionais == false)
			{
				setMensagem("Registro inv�lido");
				header('Location: ' . URL . 'agendasregionais/index'); 
				exit;
			}		
			
			#### Montando o e-mail a ser enviado
			$email = $_POST['email'];

			# CABE�ALHO DO E-MAIL
			$headers = "MIME-Version: 1.0\n";
			$headers .= "Content-type: text/HTML; charset=iso-8859-1\n";
			$headers .= "From: ".$email."\n";

			# MENSAGEM PERSONALIZADA
			$mensagem = '
			<html>
				<body>
					<center><font color="#000000" size="3"> <b> Detalhes da Agenda da ' . $regionais->nome . '</b></font></center>
					<table>
						<tr>
							<td><b> Data: </b></td>
							<td>' . $agendasregionais->data_agenda . '</td>
						</tr>
						<tr>
							<td><b> Local: </b></td>
							<td>' . $agendasregionais->local . '</td>
						</tr>
						<tr>
							<td><b> T�tulo: </b></td>
							<td>' . $agendasregionais->titulo . '</td>
						</tr>
						<tr>
							<td><b> Descri��o: </b></td>
							<td>' . $agendasregionais->descricao . '</td>
						</tr>
					</table>
				</body>
			</html>';
						
			if(mail($email, "Agenda da diretoria regional de " . $regionais->nome, $mensagem, $headers))
			{
				setMensagem('E-mail enviado com sucesso!');			
			}
			else
			{
				setMensagem('N�o foi poss�vel enviar seu email!');
			}

			header('Location: ' . URL . 'agendasregionais/index'); 
			exit;
		}
		else
		{
			setMensagem("Registro inv�lido");
			header('Location: ' . URL . 'agendasregionais/index'); 
			exit;
		}	
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
			
			<? include(VIEWS . 'agendasregionais' . DS . 'sub-menu.php'); ?>
			
			<div class="meio-conteudo-borda">
				<div class="meio-conteudo">
	
					<div class="conteudo-rg">
						<form name="" method="post" action="">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela-vs">
								
								<tr class="marcador-vs">
									<td colspan="2">Enviar agenda do presidente por e-mail</td>
								</tr>
								
								<tr class="dados-vs">
									<td class="label-vs"><br>Digite o e-mail:&nbsp;</td>
									<td><br><input class="text-edit" type="text" name="email" id="email" size="80" maxlength="100" />**</td>
								</tr>
								
								<tr class="dados-vs">
									<td colspan="2" align="center">
										<input type="submit" name="enviar-filtro" value="Enviar" class="botao-filtro" />
										<input type="button" name="enviar-filtro" value="Voltar" class="botao-filtro" />
									</td>
								</tr>
								
								<input type="hidden" name="action" value="salvar" />
								
								** Para enviar para mais de um destinat�rio, separe os e-mails por ponto-e-v�rgula (;)
								<br>
								Ex.: joao@gmail.com; pedro@gmail.com
												
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

