<?php
	class CTurma{	
		private $model;
		
		public function CTurma($model = NULL){
			if(!empty($model))
				$this->model = $model;
			else
				$this->model = new MTurma();
		}
		
		public function getTurmasCbb()
		{
			$dados = array();
			foreach((array)$this->model->getTurmasCbb() as $item)
			{
				$educ =  new MTurma();
                $educ->setCod($item['tur_cod']);
                $educ->setDescricao($item['tur_descricao']);
                $educ->setPeriodo($item['tur_periodo']);
                $educ->setDatacriacao($item['tur_dtcriacao']);
                $educ->setDatafechamento($item['tur_dtfechamento']);
				array_push($dados, $educ);
			}
			return $dados;
		}

		public function getTurmasGrid($filtro, &$retorno)
		{
			$retorno = array();
			$dados = "";
			if($this->model->getTurmasGrid($filtro, $retorno))
			{
				if(!empty($retorno))
				{
					foreach($retorno as $item)
					{
						$obj = array(
							"cod" => $item['tur_cod'],
							"descricao" => $item['tur_descricao'],
							"periodo" => $item['tur_periodo'],
							"criacao" => $item['tur_dtcriacao'],
							"fechamento" => $item['tur_dtfechamento']
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
        
		public function salvarTurma(&$dados, $login)
		{
			$msgRetorno = "";			
			if(empty($login))
				header('Location: ../login.php'); 
			else
      		if(empty($dados))
        		$msgRetorno = '(EdCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->salvarTurma($dados, $msgRetorno);
      		if(empty($msgRetorno))
				$msgRetorno = '(EdCError2): Erro 14.';
			if(empty($dados["condicao"]))
				$dados["condicao"] = false;
			$dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
		}

		public function atualizarTurma(&$dados, $login)
		{
			$msgRetorno = "";			
			if(empty($login))
				header('Location: ../login.php'); 
			else
      		if(empty($dados))
        		$msgRetorno = '(EdCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->atualizarTurma($dados, $msgRetorno);
					
      		if(empty($msgRetorno))
				$msgRetorno = '(EdCError2): Erro 14.';
			if(empty($dados["condicao"]))
				$dados["condicao"] = false;
			$dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
		}
    }

?>