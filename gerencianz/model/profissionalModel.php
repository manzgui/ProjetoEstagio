<?php
    $conn = Banco::getConexao();

    class MProfissional
    {
        private $cod;
        private $nome;
        private $datanascimento;
        private $cpf;
        private $rg;
        private $funcao;
        private $fixo;
        private $celular;
        private $usuario;
        private $senha;
        private $nivel;
        private $dataadmissao;
        private $datademissao;
        private $rua;
        private $numero;
        private $bairro;
        private $complemento;
        private $cidade;

        //GET
        public function getCod(){return $this->cod;}
        public function getNome(){return $this->nome;}
        public function getDatanascimento(){return $this->datanascimento;}
        public function getCpf(){return $this->cpf;}
        public function getRg(){return $this->rg;}
        public function getFuncao(){return $this->funcao;}
        public function getFixo(){return $this->fixo;}
        public function getCelular(){return $this->celular;}
        public function getUsuario(){return $this->usuario;}
        public function getSenha(){return $this->senha;}
        public function getNivel(){return $this->nivel;}
        public function getDataadmissao(){return $this->dataadmissao;}
        public function getDatademissao(){return $this->datademissao;}
        public function getRua(){return $this->rua;}
        public function getNumero(){return $this->numero;}
        public function getBairro(){return $this->bairro;}
        public function getComplemento(){return $this->complemento;}
        public function getCidade(){return $this->cidade;}
        //SET
        public function setCod($cod){$this->cod = $cod;}
        public function setNome($nome){$this->nome = $nome;}
        public function setDatanascimento($datanascimento){$this->datanascimento = $datanascimento;}
        public function setCpf($cpf){$this->cpf = $cpf;}
        public function setRg($rg){$this->rg = $rg;}
        public function setFuncao($funcao){$this->funcao = $funcao;}
        public function setFixo($fixo){$this->fixo = $fixo;}
        public function setCelular($celular){$this->celular = $celular;}
        public function setUsuario($usuario){$this->usuario = $usuario;}
        public function setSenha($senha){$this->senha = $senha;}
        public function setNivel($nivel){$this->nivel = $nivel;}
        public function setDataadmissao($dataadmissao){$this->dataadmissao = $dataadmissao;}
        public function setDatademissao($datademissao){$this->datademissao = $datademissao;}
        public function setRua($rua){$this->rua = $rua;}
        public function setNumero($numero){$this->numero = $numero;}
        public function setBairro($bairro){$this->bairro = $bairro;}
        public function setComplemento($complemento){$this->complemento = $complemento;}
        public function setCidade($cidade){$this->cidade = $cidade;}
        
        public function MProfissional($cod = 0, $nome = '', $datanascimento = '', $cpf = '', $rg = '', $funcao = '', $fixo = '', $celular = '', $usuario = '', $senha = '', $nivel = 0, $dataadmissao = '', $datademissao = '', $rua = '', $numero = '', $bairro = '', $complemento = '', $cidade = '')
        {
			$this->cod = $cod;
			$this->nome = $nome;
            $this->datanascimento = $datanascimento;
            $this->cpf = $cpf;
			$this->rg = $rg;
            $this->funcao = $funcao;
            $this->fixo = $fixo;
			$this->celular = $celular;
            $this->usuario = $usuario;
            $this->senha = $senha;
			$this->nivel = $nivel;
            $this->dataadmissao = $dataadmissao;
            $this->datademissao = $datademissao;
			$this->rua = $rua;
            $this->numero = $numero;
            $this->bairro = $bairro;
			$this->complemento = $complemento;
			$this->cidade = $cidade;		
        }
        
        public function getProfissionaisCbb(){
			if($GLOBALS['conn']){
				$sql = 'select pro_cod, pro_nome, pro_dtnasc, pro_cpf, pro_rg, pro_funcao, pro_telefonefixo, pro_telefonecelular, pro_usuario, pro_senha, pro_nivel, pro_dtadmissao, pro_dtdemissao, pro_rua, pro_numero, pro_bairro, pro_complemento, estado, cidade from profissional where pro_nivel <> 100 order by pro_nome';
				$consulta = $GLOBALS['conn']->prepare($sql);
				$consulta->execute();
				return $consulta->fetchAll();
			}return NULL;
        }

        public function getProfissionaisGrid($filtro, &$retorno)
        {
			try{
				$sql = 'select pro_cod, pro_nome, pro_dtnasc, pro_cpf, pro_rg, pro_funcao, pro_telefonefixo, pro_telefonecelular, pro_usuario, pro_senha, pro_nivel, pro_dtadmissao, pro_dtdemissao, pro_rua, pro_numero, pro_bairro, pro_complemento, estado, cidade from profissional where upper(pro_nome) like upper(\'%'.$filtro.'%\') and pro_nivel <> 100  order by pro_nome';
				$consulta = $GLOBALS['conn']->prepare($sql);
				$consulta->execute();
				$retorno = $consulta->fetchAll();
				return true;
			}catch(Exception $erro){
				echo "Erro ao buscar profissionais. ".$erro->getMessage();
			}
			return false;
		}
        
        public function salvarProfissional(&$dados, &$retorno){
			if($GLOBALS['conn']){
				try{
					$sql = 'insert into profissional (pro_nome, pro_dtnasc, pro_cpf, pro_rg, pro_funcao, pro_telefonefixo, pro_telefonecelular, pro_dtadmissao, pro_dtdemissao, pro_rua, pro_numero, pro_bairro, pro_complemento, estado, cidade, pro_usuario, pro_senha, pro_nivel) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['nome'], PDO::PARAM_STR);
					$statement->bindParam(2, $dados['datanascimento'], PDO::PARAM_STR);
					$statement->bindParam(3, $dados['cpf'], PDO::PARAM_STR);
                    $statement->bindParam(4, $dados['rg'], PDO::PARAM_STR);
                    $statement->bindParam(5, $dados['funcao'], PDO::PARAM_STR);
                    $statement->bindParam(6, $dados['fixo'], PDO::PARAM_STR);
                    $statement->bindParam(7, $dados['celular'], PDO::PARAM_STR);
                    $statement->bindParam(8, $dados['dataadmissao'], PDO::PARAM_STR);
                    $statement->bindParam(9, $dados['datademissao'], PDO::PARAM_STR);
                    $statement->bindParam(10, $dados['rua'], PDO::PARAM_STR);
                    $statement->bindParam(11, $dados['numero'], PDO::PARAM_STR);
                    $statement->bindParam(12, $dados['bairro'], PDO::PARAM_STR);
                    $statement->bindParam(13, $dados['complemento'], PDO::PARAM_STR);
                    $statement->bindParam(14, $dados['estado'], PDO::PARAM_INT);
                    $statement->bindParam(15, $dados['cidade'], PDO::PARAM_INT);
                    $statement->bindParam(16, $dados['usuario'], PDO::PARAM_STR);
                    $statement->bindParam(17, $dados['senha'], PDO::PARAM_STR);
                    $statement->bindParam(18, $dados['nivel'], PDO::PARAM_INT);
                    $salvou = $statement->execute(); 
                    if($salvou)
                    {
                        $retorno = 'Operação realizada com sucesso!';
                        return true;
                    }				
				}catch(PDOException $erro){
					$retorno = '(PfMErro): Erro: '.$erro->getMessage();				
                }
            }
            return false;
        }

        public function atualizarProfissional(&$dados, &$retorno){
			if($GLOBALS['conn']){
				try{
					$sql = 'update profissional set pro_nome = ?, pro_dtnasc = ?, pro_cpf = ?, pro_rg = ?, pro_funcao = ?, pro_telefonefixo = ?, pro_telefonecelular = ?, pro_dtadmissao = ?, pro_dtdemissao = ?, pro_rua = ?, pro_numero = ?, pro_bairro = ?, pro_complemento = ?, estado = ?, cidade = ?, pro_usuario = ?, pro_senha = ?, pro_nivel = ? where pro_cod = ?';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['nome'], PDO::PARAM_STR);
					$statement->bindParam(2, $dados['datanascimento'], PDO::PARAM_STR);
					$statement->bindParam(3, $dados['cpf'], PDO::PARAM_STR);
                    $statement->bindParam(4, $dados['rg'], PDO::PARAM_STR);
                    $statement->bindParam(5, $dados['funcao'], PDO::PARAM_STR);
                    $statement->bindParam(6, $dados['fixo'], PDO::PARAM_STR);
                    $statement->bindParam(7, $dados['celular'], PDO::PARAM_STR);
                    $statement->bindParam(8, $dados['dataadmissao'], PDO::PARAM_STR);
                    $statement->bindParam(9, $dados['datademissao'], PDO::PARAM_STR);
                    $statement->bindParam(10, $dados['rua'], PDO::PARAM_STR);
                    $statement->bindParam(11, $dados['numero'], PDO::PARAM_STR);
                    $statement->bindParam(12, $dados['bairro'], PDO::PARAM_STR);
                    $statement->bindParam(13, $dados['complemento'], PDO::PARAM_STR);
                    $statement->bindParam(14, $dados['estado'], PDO::PARAM_INT);
                    $statement->bindParam(15, $dados['cidade'], PDO::PARAM_INT);
                    $statement->bindParam(16, $dados['usuario'], PDO::PARAM_STR);
                    $statement->bindParam(17, $dados['senha'], PDO::PARAM_STR);
                    $statement->bindParam(18, $dados['nivel'], PDO::PARAM_INT);
                    $statement->bindParam(19, $dados['cod'], PDO::PARAM_INT);
                    $salvou = $statement->execute(); 
                    if($salvou)
                    {
                        $retorno = 'Alteração realizada com sucesso!';
                        return true;
                    }				
				}catch(PDOException $erro){
					$retorno = '(PfMErro): Erro: '.$erro->getMessage();				
                }
            }
            return false;
        }
    }


?>