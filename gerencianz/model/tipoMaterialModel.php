<?php
	$conn = Banco::getConexao();
	
    class MTipoMaterial
    {
        private $cod;
        private $descricao;
        private $estoque;
        private $unidade;

        //GET
        public function getCod(){return $this->cod;}
        public function getDescricao(){return $this->descricao;}
        public function getEstoque(){return $this->estoque;}
        public function getUnidade(){return $this->unidade;}

        //SET
        public function setCod($cod){$this->cod = $cod;}
        public function setDescricao($descricao){$this->descricao = $descricao;}
        public function setEstoque($estoque){$this->estoque = $estoque;}
        public function setUnidade($unidade){$this->unidade = $unidade;}

        public function MTipoMaterial($cod = 0, $descricao = '', $estoque = 0, $unidade = ''){
			$this->cod = $cod;
			$this->descricao = $descricao;
			$this->estoque = $estoque;
            $this->unidade = $unidade;		
        }

        public function getTiposMaterialCbb(){
            if($GLOBALS['conn'])
            {
				$sql = 'select mat_cod, mat_descricao, mat_estoque, mat_unidade from tiposmaterial order by mat_descricao';
				$consulta = $GLOBALS['conn']->prepare($sql);
				$consulta->execute();
				return $consulta->fetchAll();
            }
            return NULL;
		}

		public function getTiposMaterialGrid($filtro, &$retorno)
        {
            try
            {
				$sql = 'select mat_cod, mat_descricao, mat_estoque, mat_unidade from tiposmaterial where upper(mat_descricao) like upper(\'%'.$filtro.'%\') order by mat_descricao';
				$consulta = $GLOBALS['conn']->prepare($sql);
				$consulta->execute();
				$retorno = $consulta->fetchAll();
				return true;
            }
            catch(Exception $erro){
				echo "(MMErro1): Erro ao buscar materiais. ".$erro->getMessage();
			}
			return false;
		}
        
        public function salvarTipoMaterial(&$dados, &$retorno)
        {
            if($GLOBALS['conn'])
            {
                try
                {
					$sql = 'insert into tiposmaterial (mat_descricao, mat_estoque, mat_unidade) values (?,?,?)';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['descricao'], PDO::PARAM_STR);
					$statement->bindParam(2, $dados['estoque'], PDO::PARAM_INT);
					$statement->bindParam(3, $dados['unidade'], PDO::PARAM_STR);
                    $salvou = $statement->execute(); 
                    if($salvou)
                    {
                        $retorno = 'Operação realizada com sucesso!';
                        return true;
                    }				
                }
                catch(PDOException $erro){
					$retorno = '(MMErro2): Erro ao salvar material. '.$erro->getMessage();				
                }
            }
            return false;
		}
		
        public function atualizarTipoMaterial(&$dados, &$retorno)
        {
            if($GLOBALS['conn'])
            {
                try
                {
					$sql = 'update tiposmaterial set mat_descricao = ?, mat_estoque = ?, mat_unidade = ? where mat_cod = ?';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['descricao'], PDO::PARAM_STR);
					$statement->bindParam(2, $dados['estoque'], PDO::PARAM_INT);
					$statement->bindParam(3, $dados['unidade'], PDO::PARAM_STR);
					$statement->bindParam(4, $dados['cod'], PDO::PARAM_INT);
                    $salvou = $statement->execute(); 
                    if($salvou)
                    {
                        $retorno = 'Alteração realizada com sucesso!';
                        return true;
                    }				
                }
                catch(PDOException $erro){
					$retorno = '(MMErro3): Erro ao alterar material. '.$erro->getMessage();				
                }
            }
            return false;
        }

        public function salvarEntrada(&$dados, $login, &$retorno)
        {
            if($GLOBALS['conn'])
            {
                try
                {
					$sql = 'insert into entradamaterial (ent_data, pro_cod) values (?,?)';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['data'], PDO::PARAM_STR);
					$statement->bindParam(2, $login, PDO::PARAM_INT);
					$statement->bindParam(3, $dados['unidade'], PDO::PARAM_STR);
                    $salvou = $statement->execute(); 
                    if($salvou)
                    {
                        $retorno = 'Operação realizada com sucesso!';
                        return true;
                    }				
                }
                catch(PDOException $erro){
					$retorno = '(MMErro2): Erro ao salvar entrada. '.$erro->getMessage();				
                }
            }
            return false;
		}
    }
?>