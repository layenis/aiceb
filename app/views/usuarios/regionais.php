<?php
	session_start();
	
	# verificar se o usuario está logado
	verificaLogin();
?>
	<td class="label-vs">Regional:&nbsp;</td>
	<td>
		<?
			echo listBox('text-edit listbox', 'regional_id', 'Regionais', 'nome', $usuarios->regional_id, 'status = 1', 'nome asc', 'utf8');
		?>
	</td>