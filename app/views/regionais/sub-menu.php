<?
	# verifica permissao na tabela -> Regionais -> 2
	verificarPermissao(7);
?>
<div class="sub-menu">
	<span class="bg">Regionais</span>
	
	<span class="acao <?=$actionPesquisar?>"><a href="<?=URL?>regionais/index" title="Pesquisar">Pesquisar</a></span>
	
	<? if($_SESSION['USUARIO_GRAU_PERMISSAO'] > 1) { ?>
	<span class="acao <?=$actionInserir?>"><a href="<?=URL?>regionais/novo" title="Inserir">Inserir</a></span>
	<? } ?>
	
	<? if(!empty($labelAction)) { ?>
	<span class="acao <?=$othersAction?>"><a href="javascript:;" title="<?=$labelAction?>"><?=$labelAction?></a></span>
	<? } ?>
	
	<span class="barra-bg <?=$encurtar_tamanho?>"></span>
</div>