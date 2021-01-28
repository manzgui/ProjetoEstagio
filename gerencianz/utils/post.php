<?php
    include_once '../carrega_controllers.php';
    session_start();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if(isset($_POST['getByEstado'])){
			$auxCidade = new CCidade(new MCidade());
			$retorno = NULL;
			if($auxCidade->getCidades($_POST['getByEstado'], $retorno))
				echo $retorno;
			unset($auxCidade);
        }
        
        if(isset($_POST['filtroParametrizacao'])){
			$auxParametrizacao = new CConfiguracoes(new MConfiguracoes());
			$retorno = NULL;
			if($auxParametrizacao->getParametrizacaoGrid($retorno))
				echo $retorno;
			unset($auxParametrizacao);
        }
		
		if(isset($_POST['filtroEducando'])){
			$auxEducando = new CEducando(new MEducando());
			$retorno = NULL;
			if($auxEducando->getEducandosGrid($_POST['filtroEducando'], $retorno))
				echo $retorno;
			unset($auxEducando);
        }
        
        if(isset($_POST['filtroVoluntario'])){
			$auxVoluntario = new CVoluntario(new MVoluntario());
			$retorno = NULL;
			if($auxVoluntario->getVoluntariosGrid($_POST['filtroVoluntario'], $retorno))
				echo $retorno;
			unset($auxVoluntario);
        }
        
        if(isset($_POST['filtroProfissional'])){
			$auxProfissional = new CProfissional(new MProfissional());
			$retorno = NULL;
			if($auxProfissional->getProfissionaisGrid($_POST['filtroProfissional'], $retorno))
				echo $retorno;
			unset($auxProfissional);
		}

		if(isset($_POST['filtroTurma'])){
			$auxTurma = new CTurma(new MTurma());
			$retorno = NULL;
			if($auxTurma->getTurmasGrid($_POST['filtroTurma'], $retorno))
				echo $retorno;
			unset($auxTurma);
		}

		if(isset($_POST['filtroTipoAtividade'])){
			$auxTipoAtividade = new CTipoAtividade(new MTipoAtividade());
			$retorno = NULL;
			if($auxTipoAtividade->getTiposAtividadeGrid($_POST['filtroTipoAtividade'], $retorno))
				echo $retorno;
			unset($auxTipoAtividade);
        }

        if(isset($_POST['filtroTipoMaterial'])){
			$auxTipoMaterial = new CTipoMaterial(new MTipoMaterial());
			$retorno = NULL;
			if($auxTipoMaterial->getTiposMaterialGrid($_POST['filtroTipoMaterial'], $retorno))
				echo $retorno;
			unset($auxTipoMaterial);
        }

        if(isset($_POST['filtroConta'])){
			$auxConta = new CConta(new MConta());
			$retorno = NULL;
			if($auxConta->getContasGrid($_POST['filtroConta'], $retorno))
				echo $retorno;
			unset($auxConta);
        }

        if(isset($_POST['filtroTipoReceita'])){
			$auxTipoReceita = new CTipoReceita(new MTipoReceita());
			$retorno = NULL;
			if($auxTipoReceita->getTiposReceitaGrid($_POST['filtroTipoReceita'], $retorno))
				echo $retorno;
			unset($auxTipoReceita);
        }

        if(isset($_POST['filtroSubtipoReceita'])){
			$auxTipoReceita = new CTipoReceita(new MTipoReceita());
			$retorno = NULL;
			if($auxTipoReceita->getSubtiposReceitaGrid($_POST['filtroSubtipoReceita'], $retorno))
				echo $retorno;
			unset($auxTipoReceita);
        }

        if(isset($_POST['filtroTipoDespesa'])){
			$auxTipoReceita = new CTipoDespesa(new MTipoDespesa());
			$retorno = NULL;
			if($auxTipoReceita->getTiposDespesaGrid($_POST['filtroTipoDespesa'], $retorno))
				echo $retorno;
			unset($auxTipoReceita);
        }

        if(isset($_POST['filtroSubtipoDespesa'])){
			$auxTipoDespesa = new CTipoDespesa(new MTipoDespesa());
			$retorno = NULL;
			if($auxTipoDespesa->getSubtiposDespesaGrid($_POST['filtroSubtipoDespesa'], $retorno))
				echo $retorno;
			unset($auxTipoDespesa);
        }

        if(isset($_POST['filtroTipoVerba'])){
			$auxTipoVerba = new CTipoVerba(new MTipoVerba());
			$retorno = NULL;
			if($auxTipoVerba->getTiposVerbaGrid($_POST['filtroTipoVerba'], $retorno))
				echo $retorno;
			unset($auxTipoVerba);
        }

        if(isset($_POST['filtroAtendimento'])){
			$auxAtendimento = new CAtendimento(new MAtendimento());
			$retorno = NULL;
			if($auxAtendimento->getAtendimentosGrid($_POST['filtroAtendimento'], $retorno))
				echo $retorno;
			unset($auxAtendimento);
        }
        
        if(isset($_POST['acao']) && !empty($_POST['acao']))
        {
            switch($_POST['acao'])
            {
                case 'salvarParametrizacao':
					$auxParametrizacao = new CConfiguracoes(new MConfiguracoes());
					$msgRetorno = "";
					$retorno = array(
						"cod" => $_POST['cod'],
						"razao" => $_POST['razao'],
                        "fantasia" => $_POST['fantasia'],
                        "cnpj" => $_POST['cnpj'],
                        "inscricao" => $_POST['inscricao'],
                        "fixo" => $_POST['fixo'],
                        "celular" => $_POST['celular'],
                        "rua" => $_POST['rua'],
                        "numero" => $_POST['numero'],
                        "bairro" => $_POST['bairro'],
						"complemento" => $_POST['complemento'],
						"estado" => $_POST['estado'],
                        "cidade" => $_POST['cidade']
					);
					if($_POST['cod'] == "0")
						$auxParametrizacao->salvarParametrizacao($retorno, $_SESSION['usuario_ea']);
					else
						$auxParametrizacao->atualizarParametrizacao($retorno, $_SESSION['usuario_ea']);
					echo json_encode($retorno);
					unset($auxParametrizacao);
				break;

                case 'salvarEducando':
					$auxEducando = new CEducando(new MEducando());
					$msgRetorno = "";
					$retorno = array(
						"cod" => $_POST['cod'],
						"nome" => $_POST['nome'],
                        "datanascimento" => $_POST['datanascimento'],
                        "rg" => $_POST['rg'],
                        "nomemae" => $_POST['nomemae'],
                        "fixo" => $_POST['fixo'],
                        "celular" => $_POST['celular'],
                        "rua" => $_POST['rua'],
                        "numero" => $_POST['numero'],
                        "bairro" => $_POST['bairro'],
						"complemento" => $_POST['complemento'],
						"estado" => $_POST['estado'],
                        "cidade" => $_POST['cidade']
					);
					if($_POST['cod'] == "0")
						$auxEducando->salvarEducando($retorno, $_SESSION['usuario_ea']);
					else
						$auxEducando->atualizarEducando($retorno, $_SESSION['usuario_ea']);
					echo json_encode($retorno);
					unset($auxEducando);
				break;
				
				case 'salvarTurma':
					$auxTurma = new CTurma(new MTurma());
					$msgRetorno = "";
					$retorno = array(
						"cod" => $_POST['cod'],
						"descricao" => $_POST['descricao'],
                        "periodo" => $_POST['periodo'],
                        "datacriacao" => $_POST['datacriacao'],
                        "datafechamento" => $_POST['datafechamento']
					);
					if($_POST['cod'] == "0")
						$auxTurma->salvarTurma($retorno, $_SESSION['usuario_ea']);
					else
						$auxTurma->atualizarTurma($retorno, $_SESSION['usuario_ea']);
					echo json_encode($retorno);
					unset($auxTurma);
				break;
				
				case 'salvarVoluntario':
					$auxVoluntario = new CVoluntario(new MVoluntario());
					$msgRetorno = "";
					$retorno = array(
						"cod" => $_POST['cod'],
						"nome" => $_POST['nome'],
                        "datanascimento" => $_POST['datanascimento'],
                        "cpf" => $_POST['cpf'],
                        "rg" => $_POST['rg'],
                        "profissao" => $_POST['profissao'],
                        "fixo" => $_POST['fixo'],
                        "celular" => $_POST['celular'],
                        "datainicio" => $_POST['datainicio'],
                        "datafim" => $_POST['datafim'],
                        "rua" => $_POST['rua'],
						"numero" => $_POST['numero'],
						"bairro" => $_POST['bairro'],
                        "complemento" => $_POST['complemento'],
                        "estado" => $_POST['estado'],
						"cidade" => $_POST['cidade']
					);
					if($_POST['cod'] == "0")
						$auxVoluntario->salvarVoluntario($retorno, $_SESSION['usuario_ea']);
					else
						$auxVoluntario->atualizarVoluntario($retorno, $_SESSION['usuario_ea']);
					echo json_encode($retorno);
					unset($auxVoluntario);
                break;
                
                case 'salvarProfissional':
					$auxProfissional = new CProfissional(new MProfissional());
					$msgRetorno = "";
					$retorno = array(
						"cod" => $_POST['cod'],
						"nome" => $_POST['nome'],
                        "datanascimento" => $_POST['datanascimento'],
                        "cpf" => $_POST['cpf'],
                        "rg" => $_POST['rg'],
                        "funcao" => $_POST['funcao'],
                        "fixo" => $_POST['fixo'],
                        "celular" => $_POST['celular'],
                        "dataadmissao" => $_POST['dataadmissao'],
                        "datademissao" => $_POST['datademissao'],
                        "rua" => $_POST['rua'],
						"numero" => $_POST['numero'],
						"bairro" => $_POST['bairro'],
                        "complemento" => $_POST['complemento'],
                        "estado" => $_POST['estado'],
                        "cidade" => $_POST['cidade'],
                        "usuario" => $_POST['usuario'],
                        "senha" => $_POST['senha'],
                        "nivel" => $_POST['nivel']
					);
					if($_POST['cod'] == "0")
						$auxProfissional->salvarProfissional($retorno, $_SESSION['usuario_ea']);
					else
						$auxProfissional->atualizarProfissional($retorno, $_SESSION['usuario_ea']);
					echo json_encode($retorno);
					unset($auxProfissional);
				break;

				case 'salvarTipoAtividade':
					$auxTipoAtividade = new CTipoAtividade(new MTipoAtividade());
					$msgRetorno = "";
					$retorno = array(
						"cod" => $_POST['cod'],
						"descricao" => $_POST['descricao'],
						"professor" => $_POST['professor'],
						"status" => $_POST['status']
					);
					if($_POST['cod'] == "0")
						$auxTipoAtividade->salvarTipoAtividade($retorno, $_SESSION['usuario_ea']);
					else
						$auxTipoAtividade->atualizarTipoAtividade($retorno, $_SESSION['usuario_ea']);
					echo json_encode($retorno);
					unset($auxTipoAtividade);
                break;
                
                case 'salvarTipoMaterial':
					$auxTipoMaterial = new CTipoMaterial(new MTipoMaterial());
					$msgRetorno = "";
					$retorno = array(
						"cod" => $_POST['cod'],
						"descricao" => $_POST['descricao'],
						"estoque" => $_POST['estoque'],
						"unidade" => $_POST['unidade']
					);
					if($_POST['cod'] == "0")
						$auxTipoMaterial->salvarTipoMaterial($retorno, $_SESSION['usuario_ea']);
					else
						$auxTipoMaterial->atualizarTipoMaterial($retorno, $_SESSION['usuario_ea']);
					echo json_encode($retorno);
					unset($auxTipoMaterial);
				break;

                case 'salvarTipoReceita':
					$auxTipoReceita = new CTipoReceita(new MTipoReceita());
					$msgRetorno = "";
					$retorno = array(
                        "cod" => $_POST['cod'],
                        "descricao" => $_POST['descricao']
                    );
                    if($_POST['cod'] == "0")
                        $auxTipoReceita->salvarTipoReceita($retorno, $_SESSION['usuario_ea']);
                    else
                        $auxTipoReceita->atualizarTipoReceita($retorno, $_SESSION['usuario_ea']);
					echo json_encode($retorno);
					unset($auxTipoReceita);
                break;      
                
                case 'salvarSubtipoReceita':
					$auxTipoReceita = new CTipoReceita(new MTipoReceita());
					$msgRetorno = "";
					$retorno = array(
                        "subtipos" => $_POST['subtipos']
                    );
                    $auxTipoReceita->salvarSubtipoReceita($retorno, $_SESSION['usuario_ea']);
					echo json_encode($retorno);
					unset($auxTipoReceita);
                break;  
                
                case 'salvarTipoDespesa':
					$auxTipoDespesa = new CTipoDespesa(new MTipoDespesa());
					$msgRetorno = "";
					$retorno = array(
                        "cod" => $_POST['cod'],
                        "descricao" => $_POST['descricao']
                    );
                    if($_POST['cod'] == "0")
                        $auxTipoDespesa->salvarTipoDespesa($retorno, $_SESSION['usuario_ea']);
                    else
                        $auxTipoDespesa->atualizarTipoDespesa($retorno, $_SESSION['usuario_ea']);
					echo json_encode($retorno);
					unset($auxTipoDespesa);
                break; 

                case 'salvarSubtipoDespesa':
                    $auxTipoDespesa = new CTipoDespesa(new MTipoDespesa());
					$msgRetorno = "";
					$retorno = array(
                        "subtipos" => $_POST['subtipos']
                    );
                    $auxTipoDespesa->salvarSubtipoDespesa($retorno, $_SESSION['usuario_ea']);
					echo json_encode($retorno);
					unset($auxTipoDespesa);
                break; 

				case 'salvarTipoVerba':
					$auxTipoVerba = new CTipoVerba(new MTipoVerba());
					$msgRetorno = "";
					$retorno = array(
                        "cod" => $_POST['cod'],
						"descricao" => $_POST['descricao']
                    );
                    if($_POST['cod'] == "0")
                        $auxTipoVerba->salvarTipoVerba($retorno, $_SESSION['usuario_ea']);
                    else
                        $auxTipoVerba->atualizarTipoVerba($retorno, $_SESSION['usuario_ea']);
					echo json_encode($retorno);
					unset($auxTipoVerba);
                break;
                
                case 'salvarConta':
					$auxConta = new CConta(new MConta());
					$msgRetorno = "";
					$retorno = array(
                        "cod" => $_POST['cod'],
                        "descricao" => $_POST['descricao'],
                        "saldo" => $_POST['saldo']
					);
					if($_POST['cod'] == "0")
						$auxConta->salvarConta($retorno, $_SESSION['usuario_ea']);
					else
						$auxConta->atualizarConta($retorno, $_SESSION['usuario_ea']);
					echo json_encode($retorno);
					unset($auxConta);
				break;
                
                case 'salvarAtendimento':
					$auxAtendimento = new CAtendimento(new MAtendimento());
					$msgRetorno = "";
					$retorno = array(
                        'cod' => $_POST['cod'],
                        'data' => $_POST['data'],
                        'inicio' => $_POST['inicio'],
                        'fim' => $_POST['fim'],
                        'relatorio' => $_POST['relatorio'],
                        'profissional' => $_POST['profissional'],
                        'educando' => $_POST['educando']
                    );
                    if($_POST['cod'] == "0")
						$auxAtendimento->salvarAtendimento($retorno, $_SESSION['usuario_ea']);
					else
					    $auxAtendimento->atualizarAtendimento($retorno, $_SESSION['usuario_ea']);
					echo json_encode($retorno);
					unset($auxAtendimento);
				break;

				case 'salvarEvento':
					$auxEvento = new CEvento(new MEvento());
					$msgRetorno = "";
					$retorno = array(
						'data' => $_POST['data'],
						'evento' => $_POST['evento'],
						'obs' => $_POST['obs'],
						'voluntarios' => $_POST['voluntarios'],
						'profissional' => $_POST['profissional']
					);
					$auxEvento->salvarEvento($retorno, $_SESSION['usuario_ea']);
					echo json_encode($retorno);
					unset($auxEvento);
                break;
                
                case 'salvarEntrada':
                    $auxTipoMaterial = new CTipoMaterial(new MTipoMaterial());
                    $msgRetorno = "";
                    $retorno = array(
                        'cod' => $_POST['cod'],
                        'data' => $_POST['data'] 
                    );
                    if($_POST['cod'] == "0")
                        $auxTipoMaterial->salvarEntrada($retorno, $_SESSION['codfunc']);
                    else
                        $auxTipoMaterial->atualizarEntrada($retorno, $_SESSION['codfunc']);
                break;
            }
        }
    }
?>