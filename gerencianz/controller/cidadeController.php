<?php

	class CCidade{
		private $model;
		
		public function CCidade($model = NULL){
			if(!empty($model))
				$this->model = $model;
			else
				$this->model = new MCidade();
        }

        public function getCidades($estado, &$retorno)
		{
			$retorno = array();
			$dados = "";
			if($this->model->getCidades($estado, $retorno))
			{
				if(!empty($retorno))
				{
					foreach($retorno as $item)
					{
						$obj = array(
							"id" => $item['id'],
							"nome" => $item['nome']
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
  }

?>