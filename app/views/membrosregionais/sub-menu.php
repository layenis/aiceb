<?
	# verifica permissao na tabela -> Membros_regionais -> 18
	verificarPermissao(18);
?>
<div class="sub-menu">
	<span class="bg">Membros da gestão atual</span>
	<span class="acao <?=$actionPesquisar?>"><a href="<?=URL?>membrosregionais/index" title="Pesquisar">Pesquisar</a></span>
	<span class="acao <?=$actionInserir?>"><a href="<?=URL?>membrosregionais/novo" title="Inserir">Inserir</a></span>
	
	<? if(!empty($labelAction)) { ?>
	<span class="acao <?=$othersAction?>"><a href="javascript:;" title="<?=$labelAction?>"><?=$labelAction?></a></span>
	<? } ?>
	
	<span class="barra-bg <?=$encurtar_tamanho?>"></span>
</div>