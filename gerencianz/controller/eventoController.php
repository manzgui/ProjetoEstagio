<?php
	class CEvento{	
		private $model;
		
		public function CEvento($model = NULL){
			if(!empty($model))
				$this->model = $model;
			else
				$this->model = new MEvento();
    	}
        
		public function salvarEvento(&$dados, $login)
		{
			$msgRetorno = "";
			$codigo = 0;			
			if(empty($login))
				header('Location: ../login.php'); 
			else
            if(empty($dados))
                $msgRetorno = '(EvCError1): É necessário preencher dados.';
			else
				$dados["condicao"] = $this->model->salvarEvento($dados, $msgRetorno);
				
            if(empty($msgRetorno))
				$msgRetorno = '(EvCError2): Erro 14.';
			if(empty($dados["condicao"]))
				$dados["condicao"] = false;
			$dados["retorno"] = $msgRetorno;
			return $dados["condicao"];
		}
    }

?>