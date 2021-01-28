<?php
	$conn = Banco::getConexao();
	
    class MEducando
    {
        private $cod;
        private $nome;
        private $datanascimento;
        private $rg;
        private $nomemae;
        private $fixo;
        private $celular;
        private $rua;
        private $numero;
        private $bairro;
		private $complemento;
		private $estado;
        private $cidade;

        //GET
        public function getCod(){return $this->cod;}
        public function getNome(){return $this->nome;}
        public function getDatanascimento(){return $this->datanascimento;}
        public function getRg(){return $this->rg;}
        public function getNomemae(){return $this->nomemae;}
        public function getFixo(){return $this->fixo;}
        public function getCelular(){return $this->celular;}
        public function getRua(){return $this->rua;}
        public function getNumero(){return $this->numero;}
        public function getBairro(){return $this->bairro;}
        public function getComplemento(){return $this->complemento;}
		public function getEstado(){return $this->estado;}
		public function getCidade(){return $this->cidade;}
        //SET
        public function setCod($cod){$this->cod = $cod;}
        public function setNome($nome){$this->nome = $nome;}
        public function setDatanascimento($datanascimento){$this->datanascimento = $datanascimento;}
        public function setRg($rg){$this->rg = $rg;}
        public function setNomemae($nomemae){$this->nomemae = $nomemae;}
        public function setFixo($fixo){$this->fixo = $fixo;}
        public function setCelular($celular){$this->celular = $celular;}
        public function setRua($rua){$this->rua = $rua;}
        public function setNumero($numero){$this->numero = $numero;}
        public function setBairro($bairro){$this->bairro = $bairro;}
        public function setComplemento($complemento){$this->complemento = $complemento;}
		public function setEstado($estado){$this->estado = $estado;}
		public function setCidade($cidade){$this->cidade = $cidade;}

        public function MEducando($cod = 0, $nome = '', $datanascimento = '', $rg = '', $nomemae = '', $fixo = '', $celular = '', $rua = '', $numero = '', $bairro = '', $complemento = '', $estado = '', $cidade = ''){
			$this->cod = $cod;
			$this->nome = $nome;
			$this->datanascimento = $datanascimento;
			$this->rg = $rg;
			$this->nomemae = $nomemae;
			$this->fixo = $fixo;
			$this->celular = $celular;
            $this->rua = $rua;	
            $this->numero = $numero;
			$this->bairro = $bairro;
			$this->complemento = $complemento;
			$this->estado = $estado;	
			$this->cidade = $cidade;			
        }

        public function getEducandosCbb(){
			if($GLOBALS['conn']){
				$sql = 'select edu_cod, edu_nome, edu_dtnasc, edu_rg, edu_nomemae, edu_telefonefixo, edu_telefonecelular, edu_rua, edu_numero, edu_bairro, edu_complemento, estado, cidade from educando order by edu_nome';
				$consulta = $GLOBALS['conn']->prepare($sql);
				$consulta->execute();
				return $consulta->fetchAll();
			}return NULL;
		}

        public function getEducandosGrid($filtro, &$retorno)
        {
			try{
				$sql = 'select edu_cod, edu_nome, edu_dtnasc, edu_rg, edu_nomemae, edu_telefonefixo, edu_telefonecelular, edu_rua, edu_numero, edu_bairro, edu_complemento, estado, cidade from educando where upper(edu_nome) like upper(\'%'.$filtro.'%\') order by edu_nome';
				$consulta = $GLOBALS['conn']->prepare($sql);
				$consulta->execute();
				$retorno = $consulta->fetchAll();
				return true;
			}catch(Exception $erro){
				echo "Erro ao buscar educandos. ".$erro->getMessage();
			}
			return false;
		}
        
		public function salvarEducando(&$dados, &$retorno)
		{
			if($GLOBALS['conn']){
				try{
					$sql = 'insert into educando (edu_nome, edu_dtnasc, edu_rg, edu_nomemae, edu_telefonefixo, edu_telefonecelular, edu_rua, edu_numero, edu_bairro, edu_complemento, estado, cidade) values (?,?,?,?,?,?,?,?,?,?,?,?)';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['nome'], PDO::PARAM_STR);
					$statement->bindParam(2, $dados['datanascimento'], PDO::PARAM_STR);
					$statement->bindParam(3, $dados['rg'], PDO::PARAM_STR);
					$statement->bindParam(4, $dados['nomemae'], PDO::PARAM_STR);
					$statement->bindParam(5, $dados['fixo'], PDO::PARAM_STR);
					$statement->bindParam(6, $dados['celular'], PDO::PARAM_STR);
					$statement->bindParam(7, $dados['rua'], PDO::PARAM_STR);
                    $statement->bindParam(8, $dados['numero'], PDO::PARAM_STR);
                    $statement->bindParam(9, $dados['bairro'], PDO::PARAM_STR);
					$statement->bindParam(10, $dados['complemento'], PDO::PARAM_STR);
					$statement->bindParam(11, $dados['estado'], PDO::PARAM_INT);
                    $statement->bindParam(12, $dados['cidade'], PDO::PARAM_INT);
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
		
		public function atualizarEducando(&$dados, &$retorno)
		{
			if($GLOBALS['conn']){
				try{
					$sql = 'update educando set edu_nome = ?, edu_dtnasc = ?, edu_rg = ?, edu_nomemae = ?, edu_telefonefixo = ?, edu_telefonecelular = ?, edu_rua = ?, edu_numero = ?, edu_bairro = ?, edu_complemento = ?, estado = ?, cidade = ? where edu_cod = ?';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['nome'], PDO::PARAM_STR);
					$statement->bindParam(2, $dados['datanascimento'], PDO::PARAM_STR);
					$statement->bindParam(3, $dados['rg'], PDO::PARAM_STR);
					$statement->bindParam(4, $dados['nomemae'], PDO::PARAM_STR);
					$statement->bindParam(5, $dados['fixo'], PDO::PARAM_STR);
					$statement->bindParam(6, $dados['celular'], PDO::PARAM_STR);
					$statement->bindParam(7, $dados['rua'], PDO::PARAM_STR);
                    $statement->bindParam(8, $dados['numero'], PDO::PARAM_STR);
                    $statement->bindParam(9, $dados['bairro'], PDO::PARAM_STR);
					$statement->bindParam(10, $dados['complemento'], PDO::PARAM_STR);
					$statement->bindParam(11, $dados['estado'], PDO::PARAM_INT);
					$statement->bindParam(12, $dados['cidade'], PDO::PARAM_INT);
					$statement->bindParam(13, $dados['cod'], PDO::PARAM_INT);
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