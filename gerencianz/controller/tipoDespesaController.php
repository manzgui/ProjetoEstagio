<?php
	class CTipoDespesa{	
		private $model;
		
		public function CTipoDespesa($model = NULL){
			if(!empty($model))
				$this->model = $model;
			else
				$this->model = new MTipoDespesa();
		}
		
		public function getSubtiposDespesaGrid($filtro, &$retorno)
		{
			$retorno = array();
			$dados = "";
			if($this->model->getSubtiposDespesaGrid($filtro, $retorno))
			{
				if(!empty($retorno))
				{
					foreach($retorno as $item)
					{
						$obj = array(
							"cod" => $item['sbdesp_cod'],
							"subtipo" => $item['sbdesp_descricao']
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
		
		public function getTiposDespesaGrid($filtro, &$retorno)
		{
			$retorno = array();
			$dados = "";
			if($this->model->getTiposDespesaGrid($filtro, $retorno))
			{
				if(!empty($retorno))
				{
					foreach($retorno as $item)
					{
						$obj = array(
							"cod" => $item['tpdesp_cod'],
							"descricao" => $item['tpdesp_descricao']
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
        
		public function salvarTipoDespesa(&$dados, $login)
		{
			$msgRetorno = "";			
			if(empty($login))
				header('Location: ../login.php'); 
			else
      		if(empty($dados))
        		$msgRetorno = '(DpCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->salvarTipoDespesa($dados, $msgRetorno);		
      		if(empty($msgRetorno))
				$msgRetorno = '(DpCError2): Erro 14.';
			if(empty($dados["condicao"]))
				$dados["condicao"] = false;
			$dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
        }
        
        public function atualizarTipoDespesa(&$dados, $login)
		{
            $msgRetorno = "";	
			if(empty($login))
				header('Location: ../login.php'); 
			else
      		if(empty($dados))
        		$msgRetorno = '(DpCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->atualizarTipoDespesa($dados, $msgRetorno);					
      		if(empty($msgRetorno))
				$msgRetorno = '(DpCError2): Erro 14.';
			if(empty($dados["condicao"]))
                $dados["condicao"] = false;
            $dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
        }
        
        public function salvarSubtipoDespesa(&$dados, $login)
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
                    "coddesp" => $arra_aux[3]
				);
                if($dadosSub["transacao"] == "I")
                    $dadosSub["condicao"] = $this->model->salvarSubtipoDespesa($dadosSub, $msgRetorno);
                else
                    $dadosSub["condicao"] = $this->model->excluirSubtipoDespesa($dadosSub, $msgRetorno);
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