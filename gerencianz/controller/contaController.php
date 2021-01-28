<?php
	class CConta{	
		private $model;
		
		public function CConta($model = NULL){
			if(!empty($model))
				$this->model = $model;
			else
				$this->model = new MConta();
		}
		
		public function getContasCbb()
		{
			$dados = array();
			foreach((array)$this->model->getContasCbb() as $item)
			{
				$conta =  new MConta();
                $conta->setCod($item['con_cod']);
                $conta->setDescricao($item['con_descricao']);
                $conta->setSaldo($item['con_saldototal']);
				array_push($dados, $conta);
			}
			return $dados;
		}

		public function getContasGrid($filtro, &$retorno)
		{
			$retorno = array();
			$dados = "";
			if($this->model->getContasGrid($filtro, $retorno))
			{
				if(!empty($retorno))
				{
					foreach($retorno as $item)
					{
						$obj = array(
							"cod" => $item['con_cod'],
							"descricao" => $item['con_descricao'],
							"saldo" => $item['con_saldototal']
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
        
		public function salvarConta(&$dados, $login)
		{
			$msgRetorno = "";			
			if(empty($login))
				header('Location: ../login.php'); 
			else
      		if(empty($dados))
        		$msgRetorno = '(CtCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->salvarConta($dados, $msgRetorno);	
      		if(empty($msgRetorno))
				$msgRetorno = '(CtCError2): Erro 14.';
			if(empty($dados["condicao"]))
				$dados["condicao"] = false;
			$dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
		}

		public function atualizarConta(&$dados, $login)
		{
			$msgRetorno = "";			
			if(empty($login))
				header('Location: ../login.php'); 
			else
      		if(empty($dados))
        		$msgRetorno = '(CtCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->atualizarConta($dados, $msgRetorno);					
      		if(empty($msgRetorno))
				$msgRetorno = '(CtCError2): Erro 14.';
			if(empty($dados["condicao"]))
				$dados["condicao"] = false;
			$dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
		}
    }

?>