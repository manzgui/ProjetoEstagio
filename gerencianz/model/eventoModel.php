<?php
    $conn = Banco::getConexao();

    class MEvento
    {
        private $cod;
        private $data;
        private $evento;
        private $obs;
        private $voluntarios;

        //GET
        public function getCod(){return $this->cod;}
        public function getData(){return $this->data;}
        public function getEvento(){return $this->evento;}
        public function getObs(){return $this->obs;}
        public function getVoluntarios(){return $this->voluntarios;}
        //SET
        public function setCod($cod){$this->cod = $cod;}
        public function setData($data){$this->data = $data;}
        public function setEvento($evento){$this->evento = $evento;}
        public function setObs($obs){$this->obs = $obs;}
        public function setVoluntarios($voluntarios){$this->voluntarios = $voluntarios;}

        public function MAtendimento($cod = 0, $data = '', $evento = '', $obs = '', $voluntarios = '')
        {
			$this->cod = $cod;
			$this->data = $data;
            $this->evento = $evento;
            $this->obs = $obs;
			$this->voluntarios = $voluntarios;	
		}
		
		public function getMaxEvento(&$codigo)
		{
			if($GLOBALS['conn'])
			{
				try{
					$sql = 'select max(eve_cod) ultimoCodigo from evento';
					$consulta = $GLOBALS['conn']->prepare($sql);
					$salvou = $consulta->execute();
					if($salvou)
					{
						$codigo = $consulta->fetchAll();
						$codigo = $codigo[0]['ultimoCodigo'];
						return true;
					}
					return false;
				}catch(Exception $erro){
					$codigo = 0;
					return false;
				}
			}
			$codigo = 0;
			return false;
		}

        public function salvarEvento(&$dados, &$retorno){
			if($GLOBALS['conn'])
			{
				try{
					$sql = 'insert into evento (eve_descricao, eve_data, eve_observacoes, pro_cod) values (?,?,?,?)';
					$statement = $GLOBALS['conn']->prepare($sql);
					$statement->bindParam(1, $dados['evento'], PDO::PARAM_STR);
					$statement->bindParam(2, $dados['data'], PDO::PARAM_STR);
					$statement->bindParam(3, $dados['obs'], PDO::PARAM_STR);
					$statement->bindParam(4, $dados['profissional'], PDO::PARAM_INT);
					$salvou = $statement->execute();
					$codigo = 0;
                    if($salvou && MEvento::getMaxEvento($codigo) && $codigo != 0)
                    {
						try{
							foreach($dados['voluntarios'] as $vol)
							{
								$arra_aux = array();
								$arra_aux = explode(";", $vol);
								$dados_vol = array(
									"voluntario" => $arra_aux[0],
									"funcao" => $arra_aux[1],
								);
								$sql = 'insert into evento_voluntario (eve_cod, vol_cod, evvo_funcao) values (?,?,?)';
								$statement = $GLOBALS['conn']->prepare($sql);
								$statement->bindParam(1, $codigo, PDO::PARAM_INT);
								$statement->bindParam(2, $dados_vol['voluntario'], PDO::PARAM_INT);
								$statement->bindParam(3, $dados_vol['funcao'], PDO::PARAM_STR);
								$statement->execute();
							}
							$retorno = 'Operação realizada com sucesso!';
							return true;
						}catch(PDOException $erro){
							$retorno = '(EvMErro1): Erro: '.$erro->getMessage();	
						}
					}
				}catch(PDOException $erro){
					$retorno = '(EvMErro2): Erro: '.$erro->getMessage();				
                }
            }
            return false;
        }
	}
?>