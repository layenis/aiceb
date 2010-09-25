<input type="hidden" name="id" id="id" value="<?=$igrejas->id?>" />

<tr class="marcador-vs">
	<td colspan="2">Dados Gerais</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Regional:&nbsp;</td>
	<td>
		<?php 
			$_class = 'text-edit';
			if(in_array('regional_id_erro', $erro)) 
				$_class .= ' text-erro';

			echo listBox($_class, 'regional_id', 'Regionais', 
						 'nome', $igrejas->regional_id, 'status = 1', 
						 'nome asc');
		?>

	</td>
</tr>	

<tr class="dados-vs">
	<td class="label-vs">Código da Igreja:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('codigo_erro', $erro)) echo 'text-erro'; ?>" type="text" name="codigo" id="codigo" value="<?=$igrejas->codigo?>" size="10" maxlength="6" />
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Nome Fantasia:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('nome_fantasia_erro', $erro)) echo 'text-erro'; ?>" type="text" name="nome_fantasia" id="nome_fantasia" value="<?=$igrejas->nome_fantasia?>" size="82" maxlength="80" />
		<div class="contador" id="count-nome_fantasia"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Razão Social:&nbsp;</td>
	<td>
		<textarea cols="70" rows="4" name="razao_social" id="razao_social" class="text-edit  <? if(in_array('razao_social_erro', $erro)) echo 'text-erro'; ?> <? if(in_array('razao_social_erro', $erro)) echo 'text-erro'; ?>"><?=$igrejas->razao_social?></textarea>
		<div class="contador" id="count-razao_social"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">CNPJ:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('cnpj_erro', $erro)) echo 'text-erro'; ?>" type="text" name="cnpj" id="cnpj" value="<?=$igrejas->cnpj?>" size="20" maxlength="18" />
		<div class="contador" id="count-cnpj"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">História:&nbsp;</td>
	<td>
		<textarea cols="70" rows="8" name="historia" id="historia" class="text-edit  <? if(in_array('historia_erro', $erro)) echo 'text-erro'; ?>"><?=$igrejas->historia?></textarea>
		<div class="contador" id="count-historia"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Fundação:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('data_fundacao_erro', $erro)) echo 'text-erro'; ?>" type="text" name="data_fundacao" id="data_fundacao" value="<?=$igrejas->data_fundacao?>" size="20" maxlength="10" />
		<div class="contador" id="count-data_fundacao"></div>
	</td>
</tr>

<tr class="marcador-vs">
	<td colspan="2">Dados Residenciais</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs"><label for="cep">Cep:&nbsp;</label></td>
	<td>
		<input class="text-edit  <? if(in_array('cep_erro', $erro)) echo 'text-erro'; ?>" type="text" name="cep" id="cep" value="<?=$igrejas->cep?>" size="16" maxlength="9" />
		<div class="contador" id="count-cep"></div>
		<button class="botao-filtro" style="margin-left: 10px; padding: 2px 10px;">Pesquisar Cep</button>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Rua:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('endereco_erro', $erro)) echo 'text-erro'; ?>" type="text" name="endereco" id="endereco" value="<?=$igrejas->endereco?>" size="82" maxlength="120" />
		<div class="contador" id="count-endereco"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Número:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('numero_erro', $erro)) echo 'text-erro'; ?>" type="text" name="numero" id="numero" value="<?=$igrejas->numero?>" size="16" maxlength="10" />
		<div class="contador" id="count-numero"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Complemento:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('complemento_erro', $erro)) echo 'text-erro'; ?>" type="text" name="complemento" id="complemento" value="<?=$igrejas->complemento?>" size="50" maxlength="80" />
		<div class="contador" id="count-complemento"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Bairro:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('bairro_erro', $erro)) echo 'text-erro'; ?>" type="text" name="bairro" id="bairro" value="<?=$igrejas->bairro?>" size="50" maxlength="80" />
		<div class="contador" id="count-bairro"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Cidade:&nbsp;</td>
	<td>		
		<input class="text-edit  <? if(in_array('cidade_erro', $erro)) echo 'text-erro'; ?>" type="text" name="cidade" id="cidade" value="<?=$igrejas->cidade?>" size="50" maxlength="80" />
		<div class="contador" id="count-cidade"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Estado:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('estado_erro', $erro)) echo 'text-erro'; ?>" type="text" name="estado" id="estado" value="<?=$igrejas->estado?>" size="4" maxlength="2" />
		<div class="contador" id="count-estado"></div>
	</td>
</tr>						

<!--
<tr class="marcador-vs">
	<td colspan="2">Outros</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Status:&nbsp;</td>
	<td>
		<input name="status" id="status" type="checkbox" value="1" <? if($igrejas->status == 1) echo 'checked="checked"'; ?> />
	</td>
</tr>	
-->

<tr class="dados-vs">
	<td colspan="2" align="center">
		<input onclick="this.form.submit();" type="submit" name="enviar-filtro" value="Enviar" class="botao-filtro" />
		<input onclick="javascript: history.back();" type="button" name="enviar-filtro" value="Voltar" class="botao-filtro" />
	</td>
</tr>

<input type="hidden" name="action" value="enviar" />