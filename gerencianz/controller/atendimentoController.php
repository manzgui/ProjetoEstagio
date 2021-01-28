<?php
	class CAtendimento{	
		private $model;
		
		public function CAtendimento($model = NULL){
			if(!empty($model))
				$this->model = $model;
			else
				$this->model = new MAtendimento();
        }

        public function getAtendimentosGrid($filtro, &$retorno)
		{
			$retorno = array();
			$dados = "";
			if($this->model->getAtendimentosGrid($filtro, $retorno))
			{
				if(!empty($retorno))
				{
					foreach($retorno as $item)
					{
						$obj = array(
                            "cod" => $item['ate_cod'],
							"data" => $item['ate_data'],
							"inicio" => $item['ate_horainicial'],
							"fim" => $item['ate_horafinal'],
							"relatorio" => $item['ate_relatorio'],
							"profissionalcod" => $item['pro_cod'],
							"profissional" => $item['pro_nome'],
							"educandocod" => $item['edu_cod'],
							"educando" => $item['edu_nome']
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
        
		public function salvarAtendimento(&$dados, $login)
		{
			$msgRetorno = "";			
			if(empty($login))
				header('Location: ../login.php'); 
			else
            if(empty($dados))
                $msgRetorno = '(AtCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->salvarAtendimento($dados, $msgRetorno);
					
            if(empty($msgRetorno))
				$msgRetorno = '(AtCError2): Erro 14.';
			if(empty($dados["condicao"]))
				$dados["condicao"] = false;
			$dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
        }
        
        public function atualizarAtendimento(&$dados, $login)
		{
			$msgRetorno = "";			
			if(empty($login))
				header('Location: ../login.php'); 
			else
            if(empty($dados))
                $msgRetorno = '(AtCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->atualizarAtendimento($dados, $msgRetorno);
					
            if(empty($msgRetorno))
				$msgRetorno = '(AtCError2): Erro 14.';
			if(empty($dados["condicao"]))
				$dados["condicao"] = false;
			$dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
		}
    }

?>