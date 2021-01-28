<?php
	$form = true;
	if(substr(getcwd(), strlen(getcwd())-10, 10) != 'gerencianz'){
		if(substr(getcwd(), strlen(getcwd())-4, 4) == 'site')
			$form = false;
		chdir('../');
	}

	//arquivo do banco
	include_once './model/banco.php';
	
	//models
    include_once './model/loginModel.php';
    include_once './model/estadoModel.php';
    include_once './model/cidadeModel.php';
    include_once './model/configuracoesModel.php';
	include_once './model/educandoModel.php';
	include_once './model/turmaModel.php';
    include_once './model/tipoDespesaModel.php';
    include_once './model/tipoMaterialModel.php';
	include_once './model/tipoReceitaModel.php';
	include_once './model/tipoVerbaModel.php';
    include_once './model/profissionalModel.php';
    include_once './model/atendimentoModel.php';
	include_once './model/voluntarioModel.php';
	include_once './model/eventoModel.php';
    include_once './model/tipoAtividadeModel.php';
    include_once './model/contaModel.php';
	
	//controllers
    include_once './controller/loginController.php';
    include_once './controller/estadoController.php';
    include_once './controller/cidadeController.php';
    include_once './controller/configuracoesController.php';
	include_once './controller/educandoController.php';
	include_once './controller/turmaController.php';
    include_once './controller/tipoDespesaController.php';
    include_once './controller/tipoMaterialController.php';
	include_once './controller/tipoReceitaController.php';
	include_once './controller/tipoVerbaController.php';
    include_once './controller/profissionalController.php';
    include_once './controller/atendimentoController.php';	
	include_once './controller/voluntarioController.php';
	include_once './controller/eventoController.php';
    include_once './controller/tipoAtividadeController.php';	
    include_once './controller/contaController.php';				
		
	//declarações de controllers	
	$cLogin = new CLogin(new MLogin());
		
    //carrega página POST e FORMS
    include_once './utils/funcoes.php';
    
    include_once './site/admCalendarioEventoView.php';
    include_once './site/admEntradaMaterialView.php';
    include_once './site/configuracoesView.php';
    include_once './site/eduAtendimentoView.php';
    include_once './site/novoAtividadeView.php';
    include_once './site/novoContaView.php';
    include_once './site/novoEducandoView.php';
    include_once './site/novoProfissionalView.php';
    include_once './site/novoTipoDespesaView.php';
    include_once './site/novoTipoMaterialView.php';
    include_once './site/novoTipoReceitaView.php';
    include_once './site/novoTipoVerbaView.php';
    include_once './site/novoTurmaView.php';
    include_once './site/novoVoluntarioView.php';
?>