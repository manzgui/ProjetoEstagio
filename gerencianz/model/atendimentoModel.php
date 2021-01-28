<?php
    $conn = Banco::getConexao();

    class MAtendimento
    {
        private $cod;
        private $data;
        private $inicio;
        private $fim;
        private $profissional;
        private $educando;
        private $relatorio;

        //GET
        public function getCod(){return $this->cod;}
        public function getData(){return $this->data;}
        public function getInicio(){return $this->inicio;}
        public function getFim(){return $this->fim;}
        public function getProfissional(){return $this->profissional;}
        public function getEducando(){return $this->educando;}
        public function getRelatorio(){return $this->relatorio;}
        //SET
        public function setCod($cod){$this->cod = $cod;}
        public function setData($data){$this->data = $data;}
        public function setInicio($inicio){$this->inicio = $inicio;}
        public function setFim($fim){$this->fim = $fim;}
        public function setProfissional($profissional){$this->profissional = $profissional;}
        public function setEducando($educando){$this->educando = $educando;}
        public function setRelatorio($relatorio){$this->relatorio = $relatorio;}

        public function MAtendimento($cod = 0, $data = '', $inicio = '', $fim = '', $profissional = '', $educando = '', $relatorio = '')
        {
			$this->cod = $cod;
			$this->data = $data;
            $this->inicio = $inicio;
            $this->fim = $fim;
			$this->profissional = $profissional;
            $this->educando = $educando;
            $this->relatorio = $relatorio;	
        }

        public function getAtendimentosGrid($filtro, &$retorno)
        {
			try{
				$sql = 'select ate_cod, ate_data, ate_horainicial, ate_horafinal, ate_relatorio, a.pro_cod, pro_nome, a.edu_cod, edu_nome from atendimento a inner join profissional p on a.pro_cod = p.pro_cod inner join educando e on a.edu_cod = e.edu_cod where upper(pro_nome) like upper(\'%'.$filtro.'%\') order by ate_data desc';
				$consulta = $GLOBALS['conn']->prepare($sql);
				$consulta->execute();
				$retorno = $consulta->fetchAll();
				return true;
			}catch(Exception $erro){
				echo "Erro ao buscar atendimentos. ".$erro->getMessage();
			}
			return false;
		}

        public function salvarAtendimento(&$dados, &$retorno){
			if($GLOBALS['conn']){
				try{
					$sql = 'insert into atendimento (ate_data, ate_horainicial, ate_horafinal, ate_relatorio, pro_cod, edu_cod) values (?,?,?,?,?,?)';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['data'], PDO::PARAM_STR);
					$statement->bindParam(2, $dados['inicio'], PDO::PARAM_STR);
					$statement->bindParam(3, $dados['fim'], PDO::PARAM_STR);
					$statement->bindParam(4, $dados['relatorio'], PDO::PARAM_STR);
					$statement->bindParam(5, $dados['profissional'], PDO::PARAM_INT);
					$statement->bindParam(6, $dados['educando'], PDO::PARAM_INT);
                    $salvou = $statement->execute(); 
                    if($salvou)
                    {
                        $retorno = 'Operação realizada com sucesso!';
                        return true;
                    }				
				}catch(PDOException $erro){
					$retorno = '(AtMErro): Erro: '.$erro->getMessage();				
                }
            }
            return false;
        }

        public function atualizarAtendimento(&$dados, &$retorno){
			if($GLOBALS['conn']){
				try{
					$sql = 'update atendimento set ate_data = ?, ate_horainicial = ?, ate_horafinal = ?, ate_relatorio = ?, pro_cod = ?, edu_cod = ? where ate_cod = ?';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['data'], PDO::PARAM_STR);
					$statement->bindParam(2, $dados['inicio'], PDO::PARAM_STR);
					$statement->bindParam(3, $dados['fim'], PDO::PARAM_STR);
					$statement->bindParam(4, $dados['relatorio'], PDO::PARAM_STR);
					$statement->bindParam(5, $dados['profissional'], PDO::PARAM_INT);
                    $statement->bindParam(6, $dados['educando'], PDO::PARAM_INT);
                    $statement->bindParam(7, $dados['cod'], PDO::PARAM_INT);
                    $salvou = $statement->execute(); 
                    if($salvou)
                    {
                        $retorno = 'Alteração realizada com sucesso!';
                        return true;
                    }				
				}catch(PDOException $erro){
					$retorno = '(AtMErro): Erro: '.$erro->getMessage();				
                }
            }
            return false;
        }
	}
?>