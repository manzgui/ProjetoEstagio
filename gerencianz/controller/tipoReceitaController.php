<?php
	class CTipoReceita{	
		private $model;
		
		public function CTipoReceita($model = NULL){
			if(!empty($model))
				$this->model = $model;
			else
				$this->model = new MTipoReceita();
        }
        
        public function getSubtiposReceitaGrid($filtro, &$retorno)
		{
			$retorno = array();
			$dados = "";
			if($this->model->getSubtiposReceitaGrid($filtro, $retorno))
			{
				if(!empty($retorno))
				{
					foreach($retorno as $item)
					{
						$obj = array(
							"cod" => $item['sbrec_cod'],
							"subtipo" => $item['sbrec_descricao']
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
		
		public function getTiposReceitaGrid($filtro, &$retorno)
		{
			$retorno = array();
			$dados = "";
			if($this->model->getTiposReceitaGrid($filtro, $retorno))
			{
				if(!empty($retorno))
				{
					foreach($retorno as $item)
					{
						$obj = array(
							"cod" => $item['tprec_cod'],
							"descricao" => $item['tprec_descricao']
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
        
		public function salvarTipoReceita(&$dados, $login)
		{
            $msgRetorno = "";
			if(empty($login))
				header('Location: ../login.php'); 
			else
      		if(empty($dados))
        		$msgRetorno = '(RcCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->salvarTipoReceita($dados, $msgRetorno);					
      		if(empty($msgRetorno))
				$msgRetorno = '(RcCError2): Erro 14.';
			if(empty($dados["condicao"]))
                $dados["condicao"] = false;
            $dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
        }

        public function atualizarTipoReceita(&$dados, $login)
		{
            $msgRetorno = "";	
			if(empty($login))
				header('Location: ../login.php'); 
			else
      		if(empty($dados))
        		$msgRetorno = '(RcCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->atualizarTipoReceita($dados, $msgRetorno);					
      		if(empty($msgRetorno))
				$msgRetorno = '(RcCError2): Erro 14.';
			if(empty($dados["condicao"]))
                $dados["condicao"] = false;
            $dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
		}

        public function salvarSubtipoReceita(&$dados, $login)
        {
            $msgRetorno = "";
            $cont = 0;
            $retorno = array();
            $condicao = true;	
            foreach($dados['subtipos'] as $subtipo)
            {
				$arra_aux = array();
				$arra_aux = explode(";", $subtipo);
				$dadosSub = array(
					"cod" => $arra_aux[0],
					"transacao" => $arra_aux[1],
                    "descricao" => $arra_aux[2],
                    "codrec" => $arra_aux[3]
				);
                if($dadosSub["transacao"] == "I")
                    $dadosSub["condicao"] = $this->model->salvarSubtipoReceita($dadosSub, $msgRetorno);
                else
                    $dadosSub["condicao"] = $this->model->excluirSubtipoReceita($dadosSub, $msgRetorno);
				$dadosSub["mensagem"] = $msgRetorno;
				array_push($retorno, $dadosSub);
				$condicao = ($condicao && $dadosSub["condicao"]);
				$cont++;					
            }
            $dados = $retorno;
            $dados["condicao"] = $condicao;
			if($cont == 1)	
				$dados["retorno"] = $msgRetorno;
			else
			if($cont > 1)
				$dados["retorno"] = "Alterações salvas com sucesso!";
        }
    }

?>