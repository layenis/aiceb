<?
$email = "layenis@gmail.com";
$mensagem = "Estamos implementando ainda o conteúdo da mensagem.. Aguarde";

# CABEÇALHO DO E-MAIL
$headers = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From: ".$email."\n";

# MENSAGEM PERSONALIZADA
$mensagem = '<html>
<body style="font-family:Arial; font-size: 14px;">
<div style="width:500px;border:4px solid #999999;height:auto;overflow:hidden;padding:15px;background-color:#9c0; border:solid 1px #693; text-align:left;">

<span style="font-size:18px;"><strong>Mensagem: </strong>'.$mensagem.'</span>
<img src='. IMG_URL . 'visualizar.png/>

</div>
</body>
</html>';

if(mail("layenis@gmail.com", "Agenda da diretoria geral", $mensagem, $headers))
{
$erro = 'Mensagem enviada com sucesso!';
}
else
{
$erro = 'Não foi possivel enviar seu email!';
}

?>