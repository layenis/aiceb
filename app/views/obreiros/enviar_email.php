<?
	session_start();
	
	require_once(CONTROLLERS . 'obreirosController.php');
		
	$obreirosController = new ObreirosController();
	$obreiros = new Obreiros();
	
	if(isset($_POST['action']))
	{
		if(($id = (int) $_GET['id']) != 0)
		{
			# pesquisa pelo id
			$obreiros = $obreirosController->buscaPorId($id);
						
			if($obreiros == false)
			{
				setMensagem("Registro inválido");
				header('Location: ' . URL . 'obreiros/index'); 
				exit;
			}	
			
			# validar alguns campos
			$obreiros->data_nasc              = formataData($obreiros->data_nasc);
			$obreiros->data_nasc_esposa       = formataData($obreiros->data_nasc_esposa);
			$obreiros->data_formacao_pastoral = formataData($obreiros->data_formacao_pastoral);
			$obreiros->data_exame_pastoral    = formataData($obreiros->data_exame_pastoral);
			$obreiros->data_ordenacao         = formataData($obreiros->data_ordenacao);
			
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
					<center><font color="#000000" size="3"> <b> Dados da Obreiro ' . $obreiros->nome . '</b></font></center>
					<br>
					<table>
						<tr>
							<td><b> Nome: </b></td>
							<td>' . $obreiros->nome . '</td>
						</tr>
						<tr>
							<td><b> CPF: </b></td>
							<td>' . $obreiros->cpf . '</td>
						</tr>
						<tr>
							<td><b> RG: </b></td>
							<td>' . $obreiros->rg . '</td>
						</tr>
						<tr>
							<td><b> Órgão Emissor: </b></td>
							<td>' . $obreiros->orgao_emissor . '</td>
						</tr>
						<tr>
							<td><b> Data de nascimento: </b></td>
							<td>' . $obreiros->data_nasc . '</td>
						</tr>
						<tr>
							<td><b> Nome do pai: </b></td>
							<td>' . $obreiros->pai . '</td>
						</tr>
						<tr>
							<td><b> Nome da mãe: </b></td>
							<td>' . $obreiros->mae . '</td>
						</tr>
						<tr>
							<td><b> Nome da esposa: </b></td>
							<td>' . $obreiros->nome_esposa . '</td>
						</tr>
						<tr>
							<td><b> Data de nascimento da esposa: </b></td>
							<td>' . $obreiros->data_nasc_esposa . '</td>
						</tr>
						<tr>
							<td><b> Formação da esposa: </b></td>
							<td>' . $obreiros->formacao_esposa . '</td>
						</tr>
						<tr>
							<td><b> Número de filhos: </b></td>
							<td>' . $obreiros->num_filhos . '</td>
						</tr>
						<tr>
							<td><b> Endereço: </b></td>
							<td>' . $obreiros->endereco . '</td>
						</tr>
						<tr>
							<td><b> Complemento: </b></td>
							<td>' . $obreiros->complemento . '</td>
						</tr>
						<tr>
							<td><b> Bairro: </b></td>
							<td>' . $obreiros->bairro . '</td>
						</tr>
						<tr>
							<td><b> CEP: </b></td>
							<td>' . $obreiros->cep . '</td>
						</tr>
						<tr>
							<td><b> Cidade: </b></td>
							<td>' . $obreiros->cidade_id . '</td>
						</tr>
						<tr>
							<td><b> Estado: </b></td>
							<td>' . $obreiros->estado_id . '</td>
						</tr>
						<tr>
							<td><b> Telefone: </b></td>
							<td>' . $obreiros->telefone . '</td>
						</tr>
						<tr>
							<td><b> Celular: </b></td>
							<td>' . $obreiros->celular . '</td>
						</tr>
						<tr>
							<td><b> E-mail: </b></td>
							<td>' . $obreiros->email . '</td>
						</tr>
						<tr>
							<td><b> Grau de instrução: </b></td>
							<td>' . $obreiros->grau_instrucao . '</td>
						</tr>
						<tr>
							<td><b> Curso: </b></td>
							<td>' . $obreiros->curso . '</td>
						</tr>
						<tr>
							<td><b> Local de formação pastoral: </b></td>
							<td>' . $obreiros->local_formacao_pastoral . '</td>
						</tr>
						<tr>
							<td><b> Data da formação pastoral: </b></td>
							<td>' . $obreiros->data_formacao_pastoral . '</td>
						</tr>
						<tr>
							<td><b> Data do exame pastoral: </b></td>
							<td>' . $obreiros->data_exame_pastoral . '</td>
						</tr>
						<tr>
							<td><b> Classificação: </b></td>
							<td>' . $obreiros->classificacao . '</td>
						</tr>
						<tr>
							<td><b> Data da ordenação: </b></td>
							<td>' . $obreiros->data_ordenacao . '</td>
						</tr>
						<tr>
							<td><b> Experiência ministerial: </b></td>
							<td>' . $obreiros->experiencia_ministerial . '</td>
						</tr>
						<tr>
							<td><b> Informações adicionais: </b></td>
							<td>' . $obreiros->info_adicionais . '</td>
						</tr>
					</table>
				</body>
			</html>';
						
			if(mail($email, "Dados do obreiro " . $obreiros->nome, $mensagem, $headers))
			{
				setMensagem('E-mail enviado com sucesso!');			
			}
			else
			{
				setMensagem('Não foi possível enviar seu email!');
			}
			
			header('Location: ' . URL . 'obreiros/index'); 
			exit;
		}
		else
		{
			setMensagem("Registro inválido");
			header('Location: ' . URL . 'obreiros/index'); 
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
			
			<? include(VIEWS . 'obreiros' . DS . 'sub-menu.php'); ?>
			
			<div class="meio-conteudo-borda">
				<div class="meio-conteudo">
	
					<div class="conteudo-rg">
						<form name="" method="post" action="">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabela-vs">
								
								<tr class="marcador-vs">
									<td colspan="2">Enviar dados do obreiro por e-mail</td>
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

