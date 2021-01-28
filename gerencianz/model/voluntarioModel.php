<?php
    $conn = Banco::getConexao();

    class MVoluntario
    {
        private $cod;
        private $nome;
        private $datanascimento;
        private $cpf;
        private $rg;
        private $profissao;
        private $fixo;
        private $celular;
        private $datainicio;
        private $datafim;
        private $rua;
        private $numero;
        private $bairro;
        private $complemento;
        private $estado;
        private $cidade;

        public function getCod(){return $this->cod;}
        public function getNome(){return $this->nome;}
        public function getDatanascimento(){return $this->datanascimento;}
        public function getCpf(){return $this->cpf;}
        public function getRg(){return $this->rg;}
        public function getProfissao(){return $this->profissao;}
        public function getFixo(){return $this->fixo;}
        public function getCelular(){return $this->celular;}
        public function getDatainicio(){return $this->datainicio;}
        public function getDatafim(){return $this->datafim;}
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
        public function setCpf($cpf){$this->cpf = $cpf;}
        public function setRg($rg){$this->rg = $rg;}
        public function setProfissao($profissao){$this->profissao = $profissao;}
        public function setFixo($fixo){$this->fixo = $fixo;}
        public function setCelular($celular){$this->celular = $celular;}
        public function setDatainicio($datainicio){$this->datainicio = $datainicio;}
        public function setDatafim($datafim){$this->datafim = $datafim;}
        public function setRua($rua){$this->rua = $rua;}
        public function setNumero($numero){$this->numero = $numero;}
        public function setBairro($bairro){$this->bairro = $bairro;}
        public function setComplemento($complemento){$this->complemento = $complemento;}
        public function setEstado($estado){$this->estado = $estado;}
		public function setCidade($cidade){$this->cidade = $cidade;}
		
		public function MVoluntario($cod = 0, $nome = '', $datanascimento = '', $cpf = '', $rg = '', $profissao = '', $fixo = '', $celular = '', $datainicio = '', $datafim = '', $rua = '', $numero = '', $bairro = '', $complemento = '', $estado = '', $cidade = '')
        {
			$this->cod = $cod;
			$this->nome = $nome;
            $this->datanascimento = $datanascimento;
            $this->cpf = $cpf;
			$this->rg = $rg;
            $this->profissao = $profissao;
            $this->fixo = $fixo;
			$this->celular = $celular;
            $this->datainicio = $datainicio;
            $this->datafim = $datafim;
			$this->rua = $rua;
            $this->numero = $numero;
            $this->bairro = $bairro;
            $this->complemento = $complemento;
            $this->estado = $estado;	
			$this->cidade = $cidade;		
		}
		
		public function getVoluntariosCbb(){
			if($GLOBALS['conn']){
				$sql = 'select vol_cod, vol_nome, vol_dtnasc, vol_cpf, vol_rg, vol_profissao, vol_telefonefixo, vol_telefonecelular, vol_dtinicio, vol_dtfim, vol_rua, vol_numero, vol_bairro, vol_complemento, estado, cidade from voluntario order by vol_nome';
				$consulta = $GLOBALS['conn']->prepare($sql);
				$consulta->execute();
				return $consulta->fetchAll();
			}return NULL;
        }

        public function getVoluntariosGrid($filtro, &$retorno)
        {
			try{
				$sql = 'select vol_cod, vol_nome, vol_dtnasc, vol_cpf, vol_rg, vol_profissao, vol_telefonefixo, vol_telefonecelular, vol_dtinicio, vol_dtfim, vol_rua, vol_numero, vol_bairro, vol_complemento, estado, cidade from voluntario where upper(vol_nome) like upper(\'%'.$filtro.'%\') order by vol_nome';
				$consulta = $GLOBALS['conn']->prepare($sql);
				$consulta->execute();
				$retorno = $consulta->fetchAll();
				return true;
			}catch(Exception $erro){
				echo "Erro ao buscar voluntários. ".$erro->getMessage();
			}
			return false;
		}
        
        public function salvarVoluntario(&$dados, &$retorno){
			if($GLOBALS['conn']){
				try{
					$sql = 'insert into voluntario (vol_nome, vol_dtnasc, vol_cpf, vol_rg, vol_profissao, vol_telefonefixo, vol_telefonecelular, vol_dtinicio, vol_dtfim, vol_rua, vol_numero, vol_bairro, vol_complemento, estado, cidade) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['nome'], PDO::PARAM_STR);
					$statement->bindParam(2, $dados['datanascimento'], PDO::PARAM_STR);
					$statement->bindParam(3, $dados['cpf'], PDO::PARAM_STR);
                    $statement->bindParam(4, $dados['rg'], PDO::PARAM_STR);
                    $statement->bindParam(5, $dados['profissao'], PDO::PARAM_STR);
                    $statement->bindParam(6, $dados['fixo'], PDO::PARAM_STR);
                    $statement->bindParam(7, $dados['celular'], PDO::PARAM_STR);
                    $statement->bindParam(8, $dados['datainicio'], PDO::PARAM_STR);
                    $statement->bindParam(9, $dados['datafim'], PDO::PARAM_STR);
                    $statement->bindParam(10, $dados['rua'], PDO::PARAM_STR);
                    $statement->bindParam(11, $dados['numero'], PDO::PARAM_STR);
                    $statement->bindParam(12, $dados['bairro'], PDO::PARAM_STR);
                    $statement->bindParam(13, $dados['complemento'], PDO::PARAM_STR);
                    $statement->bindParam(14, $dados['estado'], PDO::PARAM_INT);
                    $statement->bindParam(15, $dados['cidade'], PDO::PARAM_INT);
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

        public function atualizarVoluntario(&$dados, &$retorno){
			if($GLOBALS['conn']){
				try{
					$sql = 'update voluntario set vol_nome = ?, vol_dtnasc = ?, vol_cpf = ?, vol_rg = ?, vol_profissao = ?, vol_telefonefixo = ?, vol_telefonecelular = ?, vol_dtinicio = ?, vol_dtfim = ?, vol_rua = ?, vol_numero = ?, vol_bairro = ?, vol_complemento = ?, estado = ?, cidade = ? where vol_cod = ?';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['nome'], PDO::PARAM_STR);
					$statement->bindParam(2, $dados['datanascimento'], PDO::PARAM_STR);
					$statement->bindParam(3, $dados['cpf'], PDO::PARAM_STR);
                    $statement->bindParam(4, $dados['rg'], PDO::PARAM_STR);
                    $statement->bindParam(5, $dados['profissao'], PDO::PARAM_STR);
                    $statement->bindParam(6, $dados['fixo'], PDO::PARAM_STR);
                    $statement->bindParam(7, $dados['celular'], PDO::PARAM_STR);
                    $statement->bindParam(8, $dados['datainicio'], PDO::PARAM_STR);
                    $statement->bindParam(9, $dados['datafim'], PDO::PARAM_STR);
                    $statement->bindParam(10, $dados['rua'], PDO::PARAM_STR);
                    $statement->bindParam(11, $dados['numero'], PDO::PARAM_STR);
                    $statement->bindParam(12, $dados['bairro'], PDO::PARAM_STR);
                    $statement->bindParam(13, $dados['complemento'], PDO::PARAM_STR);
                    $statement->bindParam(14, $dados['estado'], PDO::PARAM_INT);
                    $statement->bindParam(15, $dados['cidade'], PDO::PARAM_INT);
                    $statement->bindParam(16, $dados['cod'], PDO::PARAM_INT);
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