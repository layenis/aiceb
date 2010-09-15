<?
	session_start();
	
	require_once(CONTROLLERS . 'igrejasController.php');
	require_once(CONTROLLERS . 'regionaisController.php');
		
	$igrejasController = new IgrejasController();
	$igrejas = new Igrejas();
	
	$regionaisController = new RegionaisController();
	$regionais = new Regionais();
	
	if(isset($_POST['action']))
	{
		if(($id = (int) $_GET['id']) != 0)
		{
			# pesquisa pelo id
			$igrejas = $igrejasController->buscaPorId($id);
			
			# pesquisa pelo id o nome da regional
			$regionais = $regionaisController->buscaPorId($igrejas->regional_id);
					
			# validar alguns campos
			$igrejas->data_fundacao = formataData($igrejas->data_fundacao);
			
			if($igrejas == false)
			{
				setMensagem("Registro inválido");
				header('Location: ' . URL . 'igrejas/index'); 
				exit;
			}		
			
			#### Montando o e-mail a ser enviado
			$email = $_POST['email'];
			
			# CABEÇALHO DO E-MAIL
			$headers = "MIME-Version: 1.0\n";
			$headers .= "Content-type: text/HTML; charset=iso-8859-1\n";
			$headers .= "From: ".$email."\n";

			# MENSAGEM PERSONALIZADA
			$mensagem = '
			<html>
				<body>
					<center><font color="#000000" size="3"> <b> Dados da Igreja ' . $igrejas->nome_fantasia . '</b></font></center>
					<br>
					<table>
						<tr>
							<td><b> Regional: </b></td>
							<td>' . $regionais->nome . '</td>
						</tr>
						<tr>
							<td><b> Código: </b></td>
							<td>' . $igrejas->codigo . '</td>
						</tr>
						<tr>
							<td><b> Razão Social: </b></td>
							<td>' . $igrejas->razao_social . '</td>
						</tr>
						<tr>
							<td><b> CNPJ: </b></td>
							<td>' . $igrejas->cnpj . '</td>
						</tr>
						<tr>
							<td><b> Endereço: </b></td>
							<td>' . $igrejas->endereco . '</td>
						</tr>
						<tr>
							<td><b> Número: </b></td>
							<td>' . $igrejas->numero . '</td>
						</tr>
						<tr>
							<td><b> Complemento: </b></td>
							<td>' . $igrejas->complemento . '</td>
						</tr>
						<tr>
							<td><b> Bairro: </b></td>
							<td>' . $igrejas->bairro . '</td>
						</tr>
						<tr>
							<td><b> CEP: </b></td>
							<td>' . $igrejas->cep . '</td>
						</tr>
						<tr>
							<td><b> Cidade: </b></td>
							<td>' . $igrejas->cidade_id . '</td>
						</tr>
						<tr>
							<td><b> Estado: </b></td>
							<td>' . $igrejas->estado_id . '</td>
						</tr>
						<tr>
							<td><b> Data da fundação: </b></td>
							<td>' . $igrejas->data_fundacao . '</td>
						</tr>
						<tr>
							<td><b> História: </b></td>
							<td>' . $igrejas->historia . '</td>
						</tr>
					</table>
				</body>
			</html>';
						
			if(mail($email, "Dados da " . $igrejas->nome_fantasia, $mensagem, $headers))
			{
				setMensagem('E-mail enviado com sucesso!');			
			}
			else
			{
				setMensagem('Não foi possível enviar seu email!');
			}
			
			header('Location: ' . URL . 'igrejas/index'); 
			exit;
		}
		else
		{
			setMensagem("Registro inválido");
			header('Location: ' . URL . 'igrejas/index'); 
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
			
			<? include(VIEWS . 'igrejas' . DS . 'sub-menu.php'); ?>
			
			<div class="meio-conteudo-borda">
				<div class="meio-conteudo">
	
					<div class="conteudo-rg">
						<form name="" method="post" action="">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela-vs">
								
								<tr class="marcador-vs">
									<td colspan="2">Enviar dados da igreja por e-mail</td>
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
								
								** Para enviar para mais de um destinatário, separe os e-mails por ponto-e-vírgula (;)
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

