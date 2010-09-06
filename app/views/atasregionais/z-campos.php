<input type="hidden" name="id" id="id" value="<?=$atasregionais->id?>" />

<tr class="marcador-vs">
	<td colspan="2">Criação de Ata</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Título:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('titulo_erro', $erro)) echo 'text-erro'; ?>" type="text" name="titulo" id="titulo" value="<?=$atasregionais->titulo?>" size="80" maxlength="80" />
		<div class="contador" id="count-titulo"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Número:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('numero_erro', $erro)) echo 'text-erro'; ?>" type="text" name="numero" id="numero" value="<?=$atasregionais->numero?>" size="10" maxlength="10" />
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Data:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('data_ata_erro', $erro)) echo 'text-erro'; ?>" type="text" name="data_ata" id="data_ata" value="<?=$atasregionais->data_ata?>" size="10" maxlength="10" />
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Descrição:&nbsp;</td>
	<td>
		<textarea cols="70" rows="20" name="descricao" id="descricao" class="text-edit"><?=$atasregionais->descricao?></textarea>
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