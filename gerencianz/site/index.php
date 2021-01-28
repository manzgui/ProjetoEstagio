<!DOCTYPE html>
<html class="ls-theme-green">
<head>
	<title>Gerencianz</title>
	<meta charset="utf-8">
	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="Gerencianz.">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link href="../utils/locastyle/stylesheets/locastyle.css" rel="stylesheet" type="text/css">
	<link rel="icon" sizes="192x192" href="../utils/locastyle/images/ico-boilerplate.png">
	<link rel="apple-touch-icon" href="../utils/locastyle/images/ico-boilerplate.png">
	<style type="text/css">
		.msg-erro{
			color: red;
			font-size:9px;
		}
		body::-webkit-scrollbar {
			width: 1em;
		}
		
		body::-webkit-scrollbar-track {
			-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
		}
		
		body::-webkit-scrollbar-thumb {
			background-color: black !important;
			outline: 1px solid slategrey !important;
		}

        .bootbox .modal-header {
		flex-direction: row-reverse;
	}
	</style>
	
	<body>
		<?php
            session_start();
            if(!isset($_SESSION['usuario_ea']) || empty($_SESSION['usuario_ea']))
				header('Location: ../login.php');
            include_once '../carrega_controllers.php';
			$p1active = '';
			$p2active = '';
			$p3active = '';
			$p4active = '';
			$p5active = '';
			$p6active = '';
			if(isset($_GET['param'])){
                $tela = $_GET['param'];
                switch($tela){
                    case 'newedu':
                    case 'newtur':
                    case 'newvol':
                    case 'newpro':
					case 'newdes':
					case 'newrec':
                        $p2active = 'active';
					break;
					
					case 'atendedu':
					case 'configedu':
					case 'freqedu':
                        $p3active = 'active';
                        
                    case 'calendadm':
                    case 'entradm':
                    case 'saidadm':
                        $p4active = 'active';
                }
            }else $p1active = 'active';
        ?>
        
        <div class="ls-topbar ">
			<!-- Barra de Notificações -->
	    	<div class="ls-notification-topbar">
				<!-- Dropdown com detalhes da conta de usuário -->
				<div data-ls-module="dropdown" class="ls-dropdown ls-user-account">
				<a href="#" class="ls-ico-user">
					<span class="ls-name"><?php echo $_SESSION['fun_nome'] ?></span>
					(<?php echo $_SESSION['usuario_ea'] ?>)
				</a>
			
				<nav class="ls-dropdown-nav ls-user-menu">
					<ul>
					<li><a href="?param=config">Configurações</a></li>
					<li><a href="../utils/logoff.php">Sair</a></li>
					</ul>
				</nav>
				</div>
			</div>
	
			<!-- Nome do produto/marca com sidebar -->
			<h1 class="ls-brand-name">
				<a href="home" class="ls-ico-earth">
					<small><?php echo $_SESSION['empresa'] ?></small>
					Gerencianz
				</a>
			</h1>
		</div>
		<aside class="ls-sidebar">
			<div class="ls-sidebar-inner">
				<nav class="ls-menu" style="overflow-x:hidden!important">
					<ul>
					<li><a href="./index.php" class="ls-ico-home" title="Dashboard">Início</a></li>
					<li>
						<a href="#" class="ls-ico-plus" title="Clientes">Cadastros</a>
						<ul>
						<li><a href="?param=newedu">Educandos</a></li>
						<li><a href="?param=newtur">Turmas</a></li>
						<li><a href="?param=newvol">Voluntários</a></li>
						<li><a href="?param=newpro">Profissionais</a></li>
						<li><a href="?param=newati">Tipos de Atividade</a></li>
						<li><a href="?param=newmat">Tipos de Material</a></li>
						<li><a href="?param=newrec">Tipos de Receita</a></li>
						<li><a href="?param=newdes">Tipos de Despesa</a></li>
						<li><a href="?param=newver">Tipos de Verba</a></li>
						<li><a href="?param=newcon">Contas</a></li>
						</ul>
					</li>
					<li>
						<a href="#" class="ls-ico-pencil"> Educandos</a>
						<ul>
						<li><a href="?param=atendedu">Atendimento</a></li>
						<li><a href="?param=configedu">Configurar Turma</a></li>
						<li><a href="?param=freqedu">Lançar Frequência</a></li>
						</ul>
					</li>
					<li> 
						<a href="#" class="ls-ico-attachment"> Administrativo</a>
						<ul>
						<li><a href="?param=calendadm">Calendário</a></li>
						<li><a href="?param=entradm">Entrada de Materiais</a></li>
						<li><a href="#">Saída de Materiais</a></li>
						</ul>
					</li>
					<li>
						<a href="#" class="ls-ico-text"> Financeiro</a>
						<ul>
						<li><a href="#">Transferência entre Contas</a></li>
						<li><a href="#">Lançar Despesas</a></li>
						<li><a href="#">Lançar Recebimento</a></li>
						</ul>	
					</li>
					<li>
						<a href="#" class="ls-ico-stats"> Relatórios</a>
						<ul>
						<li><a href="#">Relatório 1</a></li>
						<li><a href="#">Relatório 2</a></li>
						</ul>
					</li>
					</ul>	
				</nav>
			</div>
		</aside>

        <?php
		if(!empty($tela)){
			switch($tela){
				case 'newedu':
					echo '
                    <main class="ls-main ">
                        <div class="container-fluid">
                            <h1 class="ls-title-intro ls-ico-plus">Educandos</h1>
                            '.$newedu.'
                        </div>
                    </main>';
                break;

                case 'newtur':
					echo '
                    <main class="ls-main ">
                        <div class="container-fluid">
                            <h1 class="ls-title-intro ls-ico-plus">Turmas</h1>
                            '.$newtur.'
                        </div>
                    </main>';
                break;

                case 'newvol':
					echo '
                    <main class="ls-main ">
                        <div class="container-fluid">
                            <h1 class="ls-title-intro ls-ico-plus">Voluntários</h1>
                            '.$newvol.'
                        </div>
                    </main>';
                break;
                
                case 'newpro':
					echo '
                    <main class="ls-main ">
                        <div class="container-fluid">
                            <h1 class="ls-title-intro ls-ico-plus">Profissionais</h1>
                            '.$newpro.'
                        </div>
                    </main>';
				break;

				case 'newati':
				    echo '
					<main class="ls-main ">
						<div class="container-fluid">
							<h1 class="ls-title-intro ls-ico-plus">Tipos de Atividade</h1>
							'.$newati.'
						</div>
					</main>';
                break;
                
                case 'newmat':
				    echo '
					<main class="ls-main ">
						<div class="container-fluid">
							<h1 class="ls-title-intro ls-ico-plus">Tipos de Material</h1>
							'.$newmat.'
						</div>
					</main>';
			    break;

				case 'newrec':
					echo '
                    <main class="ls-main ">
                        <div class="container-fluid">
                            <h1 class="ls-title-intro ls-ico-plus">Tipos de Receita</h1>
                            '.$newrec.'
                        </div>
                    </main>';
				break;

				case 'newdes':
					echo '
                    <main class="ls-main ">
                        <div class="container-fluid">
                            <h1 class="ls-title-intro ls-ico-plus">Tipos de Despesa</h1>
                            '.$newdes.'
                        </div>
                    </main>';
				break;

                case 'newcon':
					echo '
                    <main class="ls-main ">
                        <div class="container-fluid">
                            <h1 class="ls-title-intro ls-ico-plus">Contas Bancárias</h1>
                            '.$newcon.'
                        </div>
                    </main>';
				break;
                
				case 'newver':
					echo '
                    <main class="ls-main ">
                        <div class="container-fluid">
                            <h1 class="ls-title-intro ls-ico-plus">Tipos de Verba</h1>
                            '.$newver.'
                        </div>
                    </main>';
				break;
				
				case 'atendedu':
					echo '
                    <main class="ls-main ">
                        <div class="container-fluid">
                            <h1 class="ls-title-intro ls-ico-pencil">Atendimento</h1>
                            '.$atendedu.'
                        </div>
                    </main>';
                break;

                case 'calendadm':
					echo '
                    <main class="ls-main ">
                        <div class="container-fluid">
                            <h1 class="ls-title-intro ls-ico-attachment">Calendário</h1>
                            '.$calendadm.'
                        </div>
                    </main>';
				break;
				
				case 'entradm':
					echo '
                    <main class="ls-main ">
                        <div class="container-fluid">
                            <h1 class="ls-title-intro ls-ico-attachment">Entrada de Materiais</h1>
                            '.$entradm.'
                        </div>
                    </main>';
                break;

                case 'config':
                    echo '
                    <main class="ls-main ">
                        <div class="container-fluid">
                            <h1 class="ls-title-intro ls-ico-cog">Configurações</h1>
                            '.$config.'
                        </div>
                    </main>';
            }
        }
        ?>
        <div class="ls-modal" id="alertasModal">
            <div class="ls-modal-box">
                <div class="ls-modal-header">
                    <h4 class="ls-modal-title" id="alertasModalTitulo">Titulo</h4>
                </div>
                <div class="ls-modal-body" id="alertasModalBody">
                        <b id="alertasModalTexto" class="ls-label-text">Texto</b>
                </div>
                <div class="ls-modal-footer">
                    <input type="button" class="ls-btn" style="visibility:hidden">
                    <input type="button" id="btnFechaAlerta" class="ls-btn ls-float-right" onclick="fechaAlerta()" value="Fechar">
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function fechaAlerta()
            {
                $("#alertasModal").hide();
            }
        </script>
		
		<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>

        <!-- JS dependencies -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="../utils/locastyle/javascripts/locastyle.js" type="text/javascript"></script>
        <!-- Bootstrap 4 dependency -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

        <!-- bootbox code -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
		
	  </body>
	</html>