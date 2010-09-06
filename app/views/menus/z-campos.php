<input type="hidden" name="id" id="id" value="<?=$menus->id?>" />

<tr class="marcador-vs">
	<td colspan="2">Dados Gerais</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Posição:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('posicao_erro', $erro)) echo 'text-erro'; ?>" type="text" name="posicao" id="posicao" value="<?=$menus->posicao?>" size="20" maxlength="10" />
		<div class="contador" id="count-posicao"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Nome:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('nome_erro', $erro)) echo 'text-erro'; ?>" type="text" name="nome" id="nome" value="<?=$menus->nome?>" size="70" maxlength="60" />
		<div class="contador" id="count-nome"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Status:&nbsp;</td>
	<td>
		<input name="status" id="status" type="checkbox" value="1" <? if($menus->status == 1) echo 'checked="checked"'; ?> />
	</td>
</tr>	

<tr class="dados-vs">
	<td colspan="2" align="center">
		<input type="submit" name="enviar-filtro" value="Enviar" class="botao-filtro" />
		<input type="button" name="enviar-filtro" value="Voltar" class="botao-filtro" />
	</td>
</tr>

<input type="hidden" name="action" value="enviar" />