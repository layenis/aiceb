<input type="hidden" name="id" id="id" value="<?=$tabelas->id?>" />

<tr class="marcador-vs">
	<td colspan="2">Dados Gerais</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Menu:&nbsp;</td>
	<td>
		<?
			if(in_array('menu_id_erro', $erro)) $_classe = 'text-erro';
			echo listBox('text-edit '.$_classe.' listbox', 'menu_id', 'Menus', 'nome', $tabelas->menu_id, 'status = 1', 'nome asc');
		?>
	</td>
</tr>	

<tr class="dados-vs">
	<td class="label-vs">Nome:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('nome_erro', $erro)) echo 'text-erro'; ?>" type="text" name="nome" id="nome" value="<?=$tabelas->nome?>" size="60" maxlength="50" />
		<div class="contador" id="count-nome"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Tabela:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('tabela_erro', $erro)) echo 'text-erro'; ?>" type="text" name="tabela" id="tabela" value="<?=$tabelas->tabela?>" size="60" maxlength="40" />
		<div class="contador" id="count-tabela"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Status:&nbsp;</td>
	<td>
		<input name="status" id="status" type="checkbox" value="1" <? if($tabelas->status == 1) echo 'checked="checked"'; ?> />
	</td>
</tr>	

<tr class="dados-vs">
	<td colspan="2" align="center">
		<input type="submit" name="enviar-filtro" value="Enviar" class="botao-filtro" />
		<input type="button" name="enviar-filtro" value="Voltar" class="botao-filtro" />
	</td>
</tr>

<input type="hidden" name="action" value="enviar" />