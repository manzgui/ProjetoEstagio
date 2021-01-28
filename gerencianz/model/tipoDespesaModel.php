<?php
	$conn = Banco::getConexao();
	
    class MTipoDespesa
    {
        private $cod;
        private $descricao;

        //GET
        public function getCod(){return $this->cod;}
        public function getDescricao(){return $this->descricao;}

        //SET
        public function setCod($cod){$this->cod = $cod;}
        public function setDescricao($descricao){$this->descricao = $descricao;}

        public function MTipoDespesa($cod = 0, $descricao = ''){
			$this->cod = $cod;
			$this->descricao = $descricao;
        }
        
        public function getTiposDespesaGrid($filtro, &$retorno)
        {
            try
            {
				$sql = 'select tpdesp_cod, tpdesp_descricao from tiposdespesa where upper(tpdesp_descricao) like upper(\'%'.$filtro.'%\') order by tpdesp_descricao';
				$consulta = $GLOBALS['conn']->prepare($sql);
				$consulta->execute();
				$retorno = $consulta->fetchAll();
				return true;
			}catch(Exception $erro){
				echo "(DpMErro): Erro ao buscar tipos de despesa. ".$erro->getMessage();
			}
			return false;
        }

        public function getSubtiposDespesaGrid($filtro, &$retorno)
        {
            try
            {
				$sql = 'select sbdesp_cod, sbdesp_descricao from subtiposdespesa where tpdesp_cod = ? order by sbdesp_descricao';
                $consulta = $GLOBALS['conn']->prepare($sql);
                $consulta->bindParam(1, $filtro, PDO::PARAM_INT);
				$consulta->execute();
				$retorno = $consulta->fetchAll();
				return true;
			}catch(Exception $erro){
				echo "(DpMErro): Erro ao buscar subtipos de despesa. ".$erro->getMessage();
			}
			return false;
		}
        
        public function salvarTipoDespesa(&$dados, &$retorno){
            if($GLOBALS['conn'])
            {
                try
                {
					$sql = 'insert into tiposdespesa (tpdesp_descricao) values (?)';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['descricao'], PDO::PARAM_STR);
                    $salvou = $statement->execute(); 
                    if($salvou)
                    {
                        $retorno = 'Operação realizada com sucesso!';
                        return true;
                    }				
				}catch(PDOException $erro){
					$retorno = '(DpMErro): Erro: '.$erro->getMessage();				
                }
            }
            return false;
        }

        public function atualizarTipoDespesa(&$dados, &$retorno)
        {
            if($GLOBALS['conn'])
            {
                try
                {
					$sql = 'update tiposdespesa set tpdesp_descricao = ? where tpdesp_cod = ?';
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

        public function salvarSubtipoDespesa(&$dados, &$retorno)
        {
            if($GLOBALS['conn'])
            {
				try{
					$sql = 'insert into subtiposdespesa (sbdesp_descricao, tpdesp_cod) values (?,?)';
					$statement = $GLOBALS['conn']->prepare($sql);
                    $statement->bindParam(1, $dados['descricao'], PDO::PARAM_STR);
                    $statement->bindParam(2, $dados['coddesp'], PDO::PARAM_INT);
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

        public function excluirSubtipoDespesa(&$dados, &$retorno)
        {
            if($GLOBALS['conn'])
            {
				try{
					$sql = 'delete from subtiposdespesa where sbdesp_cod = ?';
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