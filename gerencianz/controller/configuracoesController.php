<?php
	class CConfiguracoes{	
		private $model;
		
		public function CConfiguracoes($model = NULL){
			if(!empty($model))
				$this->model = $model;
			else
				$this->model = new MConfiguracoes();
		}

		public function getParametrizacaoGrid(&$retorno)
		{
			$retorno = array();
			$dados = "";
			if($this->model->getParametrizacaoGrid($retorno))
			{
				if(!empty($retorno))
				{
					foreach($retorno as $item)
					{
						$obj = array(
							"cod" => $item['par_cod'],
							"razao" => $item['par_razao'],
							"fantasia" => $item['par_fantasia'],
							"cnpj" => $item['par_cnpj'],
							"inscricao" => $item['par_inscricaoestadual'],
							"fixo" => $item['par_telefonefixo'],
							"celular" => $item['par_telefonecelular'],
							"rua" => $item['par_rua'],
							"numero" => $item['par_numero'],
							"bairro" => $item['par_bairro'],
							"complemento" => $item['par_complemento'],
							"estado" => $item['estado'],
							"cidade" => $item['cidade']
						);
						if(empty($dados))
							$dados .= "[".json_encode($obj);
						else
							$dados .= ",".json_encode($obj);
					}
					$dados .= "]";
					$retorno = $dados;
					return true;
				}
            }
            $retorno = "{}";
            return false;
		}
        
		public function salvarParametrizacao(&$dados, $login)
		{
			$msgRetorno = "";			
			if(empty($login))
				header('Location: ../login.php'); 
			else
      		if(empty($dados))
        		$msgRetorno = '(PrCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->salvarParametrizacao($dados, $msgRetorno);					
      		if(empty($msgRetorno))
				$msgRetorno = '(PrCError2): Erro 14.';
			if(empty($dados["condicao"]))
				$dados["condicao"] = false;
			$dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
		}

		public function atualizarParametrizacao(&$dados, $login)
		{
			$msgRetorno = "";			
			if(empty($login))
				header('Location: ../login.php'); 
			else
      		if(empty($dados))
        		$msgRetorno = '(PrCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->atualizarParametrizacao($dados, $msgRetorno);					
      		if(empty($msgRetorno))
				$msgRetorno = '(PrCError2): Erro 14.';
			if(empty($dados["condicao"]))
				$dados["condicao"] = false;
			$dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
		}
    }

?>