	<div class="conteudo-pg">
		<span class="info-pg">Listando <?=$paginacao['primeiro_indice']?> até <?=$paginacao['ultimo_indice']?> de <?=$paginacao['total_resultados']?> registros</span>
		
		<div class="paginacao">
			<!-- primerio indice -->
			<? if($paginacao['pagina_atual'] == $paginacao['primeiro_indice']) { ?>
			<div class="botoes-pg radios-left no-paginacao">Primeiro</div>
			<? } else { ?>
			<div class="botoes-pg radios-left"><a href="<?=$paginacao['primeiro']?>" title="Primeiro">Primeiro</a></div>
			<? } ?>

			<? if($paginacao['primeiro_indice'] == $paginacao['anterior_numero']) { ?>
			<div class="botoes-pg">Anterior</div>
			<? } else { ?>
			<div class="botoes-pg"><a href="<?=$paginacao['anterior']?>" title="Anterior">Anterior</a></div>
			<? } ?>
			
			<div class="botoes-pg"><?=$paginacao['pagina_atual']?></div>
			
			<? if($paginacao['pagina_atual'] == $paginacao['ultimo_numero']) { ?>
			<div class="botoes-pg">Próximo</div>
			<? } else { ?>
			<div class="botoes-pg"><a href="<?=$paginacao['proximo']?>" title="Próximo">Próximo</a></div>
			<? } ?>							
			
			<!-- ultimo indice -->
			<? if($paginacao['pagina_atual'] == $paginacao['ultimo_numero']) { ?>
			<div class="botoes-pg radios-right">Último</div>
			<? } else { ?>
			<div class="botoes-pg radios-right"><a href="<?=$paginacao['ultimo']?>" title="Último">Último</a></div>
			<? } ?>							
		</div>
	</div>