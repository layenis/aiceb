<?
	# verifica permissao na tabela -> Agendas_regionais -> 16
	verificarPermissao(16);
?>
<div class="sub-menu">
	<span class="bg">Agenda do Presidente</span>
	<span class="acao <?=$actionPesquisar?>"><a href="<?=URL?>agendasregionais/index" title="Pesquisar">Pesquisar</a></span>
	<span class="acao <?=$actionInserir?>"><a href="<?=URL?>agendasregionais/novo" title="Inserir">Inserir</a></span>
	
	<? if(!empty($labelAction)) { ?>
	<span class="acao <?=$othersAction?>"><a href="javascript:;" title="<?=$labelAction?>"><?=$labelAction?></a></span>
	<? } ?>
	
	<span class="barra-bg <?=$encurtar_tamanho?>"></span>
</div>