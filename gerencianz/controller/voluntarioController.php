<?php
    class CVoluntario{	
		private $model;
		
		public function CVoluntario($model = NULL){
			if(!empty($model))
				$this->model = $model;
			else
				$this->model = new MVoluntario();
        }

		public function getVoluntariosCbb()
		{
			$dados = array();
			foreach((array)$this->model->getVoluntariosCbb() as $item)
			{
				$vol =  new MVoluntario();
                $vol->setCod($item['vol_cod']);
                $vol->setNome($item['vol_nome']);
                $vol->setDatanascimento($item['vol_dtnasc']);
                $vol->setCpf($item['vol_cpf']);
                $vol->setRg($item['vol_rg']);
                $vol->setProfissao($item['vol_profissao']);
                $vol->setFixo($item['vol_telefonefixo']);
                $vol->setCelular($item['vol_telefonecelular']);
                $vol->setDatainicio($item['vol_dtinicio']);
                $vol->setDatafim($item['vol_dtfim']);
                $vol->setRua($item['vol_rua']);
                $vol->setNumero($item['vol_numero']);
                $vol->setBairro($item['vol_bairro']);
                $vol->setComplemento($item['vol_complemento']);
                $vol->setEstado($item['estado']);
                $vol->setCidade($item['cidade']);
				array_push($dados, $vol);
			}
			return $dados;
        }

        public function getVoluntariosGrid($filtro, &$retorno)
		{
			$retorno = array();
			$dados = "";
			if($this->model->getVoluntariosGrid($filtro, $retorno))
			{
				if(!empty($retorno))
				{
					foreach($retorno as $item)
					{
						$obj = array(
							"cod" => $item['vol_cod'],
							"nome" => $item['vol_nome'],
							"cpf" => $item['vol_cpf'],
							"rg" => $item['vol_rg'],
							"profissao" => $item['vol_profissao'],
							"fixo" => $item['vol_telefonefixo'],
							"celular" => $item['vol_telefonecelular'],
							"rua" => $item['vol_rua'],
							"numero" => $item['vol_numero'],
							"bairro" => $item['vol_bairro'],
							"complemento" => $item['vol_complemento'],
							"estado" => $item['estado'],
                            "cidade" => $item['cidade'],
                            "nascimento" => $item['vol_dtnasc'],
							"inicio" => $item['vol_dtinicio'],
							"fim" => $item['vol_dtfim'],
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
    
        public function salvarVoluntario(&$dados, $login)
		{
			$msgRetorno = "";			
			if(empty($login))
				header('Location: ../login.php'); 
			else
      		if(empty($dados))
        		$msgRetorno = '(EdCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->salvarVoluntario($dados, $msgRetorno);
					
      		if(empty($msgRetorno))
				$msgRetorno = '(EdCError2): Erro 14.';
			if(empty($dados["condicao"]))
				$dados["condicao"] = false;
			$dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
        }
        
        public function atualizarVoluntario(&$dados, $login)
		{
			$msgRetorno = "";			
			if(empty($login))
				header('Location: ../login.php'); 
			else
      		if(empty($dados))
        		$msgRetorno = '(EdCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->atualizarVoluntario($dados, $msgRetorno);
					
      		if(empty($msgRetorno))
				$msgRetorno = '(EdCError2): Erro 14.';
			if(empty($dados["condicao"]))
				$dados["condicao"] = false;
			$dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
		}
    }

?>