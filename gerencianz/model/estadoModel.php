<?php
    $conn = Banco::getConexao();

    class MEstado
    {
        private $id;
        private $uf;
        private $nome;

        //GET e SET
        public function getId(){return $this->id;}
        public function setId($id){$this->id = $id;}
        public function getUf(){return $this->uf;}
        public function setUf($uf){$this->uf = $uf;}
        public function getNome(){return $this->nome;}
        public function setNome($nome){$this->nome = $nome;}
        
        public function MEstado($id = 0, $uf = '', $nome = ''){
			$this->id = $id;
			$this->uf = $uf;
			$this->nome = $nome;		
        }
        
        public function getEstados(){
			if($GLOBALS['conn']){
				$sql = 'SELECT ID, NOME, UF FROM ESTADO';
				$consulta = $GLOBALS['conn']->prepare($sql);
				$consulta->execute();
				return $consulta->fetchAll();
			}return NULL;
		}
    }


?>