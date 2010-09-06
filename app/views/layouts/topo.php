<div id="topo">
	<div class="barra-top"></div>
	
	<div class="logo">
		<div class="text-logo">
			<span>Aliança das Igrejas Cristãs Evangélicas do Brasil</span>
			<span class="sub-titulo">Jesus Cristo, Nosso Fundamento</span>
		</div>
		<img src="<?=IMG_URL?>logo.jpg" alt="AICEB">
	</div>
	
	<div id="menu">
		<ul class="sf-menu">
			<li>
				<a href="<?=URL?>">Início</a>
			</li>	
			
			<?
				if(in_array($_SESSION['USUARIO_TIPO_ID'], array(1,2)))
				{
			?>
			<li class="current">
				<a href="#ab">Diretoria Geral</a>
				<ul>
					<li><a href="#">Relatórios</a></li>							
					<li><a href="/atasdirgeral">Atas</a></li>
					<li><a href="#abb">Boletins</a></li>
					<li><a href="/recibos/novo">Recibos</a></li>
					<li><a href="/agendasgerais">Agenda do Presidente</a></li>
				</ul>
			</li>
			<?
				}
			?>

			<li class="current">
				<a href="/regionais/index">Diretoria Regional</a>
				<ul>
					<li class="current"><a href="/relatorios/entradas">Relatórios</a></li>
					<li><a href="/atasregionais">Atas</a></li>
					<li><a href="#abb">Boletins</a></li>
					<li><a href="/entradas">Entradas</a></li>
					<li><a href="/agendasregionais">Agenda do Presidente</a></li>
				</ul>
			</li>	
			
			<li>
				<a href="<?=URL?>igrejas/index">Igrejas</a>
			</li>	
			
			<li>
				<a href="/obreiros/index">Obreiros</a>
			</li>
			
			<?
				if($_SESSION['USUARIO_TIPO_ID'] == 1)
				{
			?>			
			<li class="current">
				<a href="/usuarios/index">Usuários</a>
				<ul>
					<li class="current"><a href="/tipos/index">Tipos</a></li>
					<li><a href="/tabelas/index">Tabelas</a></li>
				</ul>
			</li>
			<?
				}
			?>			
			
			<li>
				<a href="/logins/logout">Sair</a>
			</li>						
		</ul>
	</div>
</div>