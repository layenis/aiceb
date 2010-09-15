<?
	# verifica permissao na tabela -> Agendas_gerais -> 15
	verificarPermissao(15);
?>
<div class="sub-menu">
	<span class="bg">Agenda do Presidente</span>
	<span class="acao <?=$actionPesquisar?>"><a href="<?=URL?>agendasgerais/index" title="Pesquisar">Pesquisar</a></span>
	<span class="acao <?=$actionInserir?>"><a href="<?=URL?>agendasgerais/novo" title="Inserir">Inserir</a></span>
	
	<? if(!empty($labelAction)) { ?>
	<span class="acao <?=$othersAction?>"><a href="javascript:;" title="<?=$labelAction?>"><?=$labelAction?></a></span>
	<? } ?>
	
	<span class="barra-bg <?=$encurtar_tamanho?>"></span>
</div>