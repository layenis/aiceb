<input type="hidden" name="id" id="id" value="<?=$regionais->id?>" />

<tr class="marcador-vs">
	<td colspan="2">Dados Gerais</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Código:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('codigo_erro', $erro)) echo 'text-erro'; ?>" type="text" name="codigo" id="codigo" value="<?=$regionais->codigo?>" size="10" maxlength="10" />
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Nome:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('nome_erro', $erro)) echo 'text-erro'; ?>" type="text" name="nome" id="nome" value="<?=$regionais->nome?>" size="80" maxlength="100" />
		<div class="contador" id="count-nome"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Descrição:&nbsp;</td>
	<td>
		<input class="text-edit" type="text" name="descricao" id="descricao" value="<?=$regionais->descricao?>" size="80" maxlength="100" />
		<div class="contador" id="count-descricao"></div>
	</td>
</tr> 

<tr class="dados-vs">
	<td colspan="2" align="center">
		<input type="submit" name="enviar-filtro" value="Enviar" class="botao-filtro" />
		<input type="button" name="enviar-filtro" value="Voltar" class="botao-filtro" />
	</td>
</tr>

<input type="hidden" name="action" value="salvar" />