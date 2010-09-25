<?
	session_start();
	
	require_once(CONTROLLERS . 'igrejasController.php');
	require_once(CONTROLLERS . 'regionaisController.php');
		
	$igrejasController = new IgrejasController();
	$igrejas = new Igrejas();
	
	if(($id = (int) $_GET['id']) != 0)
	{
		# pesquisa pelo id
		$igrejas = $igrejasController->buscaPorId($id);
		
		if($igrejas == false)
		{
			setMensagem("Registro inválido");
			header('Location: ' . URL . 'igrejas/index'); 
			exit;
		}
		
		# validar alguns campos
		$igrejas->data_fundacao = formataData($igrejas->data_fundacao);
	}
	else
	{
		setMensagem("Registro inválido");
		header('Location: ' . URL . 'igrejas/index'); 
		exit;
	}

	if(post('action') == 'enviar_email')
	{	
		$email = post('email');
		
		if(!empty($email))
		{
			# trata para enviar para varios emails
			$email = str_replace(',', ';', $email);
			
			$regional = select('Regionais', 'nome', $igrejas->regional_id);
			
			# CABEÇALHO DO E-MAIL
			$headers  = "MIME-Version: 1.0\n";
			$headers .= "Content-type: text/HTML; charset=iso-8859-1\n";
			$headers .= "From: Fabrício Souza <compifab@hotmail.com>\n";

			# MENSAGEM PERSONALIZADA
			$mensagem = '
			<html>
				<body>
					<center><font color="#000000" size="3"> <b> Dados da Igreja ' . $igrejas->nome_fantasia . '</b></font></center>
					<br>
					<table>
						<tr>
							<td><b> Regional: </b></td>
							<td>' . $regional . '</td>
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
							<td>' . $igrejas->cidade . '</td>
						</tr>
						<tr>
							<td><b> Estado: </b></td>
							<td>' . $igrejas->estado . '</td>
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
			
			header('Location: ' . URL . 'igrejas/index'); exit;
		}	
	}
	
	# obter todos os emails cadastrados para sugestão
	$emails_obreiros = new Obreiros();
	$q = Doctrine_Query::Create()
			->select('nome, email')
			->from('Obreiros')
			->orderBy('nome asc');
	$emails_obreiros = $q->execute();	
	
	$array_emails = '[';
	foreach($emails_obreiros as $email_obreiro)
	{		
		$array_emails .= "'".$email_obreiro->email."', ";
	}
	
	$array_emails = substr($array_emails, 0, -2);
	$array_emails .= ']';
	
	# ativar a aba
	$encurtar_tamanho = 'encurtar_tamanho';
	$othersAction = 'active';
	$labelAction = 'Enviar Email';
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
	
	<link rel="stylesheet" type="text/css" href="<?=PLUGIN_URL?>autocomplete/jquery.autocomplete.css" />
	<script type='text/javascript' src='<?=PLUGIN_URL?>autocomplete/jquery.autocomplete.js'></script>
	
	<script>			
		$(document).ready(function()
		{	
			var emails = <?=$array_emails?>;
			
			$("#email").autocomplete(emails, {
				multiple: true,
				mustMatch: false,
				autoFill: true
			});
		});
	</script>
</head>
<body>
	
    <div id="content">
		
		<? include(LAYOUTS . 'topo.php'); ?>
        
        <div id="meio">
			
			<? include(VIEWS . 'igrejas' . DS . 'sub-menu.php'); ?>
			
			<div class="meio-conteudo-borda">


				<div class="meio-conteudo">

					<div class="print-vs">
						<span><a href="<?=URL . 'igrejas/visualizar/?id=' . $id?>">Voltar</a></span>
					</div>
					
					<div class="conteudo-rg">
						<form name="" method="post" action="">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela-vs">
								
								<tr class="marcador-vs">
									<td colspan="2">Enviar dados da igreja por e-mail</td>
								</tr>
								
								<tr class="dados-vs">
									<td class="label-vs"><br>Digite o e-mail:&nbsp;</td>
									<td><br><textarea class="text-edit" name="email" id="email" rows="2" cols="82"><?=$email?></textarea></td>
								</tr>
								
								<tr class="dados-vs">
									<td colspan="2" align="center">
										<input style="float: right; margin-right: 30px;" type="submit" name="enviar-filtro" value="Enviar" class="botao-filtro" />
									</td>
								</tr>
								
								<tr>
									<td class="dados-vs">&nbsp;</td>									
									<td class="dados-vs"> * Para enviar emails basta digitar o email do destinatário.<br /> ** Para enviar vários emails, bastar digitar o email seguido de virgula. Exemplo: jogao@hotmail.com, jose@hotmail.com<br /> *** O sistema irá sugerir email que se encontram cadastrado.</td>
								</tr>
								
								<tr>
									<td colspan="2"><input type="hidden" name="action" value="enviar_email" /></td>
								</tr>
								
								<tr>
									<td colspan="2" class="dados-vs">&nbsp;</td>
								</tr>
							</table>
						</form>
						
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela-vs">
							
							<tr class="marcador-vs">
								<td colspan="2">Dados Pessoais</td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Código:&nbsp;</td>
								<td><?=$igrejas->id?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Regional:&nbsp;</td>
								<td><?=select('Regionais', 'nome', $igrejas->regional_id)?></td>
							</tr>	
							
							<tr class="dados-vs">
								<td class="label-vs">Estado:&nbsp;</td>
								<td>Piauí</td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Cidade:&nbsp;</td>
								<td>Teresina</td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Nome Fantasia:&nbsp;</td>
								<td><?=stripslashes($igrejas->nome_fantasia)?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Razão Social:&nbsp;</td>
								<td><?=stripslashes($igrejas->razao_social)?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">CNPJ:&nbsp;</td>
								<td><?=$igrejas->cnpj?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">História:&nbsp;</td>
								<td><?=stripslashes($igrejas->historia)?></td>
							</tr>
							
							<tr class="marcador-vs">
								<td colspan="2">Informações Residenciais</td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Endereço:&nbsp;</td>
								<td><?=stripslashes($igrejas->endereco)?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Número:&nbsp;</td>
								<td><?=$igrejas->numero?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Complemento:&nbsp;</td>
								<td><?=stripslashes($igrejas->complemento)?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Bairro:&nbsp;</td>
								<td><?=stripslashes($igrejas->bairro)?></td>
							</tr>	
							
							<tr class="dados-vs">
								<td class="label-vs">CEP:&nbsp;</td>
								<td><?=$igrejas->cep?></td>
							</tr>		

							<tr class="dados-vs">
								<td class="label-vs">Criado:&nbsp;</td>
								<td><?=formataData($igrejas->created_at, 'datetime', 'datetime')?></td>
							</tr>
							
							<tr class="dados-vs">
								<td class="label-vs">Modificado:&nbsp;</td>
								<td><?=formataData($igrejas->modified_at, 'datetime', 'datetime')?></td>
							</tr>			

							<tr class="dados-vs">
								<td class="label-vs">Status:&nbsp;</td>
								<td><? if($igrejas->status == 1) echo 'Ativo'; else echo 'Desativo'; ?></td>
							</tr>							
						</table>
					</div>
					
				</div>
			</div>
        </div>
        
		<? include(LAYOUTS . 'rodape.php'); ?>
		
    </div>
    	
</body>
</html>

