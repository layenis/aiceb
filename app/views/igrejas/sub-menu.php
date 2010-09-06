<?
	# verifica permissao na tabela -> Igrejas -> 2
	verificarPermissao(2);
?>
<div class="sub-menu">
	<span class="bg">Igrejas</span>
	<span class="acao <?=$actionPesquisar?>"><a href="<?=URL?>igrejas/index" title="Pesquisar">Pesquisar</a></span>
	<span class="acao <?=$actionInserir?>"><a href="<?=URL?>igrejas/novo" title="Inserir">Inserir</a></span>
	
	<? if(!empty($labelAction)) { ?>
	<span class="acao <?=$othersAction?>"><a href="javascript:;" title="<?=$labelAction?>"><?=$labelAction?></a></span>
	<? } ?>
	
	<span class="barra-bg <?=$encurtar_tamanho?>"></span>
</div>