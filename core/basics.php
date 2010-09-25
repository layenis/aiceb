<?php
	function setMensagem($mensagem)
	{
		session_start();
		$_SESSION['FLASH'] = $mensagem;
	}
	
	function getMensagem()
	{
		session_start();
		return $_SESSION['FLASH'];
	}
	
	function unsetMensagem()
	{
		session_start();
		unset($_SESSION['FLASH']);
	}
	
	function formataDataBanco($data)
	{
		if(!empty($data))
		{
			list($dia, $mes, $ano) = explode('/', $data);

			return $ano . '-' . $mes . '-' . $dia;		
		}
	}
	
	function formataData($data, $tipo=null, $retorno=null)
	{
		if(!empty($data))
		{
			if(empty($retorno)) $retorno = 'date';
			
			if($tipo == 'datetime')
			{
				$_data = explode(' ', $data);
				
				list($ano, $mes, $dia) = explode('-', $_data[0]);
				list($hora, $minuto, $segundo) = explode(':', $_data[1]);
			}
			else
			{
				list($ano, $mes, $dia) = explode('-', $data);
			}
			
			if($retorno == 'date')
				return $dia . '/' . $mes . '/' . $ano;
			else
				return $dia . '/' . $mes . '/' . $ano . ' ' . $hora . ':' . $minuto . ':' . $segundo;
		}
		else
		{
			return ' - - ';
		}
	}
	
	function prepare($sql=null)
	{
		$sql = preg_replace('/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/', '', $sql);
		$sql = trim($sql);
		$sql = strip_tags($sql);
		$sql = addslashes($sql);
		
		return $sql;
	}

	function get($querystring=null)
	{
		if(!empty($_GET[$querystring]))
		{
			$querystring = $_GET[$querystring];

			$querystring = preg_replace('/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/', '', $querystring);
			$querystring = trim($querystring);
			$querystring = strip_tags($querystring);
			$querystring = addslashes($querystring);
	
			return $querystring;
		}
	}
	
	function post($querystring=null)
	{
		if(!empty($_POST[$querystring]))
		{
			$querystring = $_POST[$querystring];
			$querystring = preg_replace('/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/', '', $querystring);
			$querystring = trim($querystring);
			$querystring = strip_tags($querystring);
			$querystring = addslashes($querystring);
	
			return $querystring;
		}
	}
	
	function listBox($p_classe=null, 
					 $p_nome_select=null, 
					 $p_tabela=null, 
					 $p_campo=null, 
					 $p_value=null, 
					 $p_where=null, 
					 $p_orderby=null, 
					 $p_codificacao=null, 
					 $p_funcao=null)
	{
		#
		# p_classe -> classe para estilo
		# p_nome_select -> name e id do input
		# p_tabela -> nome da tabela a ser pesquisado 
		# p_campo -> nome do campo a ser mostrado no select para o usuario
		# p_value -> o valor do campo para sealed true a ser comparado
		# p_where -> condição da query
		# p_orderby -> ordenação
		# p_codificacao -> codificação -> utf8 para ajax
		# p_funcao -> função javascript
	
		$q = Doctrine_Query::Create()
				->from(ucfirst($p_tabela))
				->where($p_where)
				->orderby($p_orderby);
		$results = $q->execute();

		# funções javascript
		if(!empty($p_funcao))
		{
			$_funcao = 'onchange="'.$p_funcao.'"';
		}
		
		$_texto = '<select name="'.$p_nome_select.'" id="'.$p_nome_select.'" class="'.$p_classe.'" '.$_funcao.'>
			<option value="0"> Escolha um registro </option>' . "\n";

		foreach($results as $result)
		{	
			# verifica se a regisição é ajax -> utf8
			if($p_codificacao == 'utf8')
			{
				$texto_campo = utf8_encode($result->$p_campo);
			}
			else
			{
				$texto_campo = $result->$p_campo;
			}	
			
			$_texto .= '			<option value="'.$result->id.'" ';  if($p_value == $result->id) $_texto .= 'selected'; $_texto .= '> '.$texto_campo.' </option>' . "\r\n";
		}
		
		$_texto .= '</select>';
		
		return $_texto;
	}
	
	function select($p_tabela=null, $p_campos=null, $p_id=null)
	{
		$q = Doctrine_Query::Create()
				->select(ucfirst($p_campos))
				->from($p_tabela)
				->where('id = ?', $p_id);
		$results = $q->execute();
		
		return $results[0]->$p_campos;
	}
	
	function geraSenhaAdmin($p_senha)
	{
		$salt = 'FabricioLayenisDesenvolvimentoWeb';
		return  sha1($salt . $p_senha	);
	}
	
	function verificarPermissao($p_tabela_id=null)
	{
		session_start();

		$q = Doctrine_Query::Create()
				->select('permissao')
				->from('TabelasTipos')
				->where('tabela_id = ? and tipo_id = ?', array($p_tabela_id, $_SESSION['USUARIO_TIPO_ID']));
		$result = $q->execute();
		
		if($result[0]->permissao == 0)
		{
			setMensagem('Desculpe: Você não tem permissão na página que está tentando acessar!');
			header('Location: /home/index'); exit;
		}
		else
		{
			$_SESSION['USUARIO_GRAU_PERMISSAO'] = $result[0]->permissao;
		}
	}
	
	function verificaLogin()
	{
		session_start();
		
		if(empty($_SESSION['USUARIO_ID']))
		{
			header('Location: ' . URL . 'logins/index');
		}
	}
	
	function limparSessao()
	{
		unset($_SESSION['USUARIO_ID'], $_SESSION['USUARIO_NOME'], $_SESSION['USUARIO_ULTIMO_ACESSO'], $_SESSION['USUARIO_ACESSOS']);
	}
	
	function extenso( $valor ) 
	{
		$moedaSing = 'real';
		$moedaPlur = 'reais';
		$centSing = 'centavo';
		$centPlur = 'centavos';
		
		$centenas = array( 0,
		 array(0, "cento",        "cem"),
		 array(0, "duzentos",     "duzentos"),
		 array(0, "trezentos",    "trezentos"),
		 array(0, "quatrocentos", "quatrocentos"),
		 array(0, "quinhentos",   "quinhentos"),
		 array(0, "seiscentos",   "seiscentos"),
		 array(0, "setecentos",   "setecentos"),
		 array(0, "oitocentos",   "oitocentos"),
		 array(0, "novecentos",   "novecentos") ) ;

		$dezenas = array( 0,
			  "dez",
			  "vinte",
			  "trinta",
			  "quarenta",
			  "cinquenta",
			  "sessenta",
			  "setenta",
			  "oitenta",
			  "noventa" ) ;

		$unidades = array( 0,
			  "um",
			  "dois",
			  "três",
			  "quatro",
			  "cinco",
			  "seis",
			  "sete",
			  "oito",
			  "nove" ) ;

		$excecoes = array( 0,
			  "onze",
			  "doze",
			  "treze",
			  "quatorze",
			  "quinze",
			  "dezeseis",
			  "dezesete",
			  "dezoito",
			  "dezenove" ) ;

		$extensoes = array( 0,
		 array(0, "",       ""),
		 array(0, "mil",    "mil"),
		 array(0, "milhão", "milhões"),
		 array(0, "bilhão", "bilhões"),
		 array(0, "trilhão","trilhões") ) ;

		$valorForm = trim( number_format($valor,2,".",",") ) ;

		$inicio    = 0 ;

		if ( $valor <= 0 ) {
		return ( $valorExt ) ;
		}

		for ( $conta = 0; $conta <= strlen($valorForm)-1; $conta++ ) {
		if ( strstr(",.",substr($valorForm, $conta, 1)) ) {
		   $partes[] = str_pad(substr($valorForm, $inicio, $conta-$inicio),3," ",STR_PAD_LEFT) ;
		   if ( substr($valorForm, $conta, 1 ) == "." ) {
			  break ;
		   }
		   $inicio = $conta + 1 ;
		}
		}

		$centavos = substr($valorForm, strlen($valorForm)-2, 2) ;

		if ( !( count($partes) == 1 and intval($partes[0]) == 0 ) ) {
		for ( $conta=0; $conta <= count($partes)-1; $conta++ ) {

		   $centena = intval(substr($partes[$conta], 0, 1)) ;
		   $dezena  = intval(substr($partes[$conta], 1, 1)) ;
		   $unidade = intval(substr($partes[$conta], 2, 1)) ;

		   if ( $centena > 0 ) {

			  $valorExt .= $centenas[$centena][($dezena+$unidade>0 ? 1 : 2)] . ( $dezena+$unidade>0 ? " e " : "" ) ;
		   }

		   if ( $dezena > 0 ) {
			  if ( $dezena>1 ) {
				 $valorExt .= $dezenas[$dezena] . ( $unidade>0 ? " e " : "" ) ;

			  } elseif ( $dezena == 1 and $unidade == 0 ) {
				 $valorExt .= $dezenas[$dezena] ;

			  } else {
				 $valorExt .= $excecoes[$unidade] ;
			  }

		   }

		   if ( $unidade > 0 and $dezena != 1 ) {
			  $valorExt .= $unidades[$unidade] ;
		   }

		   if ( intval($partes[$conta]) > 0 ) {
			  $valorExt .= " " . $extensoes[(count($partes)-1)-$conta+1][(intval($partes[$conta])>1 ? 2 : 1)] ;
		   }

		   if ( (count($partes)-1) > $conta and intval($partes[$conta])>0 ) {
			  $conta3 = 0 ;
			  for ( $conta2 = $conta+1; $conta2 <= count($partes)-1; $conta2++ ) {
				 $conta3 += (intval($partes[$conta2])>0 ? 1 : 0) ;
			  }

			  if ( $conta3 == 1 and intval($centavos) == 0 ) {
				 $valorExt .= " e " ;
			  } elseif ( $conta3>=1 ) {
				 $valorExt .= ", " ;
			  }
		   }

		}

		if ( count($partes) == 1 and intval($partes[0]) == 1 ) {
		   $valorExt .= $moedaSing ;

		} elseif ( count($partes)>=3 and ((intval($partes[count($partes)-1]) + intval($partes[count($partes)-2]))==0) ) {
		   $valorExt .= " de " + $moedaPlur ;

		} else {
		   $valorExt = trim($valorExt) . " " . $moedaPlur ;
		}

		}

		if ( intval($centavos) > 0 ) {

		$valorExt .= (!empty($valorExt) ? " e " : "") ;

		$dezena  = intval(substr($centavos, 0, 1)) ;
		$unidade = intval(substr($centavos, 1, 1)) ;

		if ( $dezena > 0 ) {
		   if ( $dezena>1 ) {
			  $valorExt .= $dezenas[$dezena] . ( $unidade>0 ? " e " : "" ) ;

		   } elseif ( $dezena == 1 and $unidade == 0 ) {
			  $valorExt .= $dezenas[$dezena] ;

		   } else {
			  $valorExt .= $excecoes[$unidade] ;
		   }

		}

		if ( $unidade > 0 and $dezena != 1 ) {
		   $valorExt .= $unidades[$unidade] ;
		}

		$valorExt .= " " . ( intval($centavos)>1 ? $centPlur : $centSing ) ;

		}

		return ( $valorExt ) ;

	}
	
	function moeda($valor)
	{
		return number_format($valor,2,",",".");	
	}	
?>