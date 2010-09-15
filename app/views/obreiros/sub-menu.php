<?
	# verifica permissao na tabela -> Obreiros -> 10
	verificarPermissao(10);
?>
<div class="sub-menu">
	<span class="bg">Obreiros</span>
	<span class="acao <?=$actionPesquisar?>"><a href="<?=URL?>obreiros/index" title="Pesquisar">Pesquisar</a></span>
	<span class="acao <?=$actionInserir?>"><a href="<?=URL?>obreiros/novo" title="Inserir">Inserir</a></span>
	
	<? if(!empty($labelAction)) { ?>
	<span class="acao <?=$othersAction?>"><a href="javascript:;" title="<?=$labelAction?>"><?=$labelAction?></a></span>
	<? } ?>
	
	<span class="barra-bg <?=$encurtar_tamanho?>"></span>
</div>