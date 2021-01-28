<?php
	class CTipoAtividade{	
		private $model;
		
		public function CTipoAtividade($model = NULL){
			if(!empty($model))
				$this->model = $model;
			else
				$this->model = new MTipoAtividade();
		}
		
		public function getTiposAtividadeCbb()
		{
			$dados = array();
			foreach((array)$this->model->getTiposAtividadeCbb() as $item)
			{
				$educ =  new MTipoAtividade();
                $educ->setCod($item['ati_cod']);
                $educ->setDescricao($item['ati_descricao']);
                $educ->setProfessor($item['pro_cod']);
                $educ->setStatus($item['ati_status']);
				array_push($dados, $educ);
			}
			return $dados;
		}

		public function getTiposAtividadeGrid($filtro, &$retorno)
		{
			$retorno = array();
			$dados = "";
			if($this->model->getTiposAtividadeGrid($filtro, $retorno))
			{
				if(!empty($retorno))
				{
					foreach($retorno as $item)
					{
						$obj = array(
							"cod" => $item['ati_cod'],
							"descricao" => $item['ati_descricao'],
							"professorcod" => $item['pro_cod'],
							"status" => $item['ati_status'],
							"professor" => $item['pro_nome']
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
        
		public function salvarTipoAtividade(&$dados, $login)
		{
			$msgRetorno = "";			
			if(empty($login))
				header('Location: ../login.php'); 
			else
      		if(empty($dados))
        		$msgRetorno = '(EdCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->salvarTipoAtividade($dados, $msgRetorno);	
      		if(empty($msgRetorno))
				$msgRetorno = '(EdCError2): Erro 14.';
			if(empty($dados["condicao"]))
				$dados["condicao"] = false;
			$dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
		}

		public function atualizarTipoAtividade(&$dados, $login)
		{
			$msgRetorno = "";			
			if(empty($login))
				header('Location: ../login.php'); 
			else
      		if(empty($dados))
        		$msgRetorno = '(EdCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->atualizarTipoAtividade($dados, $msgRetorno);
					
      		if(empty($msgRetorno))
				$msgRetorno = '(EdCError2): Erro 14.';
			if(empty($dados["condicao"]))
				$dados["condicao"] = false;
			$dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
		}
    }

?>