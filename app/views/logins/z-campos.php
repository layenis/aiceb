<input type="hidden" name="id" id="id" value="<?=$usuarios->id?>" />

<tr class="marcador-vs">
	<td colspan="2">Dados Gerais</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Tipo:&nbsp;</td>
	<td>
		<?
			if(in_array('tipo_id_erro', $erro)) $_classe = 'text-erro';
			echo listBox('text-edit '.$_classe.' listbox', 'tipo_id', 'Tipos', 'nome', $usuarios->tipo_id, 'status = 1', 'nome asc');
		?>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Nome:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('nome_erro', $erro)) echo 'text-erro'; ?>" type="text" name="nome" id="nome" value="<?=$usuarios->nome?>" size="70" maxlength="60" />
		<div class="contador" id="count-nome"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Email:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('email_erro', $erro)) echo 'text-erro'; ?>" type="text" name="email" id="email" value="<?=$usuarios->email?>" size="70" maxlength="60" />
		<div class="contador" id="count-email"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Telefone:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('telefone_erro', $erro)) echo 'text-erro'; ?>" type="text" name="telefone" id="telefone" value="<?=$usuarios->telefone?>" size="20" maxlength="14" />
		<div class="contador" id="count-telefone"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Celular:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('celular_erro', $erro)) echo 'text-erro'; ?>" type="text" name="celular" id="celular" value="<?=$usuarios->celular?>" size="20" maxlength="14" />
		<div class="contador" id="count-celular"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Login:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('login_erro', $erro)) echo 'text-erro'; ?>" type="text" name="login" id="login" value="<?=$usuarios->login?>" size="20" maxlength="15" />
		<div class="contador" id="count-login"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Senha:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('senha_erro', $erro)) echo 'text-erro'; ?>" type="password" name="senha" id="senha" value="" size="20" maxlength="15" />
		<div class="contador" id="count-senha"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Status:&nbsp;</td>
	<td>
		<input name="status" id="status" type="checkbox" value="1" <? if($usuarios->status == 1) echo 'checked="checked"'; ?> />
	</td>
</tr>	

<tr class="dados-vs">
	<td colspan="2" align="center">
		<input type="submit" name="enviar-filtro" value="Enviar" class="botao-filtro" />
		<input type="button" name="enviar-filtro" value="Voltar" class="botao-filtro" />
	</td>
</tr>

<input type="hidden" name="action" value="enviar" />