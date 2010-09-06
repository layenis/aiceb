<input type="hidden" name="id" id="id" value="<?=$agendasgerais->id?>" />

<tr class="marcador-vs">
	<td colspan="2">Agenda do Presidente</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Data:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('data_agenda_erro', $erro)) echo 'text-erro'; ?>" type="text" name="data_agenda" id="data_agenda" value="<?=$agendasgerais->data_agenda?>" size="10" maxlength="10" />
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Local:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('local_erro', $erro)) echo 'text-erro'; ?>" type="text" name="local" id="local" value="<?=$agendasgerais->local?>" size="80" maxlength="80" />
		<div class="contador" id="count-local"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Título:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('titulo_erro', $erro)) echo 'text-erro'; ?>" type="text" name="titulo" id="titulo" value="<?=$agendasgerais->titulo?>" size="80" maxlength="80" />
		<div class="contador" id="count-titulo"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Descrição:&nbsp;</td>
	<td>
		<textarea cols="60" rows="10" name="descricao" id="descricao" class="text-edit"><?=$agendasgerais->descricao?></textarea>
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