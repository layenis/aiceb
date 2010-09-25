<input type="hidden" name="id" id="id" value="<?=$entradas->id?>" />

<tr class="marcador-vs">
	<td colspan="2">Movimentação Financeira - Entrada</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Selecione a igreja:&nbsp;</td>
	<td>
	<?
		$_class = 'text-edit listbox';
		if(in_array('igreja_id_erro', $erro)) $_class .= ' text-erro';
		
		echo listBox($_class, 'igreja_id', 'Igrejas', 'nome_fantasia', $entradas->igreja_id, 'status = 1', 'nome_fantasia asc');
	?>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Mês do depósito:&nbsp;</td>
	<td>
		<select name="mes_deposito" id="mes_deposito" class="text-edit  <? if(in_array('mes_deposito_erro', $erro)) echo 'text-erro'; ?> listbox">
			<option value="">Selecione o mês...</option>
			<?
				$array_mes = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 
								   'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
				
				foreach($array_mes as $row)
				{
					if ($entradas->mes_deposito == $row)
					{
			?>
					<option value="<?=$row?>" selected="selected"><?=$row?></option>
			<?
					}
					else
					{
			?>		
					<option value="<?=$row?>"><?=$row?></option>
			<?
					}
				}
			?>
		</select>
	</td>
</tr>	

<tr class="dados-vs">
	<td class="label-vs">Data:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('data_entrada_erro', $erro)) echo 'text-erro'; ?>" type="text" name="data_entrada" id="data_entrada" value="<?=formataData($entradas->data_entrada, 'date', 'date')?>" size="10" maxlength="10" />
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Nome do banco:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('nome_banco_erro', $erro)) echo 'text-erro'; ?>" type="text" name="nome_banco" id="nome_banco" value="<?=$entradas->nome_banco?>" size="40" maxlength="40" />
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Número do depósito:&nbsp;</td>
	<td>
		<input class="text-edit" type="text" name="numero_deposito" id="numero_deposito" value="<?=$entradas->numero_deposito?>" size="40" maxlength="40" />
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Valor:&nbsp;</td>
	<td>
		<input class="text-edit <? if(in_array('valor_erro', $erro)) echo 'text-erro'; ?>" type="text" name="valor" id="valor" value="<?=$entradas->valor?>" size="10" maxlength="10" />
	</td>
</tr> 

<tr class="dados-vs">
	<td colspan="2" align="center">
		<input type="submit" name="enviar-filtro" value="Enviar" class="botao-filtro" />
		<input onclick="javascript: history.back();" type="button" name="enviar-filtro" value="Voltar" class="botao-filtro" />
	</td>
</tr>

<input type="hidden" name="action" value="salvar" />