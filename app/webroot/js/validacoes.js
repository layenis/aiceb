/* validações */
jQuery(function($)
{
   $("#cep").mask("99999-999");
   $("#cnpj").mask("99.999.999/9999-99");
   $("#data_fundacao").mask("99/99/9999");
});

$(document).ready(function()
{
	$('#nome_fantasia').limit('80', '#count-nome_fantasia');
	$('#razao_social').limit('250', '#count-razao_social');
	$('#cnpj').limit('18', '#count-cnpj');
	$('#historia').limit('65535', '#count-historia');
	$('#data_fundacao').limit('10', '#count-data_fundacao');
	
	$('#endereco').limit('120', '#count-endereco');
	$('#numero').limit('10', '#count-numero');
	$('#complemento').limit('80', '#count-complemento');
	$('#cep').limit('9', '#count-cep');
	$('#bairro').limit('80', '#count-bairro');
});