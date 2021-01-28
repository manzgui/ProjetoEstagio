<?php
	class CLogin{
		private $model;
		
		public function CLogin($model = NULL){
			if(!empty($model))
				$this->model = $model;
			else
				$this->model = new MLogin();
		}
		
		public function defineLogin($login, $senha){
			$this->model->setLogin($login);
			$this->model->setSenha($senha);
		}
		
		public function autentica(&$nome, &$empresa, &$codfunc){
			if($this->model->autentica($nome))
			{
                $codfunc = $this->model->getCodfunc();
                $nome = $this->model->getNome();
                $empresa = $this->model->getEmpresa();
				return true;
			}
			return false;
		}
	}
?>