<?php
    class CProfissional{	
		private $model;
		
		public function CProfissional($model = NULL){
			if(!empty($model))
				$this->model = $model;
			else
				$this->model = new MProfissional();
        }

		public function getProfissionaisCbb()
		{
			$dados = array();
			foreach((array)$this->model->getProfissionaisCbb() as $item)
			{
				$prof =  new MProfissional();
                $prof->setCod($item['pro_cod']);
                $prof->setNome($item['pro_nome']);
                $prof->setDatanascimento($item['pro_dtnasc']);
                $prof->setCpf($item['pro_cpf']);
                $prof->setRg($item['pro_rg']);
                $prof->setFuncao($item['pro_funcao']);
                $prof->setFixo($item['pro_telefonefixo']);
                $prof->setCelular($item['pro_telefonecelular']);
                $prof->setUsuario($item['pro_usuario']);
                $prof->setSenha($item['pro_senha']);
                $prof->setNivel($item['pro_nivel']);
                $prof->setDataadmissao($item['pro_dtadmissao']);
                $prof->setDatademissao($item['pro_dtdemissao']);
                $prof->setRua($item['pro_rua']);
                $prof->setNumero($item['pro_numero']);
                $prof->setBairro($item['pro_bairro']);
                $prof->setComplemento($item['pro_complemento']);
                $prof->setCidade($item['cidade']);
				array_push($dados, $prof);
			}
			return $dados;
        }

        public function getProfissionaisGrid($filtro, &$retorno)
		{
			$retorno = array();
			$dados = "";
			if($this->model->getProfissionaisGrid($filtro, $retorno))
			{
				if(!empty($retorno))
				{
					foreach($retorno as $item)
					{
						$obj = array(
							"cod" => $item['pro_cod'],
							"nome" => $item['pro_nome'],
							"cpf" => $item['pro_cpf'],
							"rg" => $item['pro_rg'],
							"funcao" => $item['pro_funcao'],
							"fixo" => $item['pro_telefonefixo'],
							"celular" => $item['pro_telefonecelular'],
							"rua" => $item['pro_rua'],
							"numero" => $item['pro_numero'],
							"bairro" => $item['pro_bairro'],
							"complemento" => $item['pro_complemento'],
							"estado" => $item['estado'],
                            "cidade" => $item['cidade'],
                            "nascimento" => $item['pro_dtnasc'],
							"admissao" => $item['pro_dtadmissao'],
                            "demissao" => $item['pro_dtdemissao'],
                            "usuario" => $item['pro_usuario'],
							"senha" => $item['pro_senha'],
							"nivel" => $item['pro_nivel'],
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
        
        public function salvarProfissional(&$dados, $login)
		{
			$msgRetorno = "";			
			if(empty($login))
				header('Location: ../login.php'); 
			else
      		if(empty($dados))
        		$msgRetorno = '(EdCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->salvarProfissional($dados, $msgRetorno);
					
      		if(empty($msgRetorno))
				$msgRetorno = '(EdCError2): Erro 14.';
			if(empty($dados["condicao"]))
				$dados["condicao"] = false;
			$dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
        }
        
        public function atualizarProfissional(&$dados, $login)
		{
			$msgRetorno = "";			
			if(empty($login))
				header('Location: ../login.php'); 
			else
      		if(empty($dados))
        		$msgRetorno = '(EdCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->atualizarProfissional($dados, $msgRetorno);
					
      		if(empty($msgRetorno))
				$msgRetorno = '(EdCError2): Erro 14.';
			if(empty($dados["condicao"]))
				$dados["condicao"] = false;
			$dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
		}
    }

?>