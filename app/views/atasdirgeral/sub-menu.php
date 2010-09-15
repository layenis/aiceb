<?
	# verifica permissao na tabela -> Atas_dirgeral -> 17
	verificarPermissao(17);
?>
<div class="sub-menu">
	<span class="bg">Atas</span>
	<span class="acao <?=$actionPesquisar?>"><a href="<?=URL?>atasdirgeral/index" title="Pesquisar">Pesquisar</a></span>
	<span class="acao <?=$actionInserir?>"><a href="<?=URL?>atasdirgeral/novo" title="Inserir">Inserir</a></span>
	
	<? if(!empty($labelAction)) { ?>
	<span class="acao <?=$othersAction?>"><a href="javascript:;" title="<?=$labelAction?>"><?=$labelAction?></a></span>
	<? } ?>
	
	<span class="barra-bg <?=$encurtar_tamanho?>"></span>
</div>