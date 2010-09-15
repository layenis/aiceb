<?
	# verifica permissao na tabela -> Membros_dirgeral -> 19
	verificarPermissao(19);
?>
<div class="sub-menu">
	<span class="bg">Membros da gestão atual</span>
	<span class="acao <?=$actionPesquisar?>"><a href="<?=URL?>membrosdirgeral/index" title="Pesquisar">Pesquisar</a></span>
	<span class="acao <?=$actionInserir?>"><a href="<?=URL?>membrosdirgeral/novo" title="Inserir">Inserir</a></span>
	
	<? if(!empty($labelAction)) { ?>
	<span class="acao <?=$othersAction?>"><a href="javascript:;" title="<?=$labelAction?>"><?=$labelAction?></a></span>
	<? } ?>
	
	<span class="barra-bg <?=$encurtar_tamanho?>"></span>
</div>