<input type="hidden" name="id" id="id" value="<?=$tipos->id?>" />

<tr class="marcador-vs">
	<td colspan="2">Dados Gerais</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Nome:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('nome_erro', $erro)) echo 'text-erro'; ?>" type="text" name="nome" id="nome" value="<?=$tipos->nome?>" size="70" maxlength="60" />
		<div class="contador" id="count-nome"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Status:&nbsp;</td>
	<td>
		<input name="status" id="status" type="checkbox" value="1" <? if($tipos->status == 1) echo 'checked="checked"'; ?> />
	</td>
</tr>	

<tr class="dados-vs">
	<td colspan="2" align="center">
		<input type="submit" name="enviar-filtro" value="Enviar" class="botao-filtro" />
		<input type="button" name="enviar-filtro" value="Voltar" class="botao-filtro" />
	</td>
</tr>

<input type="hidden" name="action" value="enviar" />