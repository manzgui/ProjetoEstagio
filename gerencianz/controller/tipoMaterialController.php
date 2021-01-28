<?php
	class CTipoMaterial{	
		private $model;
		
		public function CTipoMaterial($model = NULL){
			if(!empty($model))
				$this->model = $model;
			else
				$this->model = new MTipoMaterial();
		}
		
		public function getTiposMaterialCbb()
		{
			$dados = array();
			foreach((array)$this->model->getTiposMaterialCbb() as $item)
			{
				$mat =  new MTipoMaterial();
                $mat->setCod($item['mat_cod']);
                $mat->setDescricao($item['mat_descricao']);
                $mat->setEstoque($item['mat_estoque']);
                $mat->setUnidade($item['mat_unidade']);
				array_push($dados, $mat);
			}
			return $dados;
		}

		public function getTiposMaterialGrid($filtro, &$retorno)
		{
			$retorno = array();
			$dados = "";
			if($this->model->getTiposMaterialGrid($filtro, $retorno))
			{
				if(!empty($retorno))
				{
					foreach($retorno as $item)
					{
						$obj = array(
							"cod" => $item['mat_cod'],
							"descricao" => $item['mat_descricao'],
							"estoque" => $item['mat_estoque'],
							"unidade" => $item['mat_unidade']
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
        
		public function salvarTipoMaterial(&$dados, $login)
		{
			$msgRetorno = "";			
			if(empty($login))
				header('Location: ../login.php'); 
			else
      		if(empty($dados))
        		$msgRetorno = '(EdCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->salvarTipoMaterial($dados, $msgRetorno);
					
      		if(empty($msgRetorno))
				$msgRetorno = '(EdCError2): Erro 14.';
			if(empty($dados["condicao"]))
				$dados["condicao"] = false;
			$dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
		}

		public function atualizarTipoMaterial(&$dados, $login)
		{
			$msgRetorno = "";			
			if(empty($login))
				header('Location: ../login.php'); 
			else
      		if(empty($dados))
        		$msgRetorno = '(EdCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->atualizarTipoMaterial($dados, $msgRetorno);
					
      		if(empty($msgRetorno))
				$msgRetorno = '(EdCError2): Erro 14.';
			if(empty($dados["condicao"]))
				$dados["condicao"] = false;
			$dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
		}
    }

?>