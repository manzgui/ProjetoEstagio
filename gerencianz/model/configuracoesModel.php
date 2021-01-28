<?php
	$conn = Banco::getConexao();
	
    class MConfiguracoes
    {
        private $cod;
        private $razao;
        private $fantasia;
        private $cnpj;
        private $inscricao;
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
        public function getRazao(){return $this->razao;}
        public function getFantasia(){return $this->fantasia;}
        public function getCnpj(){return $this->cnpj;}
        public function getInscricao(){return $this->inscricao;}
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
        public function setRazao($razao){$this->razao = $razao;}
        public function setFantasia($fantasia){$this->fantasia = $fantasia;}
        public function setCnpj($cnpj){$this->cnpj = $cnpj;}
        public function setInscricao($inscricao){$this->inscricao = $inscricao;}
        public function setFixo($fixo){$this->fixo = $fixo;}
        public function setCelular($celular){$this->celular = $celular;}
        public function setRua($rua){$this->rua = $rua;}
        public function setNumero($numero){$this->numero = $numero;}
        public function setBairro($bairro){$this->bairro = $bairro;}
        public function setComplemento($complemento){$this->complemento = $complemento;}
		public function setEstado($estado){$this->estado = $estado;}
		public function setCidade($cidade){$this->cidade = $cidade;}

        public function MConfiguracoes($cod = 0, $razao = '', $fantasia = '', $cnpj = '', $inscricao = '', $fixo = '', $celular = '', $rua = '', $numero = '', $bairro = '', $complemento = '', $estado = '', $cidade = ''){
			$this->cod = $cod;
			$this->razao = $razao;
			$this->fantasia = $fantasia;
			$this->cnpj = $cnpj;
			$this->inscricao = $inscricao;
			$this->fixo = $fixo;
			$this->celular = $celular;
            $this->rua = $rua;	
            $this->numero = $numero;
			$this->bairro = $bairro;
			$this->complemento = $complemento;
			$this->estado = $estado;	
			$this->cidade = $cidade;			
        }

        public function getParametrizacaoGrid(&$retorno)
        {
			try{
				$sql = 'select par_cod, par_razao, par_fantasia, par_cnpj, par_inscricaoestadual, par_telefonefixo, par_telefonecelular, par_rua, par_numero, par_bairro, par_complemento, estado, cidade from parametrizacao';
				$consulta = $GLOBALS['conn']->prepare($sql);
				$consulta->execute();
				$retorno = $consulta->fetchAll();
				return true;
			}catch(Exception $erro){
				echo "Erro ao buscar parametrização. ".$erro->getMessage();
			}
			return false;
		}
        
		public function salvarParametrizacao(&$dados, &$retorno)
		{
			if($GLOBALS['conn']){
				try{
					$sql = 'insert into parametrizacao (par_razao, par_fantasia, par_cnpj, par_inscricaoestadual, par_telefonefixo, par_telefonecelular, par_rua, par_numero, par_bairro, par_complemento, estado, cidade) values (?,?,?,?,?,?,?,?,?,?,?,?)';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['razao'], PDO::PARAM_STR);
					$statement->bindParam(2, $dados['fantasia'], PDO::PARAM_STR);
					$statement->bindParam(3, $dados['cnpj'], PDO::PARAM_STR);
					$statement->bindParam(4, $dados['inscricao'], PDO::PARAM_STR);
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
					$retorno = '(PrMErro): Erro: '.$erro->getMessage();				
                }
            }
            return false;
		}
		
		public function atualizarParametrizacao(&$dados, &$retorno)
		{
			if($GLOBALS['conn']){
				try{
					$sql = 'update parametrizacao set par_razao = ?, par_fantasia = ?, par_cnpj = ?, par_inscricaoestadual = ?, par_telefonefixo = ?, par_telefonecelular = ?, par_rua = ?, par_numero = ?, par_bairro = ?, par_complemento = ?, estado = ?, cidade = ? where par_cod = ?';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['razao'], PDO::PARAM_STR);
					$statement->bindParam(2, $dados['fantasia'], PDO::PARAM_STR);
					$statement->bindParam(3, $dados['cnpj'], PDO::PARAM_STR);
					$statement->bindParam(4, $dados['inscricao'], PDO::PARAM_STR);
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
					$retorno = '(PrMErro): Erro: '.$erro->getMessage();				
                }
            }
            return false;
        }
    }
?>