<?    
    session_start();
    
    require_once(CONTROLLERS . 'regionaisController.php');
	
  	$regionaisController = new RegionaisController();
  	$regional = new Regionais();
  	
    $regional = $regionaisController->buscaPorId($_GET['id']);
    
    if(isset($_POST['action']))
    {
        $regionaisController->excluir($_GET['id']);
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
	  
    <? include(VIEWS . 'regionais' . DS . 'sub-menu.php'); ?>
        
  
  	<div class="meio-conteudo-borda">
			<div class="meio-conteudo">
		    
      <div class="conteudo-rg">
			  <form action="" method="post" name="form-salvar">  
	        Deseja realmente excluir essa regional [<?=$regional->nome?>]? <br>
	        
	   <input type="hidden" name="action" value="salvar" />
	   
	   <input type="submit" name="botao" value="Sim" />
	   <input type="button" name="voltar" value="Não" onclick="location.href='<?=URL . 'regionais/'?>'" />
	</form>
	   
</body>
</html>