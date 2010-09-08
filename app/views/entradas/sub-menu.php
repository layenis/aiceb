<?
	# verifica permissao na tabela -> Entradas -> 8
	verificarPermissao(8);
?>
<div class="sub-menu">
	<span class="bg">Entradas</span>
	<span class="acao <?=$actionPesquisar?>"><a href="<?=URL?>entradas/index" title="Pesquisar">Pesquisar</a></span>
	<span class="acao <?=$actionInserir?>"><a href="<?=URL?>entradas/novo" title="Inserir">Inserir</a></span>

	<? if(!empty($labelAction)) { ?>
	<span class="acao <?=$othersAction?>"><a href="javascript:;" title="<?=$labelAction?>"><?=$labelAction?></a></span>
	<? } ?>
	
	<span class="barra-bg <?=$encurtar_tamanho?>"></span>
</div>