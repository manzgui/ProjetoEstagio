<?php
	$conn = Banco::getConexao();
	
    class MConta
    {
        private $cod;
        private $descricao;
        private $saldo;

        //GET
        public function getCod(){return $this->cod;}
        public function getDescricao(){return $this->descricao;}
        public function getSaldo(){return $this->saldo;}
        //SET
        public function setCod($cod){$this->cod = $cod;}
        public function setDescricao($descricao){$this->descricao = $descricao;}
        public function SetSaldo($saldo){$this->saldo = $saldo;}

        public function MConta($cod = 0, $descricao = '', $saldo = 0){
			$this->cod = $cod;
			$this->descricao = $descricao;
			$this->saldo = $saldo;		
        }

        public function getContasCbb(){
			if($GLOBALS['conn']){
				$sql = 'select con_cod, con_descricao, con_saldototal from conta order by con_descricao';
				$consulta = $GLOBALS['conn']->prepare($sql);
				$consulta->execute();
				return $consulta->fetchAll();
			}return NULL;
		}

        public function getContasGrid($filtro, &$retorno)
        {
			try{
				$sql = 'select con_cod, con_descricao, con_saldototal from conta where upper(con_descricao) like upper(\'%'.$filtro.'%\') order by con_descricao';
				$consulta = $GLOBALS['conn']->prepare($sql);
				$consulta->execute();
				$retorno = $consulta->fetchAll();
				return true;
			}catch(Exception $erro){
				echo "(CtMErro): Erro ao buscar contas. ".$erro->getMessage();
			}
			return false;
		}
        
		public function salvarConta(&$dados, &$retorno)
		{
			if($GLOBALS['conn']){
				try{
					$sql = 'insert into conta (con_descricao, con_saldototal) values (?,?)';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['descricao'], PDO::PARAM_STR);
					$statement->bindParam(2, $dados['saldo'], PDO::PARAM_STR);
                    $salvou = $statement->execute(); 
                    if($salvou)
                    {
                        $retorno = 'Operação realizada com sucesso!';
                        return true;
                    }				
				}catch(PDOException $erro){
					$retorno = '(CtMErro): Erro: '.$erro->getMessage();				
                }
            }
            return false;
		}
		
		public function atualizarConta(&$dados, &$retorno)
		{
			if($GLOBALS['conn']){
				try{
					$sql = 'update conta set con_descricao = ?, con_saldototal = ? where con_cod = ?';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['descricao'], PDO::PARAM_STR);
					$statement->bindParam(2, $dados['saldo'], PDO::PARAM_STR);
					$statement->bindParam(3, $dados['cod'], PDO::PARAM_INT);
                    $salvou = $statement->execute(); 
                    if($salvou)
                    {
                        $retorno = 'Alteração realizada com sucesso!';
                        return true;
                    }				
				}catch(PDOException $erro){
					$retorno = '(CtMErro): Erro: '.$erro->getMessage();				
                }
            }
            return false;
        }
    }
?>