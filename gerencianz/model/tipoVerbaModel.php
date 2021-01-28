<?php
	$conn = Banco::getConexao();
	
    class MTipoVerba
    {
        private $cod;
        private $descricao;

        //GET
        public function getCod(){return $this->cod;}
        public function getDescricao(){return $this->descricao;}

        //SET
        public function setCod($cod){$this->cod = $cod;}
        public function setDescricao($descricao){$this->descricao = $descricao;}

        public function MTipoVerba($cod = 0, $descricao = '', $periodo = '', $dataCriacao = '', $dataFechamento = ''){
			$this->cod = $cod;
			$this->descricao = $descricao;
			$this->periodo = $periodo;
            $this->dataCriacao = $dataCriacao;
            $this->dataFechamento = $dataFechamento;		
        }

        public function getTiposVerbaGrid($filtro, &$retorno)
        {
            try
            {
				$sql = 'select ver_cod, ver_descricao from tiposverba where upper(ver_descricao) like upper(\'%'.$filtro.'%\') order by ver_descricao';
				$consulta = $GLOBALS['conn']->prepare($sql);
				$consulta->execute();
				$retorno = $consulta->fetchAll();
				return true;
            }
            catch(Exception $erro){
				echo "(VbMErro): Erro ao buscar tipos de verba. ".$erro->getMessage();
			}
			return false;
		}
        
        public function salvarTipoVerba(&$dados, &$retorno){
			if($GLOBALS['conn']){
				try{
					$sql = 'insert into tiposverba (ver_descricao) values (?)';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['descricao'], PDO::PARAM_STR);
                    $salvou = $statement->execute(); 
                    if($salvou)
                    {
                        $retorno = 'Operação realizada com sucesso!';
                        return true;
                    }				
				}catch(PDOException $erro){
					$retorno = '(VbMErro): Erro: '.$erro->getMessage();				
                }
            }
            return false;
        }

        public function atualizarTipoVerba(&$dados, &$retorno)
        {
            if($GLOBALS['conn'])
            {
                try
                {
                    $sql = 'update tiposverba set ver_descricao = ? where ver_cod = ?';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['descricao'], PDO::PARAM_STR);
					$statement->bindParam(2, $dados['cod'], PDO::PARAM_INT);
                    $salvou = $statement->execute(); 
                    if($salvou)
                    {
                        $retorno = 'Alteração realizada com sucesso!';
                        return true;
                    }				
                }
                catch(PDOException $erro){
					$retorno = '(VbMErro): Erro ao alterar tipo de verba. '.$erro->getMessage();				
                }
            }
            return false;
        }
    }
?>