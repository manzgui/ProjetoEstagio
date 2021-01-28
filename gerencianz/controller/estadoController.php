<?php
    class CEstado{	
		private $model;
		
		public function CEstado($model = NULL){
			if(!empty($model))
				$this->model = $model;
			else
				$this->model = new MEstado();
        }

        public function getEstados(){
			$dados = array();
			foreach((array)$this->model->getEstados() as $item)
			{
				$estado =  new MEstado();
                $estado->setId($item['ID']);
                $estado->setUf($item['UF']);
                $estado->setNome($item['NOME']);
				array_push($dados, $estado);
			}
			return $dados;
		}
    }

?>