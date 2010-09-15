<input type="hidden" name="id" id="id" value="<?=$membrosdirgeral->id?>" />

<tr class="marcador-vs">
	<td colspan="2">Cadastro de membro da diretoria geral</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Igreja:&nbsp;</td>
	<td>			
		<?
			if(in_array('igreja_id_erro', $erro)) $_classe = 'text-erro';
			echo listBox('text-edit '.$_classe.' listbox', 'igreja_id', 'Igrejas', 'nome_fantasia', $membrosdirgeral->igreja_id, 'status = 1', 'nome_fantasia asc');
		?>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Nome:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('nome_erro', $erro)) echo 'text-erro'; ?>" type="text" name="nome" id="nome" value="<?=$membrosdirgeral->nome?>" size="80" maxlength="80" />
		<div class="contador" id="count-nome"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Função:&nbsp;</td>
	<td>
		<input class="text-edit  <? if(in_array('funcao_erro', $erro)) echo 'text-erro'; ?>" type="text" name="funcao" id="funcao" value="<?=$membrosdirgeral->funcao?>" size="50" maxlength="40" />
		<div class="contador" id="count-funcao"></div>
	</td>
</tr>

<tr class="dados-vs">
	<td class="label-vs">Telefone:&nbsp;</td>
	<td>
		<input class="text-edit" type="text" name="telefone" id="telefone" value="<?=$membrosdirgeral->telefone?>" size="15" maxlength="14" />
	</td>
</tr> 

<tr class="dados-vs">
	<td class="label-vs">E-mail:&nbsp;</td>
	<td>
		<input class="text-edit" type="text" name="email" id="email" value="<?=$membrosdirgeral->email?>" size="50" maxlength="40" />
		<div class="contador" id="count-email"></div>
	</td>
</tr> 

<tr class="dados-vs">
	<td class="label-vs">Início da gestão:&nbsp;</td>
	<td>
		<select name="inicio_gestao" id="inicio_gestao" class="text-edit  <? if(in_array('inicio_gestao_erro', $erro)) echo 'text-erro'; ?> listbox">
			<option value="0">Escolha um registro</option>
			<?
				for($i=2005; $i<=2030; $i++)
				{
					if ($membrosdirgeral->inicio_gestao == $i)
					{
			?>
					<option value="<?=$i?>" selected><?=$i?></option>
			<?
					}
					else
					{
			?>		
					<option value="<?=$i?>"><?=$i?></option>
			<?
					}
				}
			?>
		</select>
	</td>
</tr>	


<tr class="dados-vs">
	<td class="label-vs">Final da gestão:&nbsp;</td>
	<td>
	
		<select name="final_gestao" id="final_gestao" class="text-edit">
			<option value="">Escolha um registro</option>
			<?
				for($i=2005; $i<=2030; $i++)
				{
					if ($membrosdirgeral->final_gestao == $i)
					{
			?>
					<option value="<?=$i?>" selected><?=$i?></option>
			<?
					}
					else
					{
			?>		
					<option value="<?=$i?>"><?=$i?></option>
			<?
					}
				}
			?>
		</select>
	</td>
</tr>	

<tr class="dados-vs">
	<td colspan="2" align="center">
		<input type="submit" name="enviar-filtro" value="Enviar" class="botao-filtro" />
		<input type="button" name="enviar-filtro" value="Voltar" class="botao-filtro" />
	</td>
</tr>

<input type="hidden" name="action" value="salvar" />