<?php

	$conn = Banco::getConexao();

	class MLogin{
        private $codfunc;
		private $login;
		private $senha;
        private $nome;
        private $empresa;

		public function Login($codfunc = '', $login = '', $senha = '', $nome = '', $empresa){
            $this->codfunc = $codfunc;
            $this->login = $login;
			$this->senha = $senha;
            $this->nome = $nome;
            $this->empresa = $empresa;
		}

        //GET e SET
        public function getCodfunc(){return $this->codfunc;}
		public function getLogin(){return $this->login;}
		public function getSenha(){return $this->senha;}
        public function getNome(){return $this->nome;}
        public function getEmpresa(){return $this->empresa;}
        public function setCodfunc($codfunc){$this->codfunc = $codfunc;}
		public function setLogin($login){$this->login = $login;}
		public function setSenha($senha){$this->senha = $senha;}
        public function setNome($nome){$this->nome = $nome;}
        public function setEmpresa($empresa){$this->empresa = $empresa;}

		public function autentica(&$retorno){
			try{
				$GLOBALS['conn'] = Banco::getConexao();
				if($GLOBALS['conn']){
					$sql = 'select pro_cod, pro_nome, pro_usuario, pro_senha, par_fantasia from profissional, parametrizacao where upper(pro_usuario) like upper(:usuario) and pro_senha like :senha';
					$consulta = $GLOBALS['conn']->prepare($sql);
                    $consulta->bindParam(':usuario', $this->login, PDO::PARAM_STR);
                    $consulta->bindParam(':senha', $this->senha, PDO::PARAM_STR);
					$consulta->execute();
					$dados = $consulta->fetch(PDO::FETCH_BOTH);
                    if(!empty($dados))
                    {
                        $this->codfunc = $dados['pro_cod'];
                        $this->nome = $dados['pro_nome'];
                        $this->empresa = $dados['par_fantasia'];
                        return true;
                    }
                    return false;   
				}else{
					$retorno = 'Erro ao tentar realizar login';
					return false;
				}
			}catch(Exception $erro){
				$retorno = $erro->getMessage();
				return false;
			}
		}
	}
?>