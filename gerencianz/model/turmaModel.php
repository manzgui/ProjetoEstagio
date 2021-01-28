<?php
	$conn = Banco::getConexao();
	
    class MTurma
    {
        private $cod;
        private $descricao;
        private $periodo;
        private $dataCriacao;
        private $dataFechamento;

        //GET
        public function getCod(){return $this->cod;}
        public function getDescricao(){return $this->descricao;}
        public function getPeriodo(){return $this->periodo;}
        public function getDatacriacao(){return $this->dataCriacao;}
        public function getDatafechamento(){return $this->dataFechamento;}

        //SET
        public function setCod($cod){$this->cod = $cod;}
        public function setDescricao($descricao){$this->descricao = $descricao;}
        public function setPeriodo($periodo){$this->periodo = $periodo;}
        public function setDatacriacao($dataCriacao){$this->dataCriacao = $dataCriacao;}
        public function setDatafechamento($dataFechamento){$this->dataFechamento = $dataFechamento;}

        public function MTurma($cod = 0, $descricao = '', $periodo = '', $dataCriacao = '', $dataFechamento = ''){
			$this->cod = $cod;
			$this->descricao = $descricao;
			$this->periodo = $periodo;
            $this->dataCriacao = $dataCriacao;
            $this->dataFechamento = $dataFechamento;		
        }

        public function getTurmasCbb(){
			if($GLOBALS['conn']){
				$sql = 'select tur_cod, tur_descricao, tur_periodo, tur_dtcriacao, tur_dtfechamento from turma order by tur_descricao';
				$consulta = $GLOBALS['conn']->prepare($sql);
				$consulta->execute();
				return $consulta->fetchAll();
			}return NULL;
		}

		public function getTurmasGrid($filtro, &$retorno)
        {
			try{
				$sql = 'select tur_cod, tur_descricao, tur_periodo, tur_dtcriacao, tur_dtfechamento from turma where upper(tur_descricao) like upper(\'%'.$filtro.'%\') order by tur_descricao';
				$consulta = $GLOBALS['conn']->prepare($sql);
				$consulta->execute();
				$retorno = $consulta->fetchAll();
				return true;
			}catch(Exception $erro){
				echo "Erro ao buscar turmas. ".$erro->getMessage();
			}
			return false;
		}
        
        public function salvarTurma(&$dados, &$retorno){
			if($GLOBALS['conn']){
				try{
					$sql = 'insert into turma (tur_descricao, tur_periodo, tur_dtcriacao, tur_dtfechamento) values (?,?,?,?)';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['descricao'], PDO::PARAM_STR);
					$statement->bindParam(2, $dados['periodo'], PDO::PARAM_STR);
					$statement->bindParam(3, $dados['datacriacao'], PDO::PARAM_STR);
					$statement->bindParam(4, $dados['datafechamento'], PDO::PARAM_STR);
                    $salvou = $statement->execute(); 
                    if($salvou)
                    {
                        $retorno = 'Operação realizada com sucesso!';
                        return true;
                    }				
				}catch(PDOException $erro){
					$retorno = '(TMErro): Erro: '.$erro->getMessage();				
                }
            }
            return false;
		}
		
		public function atualizarTurma(&$dados, &$retorno){
			if($GLOBALS['conn']){
				try{
					$sql = 'update turma set tur_descricao = ?, tur_periodo = ?, tur_dtcriacao = ?, tur_dtfechamento = ? where tur_cod = ?';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['descricao'], PDO::PARAM_STR);
					$statement->bindParam(2, $dados['periodo'], PDO::PARAM_STR);
					$statement->bindParam(3, $dados['datacriacao'], PDO::PARAM_STR);
					$statement->bindParam(4, $dados['datafechamento'], PDO::PARAM_STR);
					$statement->bindParam(5, $dados['cod'], PDO::PARAM_INT);
                    $salvou = $statement->execute(); 
                    if($salvou)
                    {
                        $retorno = 'Alteração realizada com sucesso!';
                        return true;
                    }				
				}catch(PDOException $erro){
					$retorno = '(TMErro): Erro: '.$erro->getMessage();				
                }
            }
            return false;
        }
    }
?>