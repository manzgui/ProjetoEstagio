<?php
	$conn = Banco::getConexao();
	
    class MTipoAtividade
    {
        private $cod;
        private $descricao;
        private $professor;
        private $status;

        //GET
        public function getCod(){return $this->cod;}
        public function getDescricao(){return $this->descricao;}
        public function getProfessor(){return $this->professor;}
        public function getStatus(){return $this->status;}
        //SET
        public function setCod($cod){$this->cod = $cod;}
        public function setDescricao($descricao){$this->descricao = $descricao;}
        public function setProfessor($professor){$this->professor = $professor;}
        public function setStatus($status){$this->status = $status;}

        public function MTipoAtividade($cod = 0, $descricao = '', $professor = 0, $status = ''){
			$this->cod = $cod;
			$this->descricao = $descricao;
			$this->professor = $professor;
			$this->status = $status;			
        }

        public function getTiposAtividadeCbb(){
			if($GLOBALS['conn']){
				$sql = 'select a.ati_cod, a.ati_descricao, a.ati_status, a.pro_cod, p.pro_nome from tiposatividade a inner join profissional p on a.pro_cod = p.pro_cod order by a.ati_descricao';
				$consulta = $GLOBALS['conn']->prepare($sql);
				$consulta->execute();
				return $consulta->fetchAll();
			}return NULL;
		}

        public function getTiposAtividadeGrid($filtro, &$retorno)
        {
			try{
				$sql = 'select a.ati_cod, a.ati_descricao, a.ati_status, a.pro_cod, p.pro_nome from tiposatividade a inner join profissional p on a.pro_cod = p.pro_cod where upper(a.ati_descricao) like upper(\'%'.$filtro.'%\') order by a.ati_descricao';
				$consulta = $GLOBALS['conn']->prepare($sql);
				$consulta->execute();
				$retorno = $consulta->fetchAll();
				return true;
			}catch(Exception $erro){
				echo "Erro ao buscar atividades. ".$erro->getMessage();
			}
			return false;
		}
        
		public function salvarTipoAtividade(&$dados, &$retorno)
		{
			if($GLOBALS['conn']){
				try{
					$sql = 'insert into tiposatividade (ati_descricao, ati_status, pro_cod) values (?,?,?)';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['descricao'], PDO::PARAM_STR);
					$statement->bindParam(2, $dados['status'], PDO::PARAM_STR);
					$statement->bindParam(3, $dados['professor'], PDO::PARAM_INT);
                    $salvou = $statement->execute(); 
                    if($salvou)
                    {
                        $retorno = 'Operação realizada com sucesso!';
                        return true;
                    }				
				}catch(PDOException $erro){
					$retorno = '(EdMErro): Erro: '.$erro->getMessage();				
                }
            }
            return false;
		}
		
		public function atualizarTipoAtividade(&$dados, &$retorno)
		{
			if($GLOBALS['conn']){
				try{
					$sql = 'update tiposatividade set ati_descricao = ?, ati_status = ?, pro_cod = ? where ati_cod = ?';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['descricao'], PDO::PARAM_STR);
					$statement->bindParam(2, $dados['status'], PDO::PARAM_STR);
					$statement->bindParam(3, $dados['professor'], PDO::PARAM_INT);
					$statement->bindParam(4, $dados['cod'], PDO::PARAM_INT);
                    $salvou = $statement->execute(); 
                    if($salvou)
                    {
                        $retorno = 'Alteração realizada com sucesso!';
                        return true;
                    }				
				}catch(PDOException $erro){
					$retorno = '(EdMErro): Erro: '.$erro->getMessage();				
                }
            }
            return false;
        }
    }
?>