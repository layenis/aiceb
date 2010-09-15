/* Menu */
jQuery(function(){
	jQuery('ul.sf-menu').superfish();
});
		
/* Atualizar Status */
function atualizarStatus(p_status, p_id, p_tabela) 
{
	var div = $("#status-" + p_id);
	
	$.ajax({
		   
		type: "get",
		cache: false,
		url:  "/status/index",
		data: "p_status=" + p_status + "&p_id=" + p_id + "&p_tabela=" + p_tabela,
		
		beforeSend: function()
		{
			div.html('<img src="/img/ajax-loader.gif" />');
		},
		
		success: function(html)
		{
			if(p_status == 1)
			{
				div.html('<img src="/img/status-ok.png" onClick="javascript: atualizarStatus(0, ' + p_id + ', \'' + p_tabela + '\');" />');
			}
			else if(p_status == 0)
			{
				div.html('<img src="/img/status-no.png" onClick="javascript: atualizarStatus(1, ' + p_id + ', \'' + p_tabela + '\');" />');
			}
		}
	});
}

/* contador de caracteres */
(function($) {
     $.fn.extend({  
         limit: function(limit,element) {
			
			var interval;
			var self = $(this);
			
			$(this).focus(function(){
				interval = window.setInterval(substring,100);
			});
			
			$(this).blur(function(){
				clearInterval(interval);
				substring();
			});
			
			function substring(){
				length = $(self).val().length;
				if(element)
					$(element).html((limit-length<=0)?'0':limit-length);
				if(length > limit)
					$(self).val($(self).val().substring(0,limit));
			}
			
			substring();
			
        } 
    }); 
})(jQuery);

/* mudar permissão de status */
function mudarPermissao(p_tipo_id, p_tabela_id, p_permissao)
{
	var div = $("#permissao_tabela_" + p_tabela_id);
	
	$.ajax({
		   
		type: "get",
		cache: false,
		url:  "/tipos/mudar-permissao",
		data: "tipo_id=" + p_tipo_id + "&tabela_id=" + p_tabela_id + "&permissao=" + p_permissao,
		
		beforeSend: function()
		{
			div.html('<div style="text-align: center; height: 20px; margin-top: 7px;"><img src="/img/ajax-loader.gif"></div>');
		},
		
		success: function(result)
		{
			div.html(result);
		}
	});
}

/* carregar as regionais */
function carregarRegionais() 
{
	var tipo_id = $("#tipo_id").val();
	var div = $("#c-regional_id");
	
	if(tipo_id == 3)
	{
		$.ajax({
		
			type: "get",
			cache: false,
			url:  "/usuarios/regionais",
			data: "tipo_id=" + tipo_id,
			
			beforeSend: function()
			{
				div.html('<img src="/img/ajax-loader.gif">');
			},
			
			success: function(result)
			{
				div.html(result);
				div.fadeIn('slow');
			}
		});
	}
	else
	{
		div.fadeOut('slow');
		div.html('');
	}	
}

/* funcao que carrega o endereco baseado no cep */
function carregarEndereco()
{
	var cep = $('#cep').val();
	
	$.ajax({
	
		type: "get",
		cache: false,
		url:  "/enderecos/index",
		data: "cep=" + cep,
		
		beforeSend: function()
		{
			div.html('<img src="/img/ajax-loader.gif">');
		},
		
		success: function(result)
		{
			div.html(result);
			div.fadeIn('slow');
		}
	});
}