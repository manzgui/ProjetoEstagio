<?php
	class CEducando{	
		private $model;
		
		public function CEducando($model = NULL){
			if(!empty($model))
				$this->model = $model;
			else
				$this->model = new MEducando();
		}
		
		public function getEducandosCbb()
		{
			$dados = array();
			foreach((array)$this->model->getEducandosCbb() as $item)
			{
				$educ =  new MEducando();
                $educ->setCod($item['edu_cod']);
                $educ->setNome($item['edu_nome']);
                $educ->setDatanascimento($item['edu_dtnasc']);
                $educ->setRg($item['edu_rg']);
                $educ->setNomemae($item['edu_nomemae']);
                $educ->setFixo($item['edu_telefonefixo']);
                $educ->setCelular($item['edu_telefonecelular']);
                $educ->setRua($item['edu_rua']);
                $educ->setNumero($item['edu_numero']);
                $educ->setBairro($item['edu_bairro']);
				$educ->setComplemento($item['edu_complemento']);
				$educ->setEstado($item['estado']);
                $educ->setCidade($item['cidade']);
				array_push($dados, $educ);
			}
			return $dados;
		}

		public function getEducandosGrid($filtro, &$retorno)
		{
			$retorno = array();
			$dados = "";
			if($this->model->getEducandosGrid($filtro, $retorno))
			{
				if(!empty($retorno))
				{
					foreach($retorno as $item)
					{
						$obj = array(
							"cod" => $item['edu_cod'],
							"nome" => $item['edu_nome'],
							"dtnasc" => $item['edu_dtnasc'],
							"rg" => $item['edu_rg'],
							"nomemae" => $item['edu_nomemae'],
							"fixo" => $item['edu_telefonefixo'],
							"celular" => $item['edu_telefonecelular'],
							"rua" => $item['edu_rua'],
							"numero" => $item['edu_numero'],
							"bairro" => $item['edu_bairro'],
							"complemento" => $item['edu_complemento'],
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
        
		public function salvarEducando(&$dados, $login)
		{
			$msgRetorno = "";			
			if(empty($login))
				header('Location: ../login.php'); 
			else
      		if(empty($dados))
        		$msgRetorno = '(EdCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->salvarEducando($dados, $msgRetorno);
					
      		if(empty($msgRetorno))
				$msgRetorno = '(EdCError2): Erro 14.';
			if(empty($dados["condicao"]))
				$dados["condicao"] = false;
			$dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
		}

		public function atualizarEducando(&$dados, $login)
		{
			$msgRetorno = "";			
			if(empty($login))
				header('Location: ../login.php'); 
			else
      		if(empty($dados))
        		$msgRetorno = '(EdCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->atualizarEducando($dados, $msgRetorno);
					
      		if(empty($msgRetorno))
				$msgRetorno = '(EdCError2): Erro 14.';
			if(empty($dados["condicao"]))
				$dados["condicao"] = false;
			$dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
		}
    }

?>