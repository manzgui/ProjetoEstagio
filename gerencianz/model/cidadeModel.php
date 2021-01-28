<?php
    $conn = Banco::getConexao();
    
    class MCidade
    {
        private $id;
        private $nome;
        private $estado;

        public function MCidade($id = 0, $nome = '', $estado = 0)
        {
            $this->id = $id;
            $this->nome = $nome;
            $this->estado = $estado;
        }

        //GET
        public function getId(){return $this->id;}
        public function getNome(){return $this->nome;}
        public function getEstado(){return $this->estado;}
        //SET
        public function setId($id){$this->id = $id;}
        public function setNome($nome){$this->nome = $nome;}
        public function setEstado($estado){$this->estado = $estado;}

        public function getCidades($estado, &$retorno)
		{
			try
			{
				$sql = 'select id, nome from cidade where estado = :estado';
				$consulta = $GLOBALS['conn']->prepare($sql);
				$consulta->bindParam(':estado', $estado, PDO::PARAM_INT);
				$consulta->execute();
				$retorno = $consulta->fetchAll();
				return true;
			}catch(Exception $erro){
				echo "Erro ao buscar cidades do estado. ".$erro->getMessage();
			}
			return false;
		}
    }