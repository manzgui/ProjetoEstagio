<?php
	class CTipoVerba{	
		private $model;
		
		public function CTipoVerba($model = NULL){
			if(!empty($model))
				$this->model = $model;
			else
				$this->model = new MTipoVerba();
		}
		
		public function getTiposVerbaGrid($filtro, &$retorno)
		{
			$retorno = array();
			$dados = "";
			if($this->model->getTiposVerbaGrid($filtro, $retorno))
			{
				if(!empty($retorno))
				{
					foreach($retorno as $item)
					{
						$obj = array(
							"cod" => $item['ver_cod'],
							"descricao" => $item['ver_descricao']
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
        
		public function salvarTipoVerba(&$dados, $login)
		{
			$msgRetorno = "";			
			if(empty($login))
				header('Location: ../login.php'); 
			else
      		if(empty($dados))
        		$msgRetorno = '(VbCErro1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->salvarTipoVerba($dados, $msgRetorno);					
      		if(empty($msgRetorno))
				$msgRetorno = '(VbCErro2): Erro 14.';
			if(empty($dados["condicao"]))
				$dados["condicao"] = false;
			$dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
        }
        
        public function atualizarTipoVerba(&$dados, $login)
		{
			$msgRetorno = "";			
			if(empty($login))
				header('Location: ../login.php'); 
			else
      		if(empty($dados))
        		$msgRetorno = '(VbCErro1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->atualizarTipoVerba($dados, $msgRetorno);					
      		if(empty($msgRetorno))
				$msgRetorno = '(VbCErro2): Erro 14.';
			if(empty($dados["condicao"]))
				$dados["condicao"] = false;
			$dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
		}
    }

?>