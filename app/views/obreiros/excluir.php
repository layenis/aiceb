<?
    session_start();
        
    require_once(CONTROLLERS . 'obreirosController.php');
	
  	$obreirosController = new ObreirosController();
  	$obreiro = new Obreiros();
  	
    $obreiro = $obreirosController->buscaPorId($_GET['id']);
    
    if(isset($_POST['action']))
    {
        $obreirosController->excluir($_GET['id']);
    }
  	
?>
<head>
    
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>Sistema Administrativo - AICEB</title>
    
	<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>style.css" />
	<link rel="stylesheet" type="text/css" href="<?=CSS_URL?>superfish.css" media="screen">
	
</head>

<body>
	
    <div id="content">
		
		<? include(LAYOUTS . 'topo.php'); ?>
        
        <div id="meio">
	  
    <? include(VIEWS . 'obreiros' . DS . 'sub-menu.php'); ?>
        
  
  	<div class="meio-conteudo-borda">
			<div class="meio-conteudo">
		    
      <div class="conteudo-rg">
			  <form action="" method="post" name="form-salvar">  
	        Deseja realmente excluir esse obreiro [<?=$obreiro->nome?>]? <br>
	        
	   <input type="hidden" name="action" value="salvar" />
	   
	   <input type="submit" name="botao" value="Sim" />
	   <input type="button" name="voltar" value="Não" onclick="location.href='<?=URL . 'obreiros/'?>'" />
	</form>
	   
</body>
</html>