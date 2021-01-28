<?php
	$conn = Banco::getConexao();
	
    class MTipoReceita
    {
        private $cod;
        private $descricao;

        //GET
        public function getCod(){return $this->cod;}
        public function getDescricao(){return $this->descricao;}

        //SET
        public function setCod($cod){$this->cod = $cod;}
        public function setDescricao($descricao){$this->descricao = $descricao;}

        public function MTipoReceita($cod = 0, $descricao = ''){
			$this->cod = $cod;
			$this->descricao = $descricao;		
        }

        public function getTiposReceitaGrid($filtro, &$retorno)
        {
            try
            {
				$sql = 'select tprec_cod, tprec_descricao from tiposreceita where upper(tprec_descricao) like upper(\'%'.$filtro.'%\') order by tprec_descricao';
				$consulta = $GLOBALS['conn']->prepare($sql);
				$consulta->execute();
				$retorno = $consulta->fetchAll();
				return true;
			}catch(Exception $erro){
				echo "(RcMErro): Erro ao buscar tipos de receita. ".$erro->getMessage();
			}
			return false;
        }
        
        public function getSubtiposReceitaGrid($filtro, &$retorno)
        {
            try
            {
				$sql = 'select sbrec_cod, sbrec_descricao from subtiposreceita where tprec_cod = ? order by sbrec_descricao';
                $consulta = $GLOBALS['conn']->prepare($sql);
                $consulta->bindParam(1, $filtro, PDO::PARAM_INT);
				$consulta->execute();
				$retorno = $consulta->fetchAll();
				return true;
			}catch(Exception $erro){
				echo "(RcMErro): Erro ao buscar subtipos de receita. ".$erro->getMessage();
			}
			return false;
		}
        
        public function salvarTipoReceita(&$dados, &$retorno)
        {
            if($GLOBALS['conn'])
            {
				try{
					$sql = 'insert into tiposreceita (tprec_descricao) values (?)';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['descricao'], PDO::PARAM_STR);
                    $salvou = $statement->execute(); 
                    if($salvou)
                    {
                        $retorno = 'Operação realizada com sucesso!';
                        return true;
                    }				
				}catch(PDOException $erro){
					$retorno = '(RcMErro): Erro: '.$erro->getMessage();				
                }
            }
            return false;
        }

        public function atualizarTipoReceita(&$dados, &$retorno)
        {
            if($GLOBALS['conn'])
            {
                try
                {
					$sql = 'update tiposreceita set tprec_descricao = ? where tprec_cod = ?';
					$statement = $GLOBALS['conn']->prepare($sql);
                    $statement->bindParam(1, $dados['descricao'], PDO::PARAM_STR);
                    $statement->bindParam(2, $dados['cod'], PDO::PARAM_INT);
                    $salvou = $statement->execute(); 
                    if($salvou)
                    {
                        $retorno = 'Atualização realizada com sucesso!';
                        return true;
                    }				
				}catch(PDOException $erro){
					$retorno = '(RcMErro): Erro: '.$erro->getMessage();				
                }
            }
            return false;
        }

        public function salvarSubtipoReceita(&$dados, &$retorno)
        {
            if($GLOBALS['conn'])
            {
				try{
					$sql = 'insert into subtiposreceita (sbrec_descricao, tprec_cod) values (?,?)';
					$statement = $GLOBALS['conn']->prepare($sql);
                    $statement->bindParam(1, $dados['descricao'], PDO::PARAM_STR);
                    $statement->bindParam(2, $dados['codrec'], PDO::PARAM_INT);
                    $salvou = $statement->execute(); 
                    if($salvou)
                    {
                        $retorno = 'Operação realizada com sucesso!';
                        return true;
                    }				
				}catch(PDOException $erro){
					$retorno = '(RcMErro): Erro: '.$erro->getMessage();				
                }
            }
            return false;
        }

        public function excluirSubtipoReceita(&$dados, &$retorno)
        {
            if($GLOBALS['conn'])
            {
				try{
					$sql = 'delete from subtiposreceita where sbrec_cod = ?';
					$statement = $GLOBALS['conn']->prepare($sql);
                    $statement->bindParam(1, $dados['cod'], PDO::PARAM_INT);
                    $salvou = $statement->execute(); 
                    if($salvou)
                    {
                        $retorno = 'Operação realizada com sucesso!';
                        return true;
                    }				
				}catch(PDOException $erro){
					$retorno = '(RcMErro): Erro: '.$erro->getMessage();				
                }
            }
            return false;
        }
    }
?>