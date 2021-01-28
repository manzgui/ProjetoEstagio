<html class="ls-theme-gray  ls-browser-chrome ls-window-lg ls-screen-lg">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>Tela de Login</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="./utils/locastyle/stylesheets/locastyle.css" rel="stylesheet" type="text/css">
    <style type="text/css">
		.vis-erro{
            visibility:hidden;
        }
        .msg-erro{
            text-align:center;
            display:block;
            padding-top:5px;
        }
	</style>
</head>
<body>
    <?php
		session_start();
        include_once './carrega_controllers.php';
        $nome = '';
        $empresa = '';
        $codfunc = '';
        if(isset($_POST['txtLogin']) && empty($_POST['txtLogin']))
            $resposta = 'Acesso negado. Login deve ser informado.';
        else
        if(isset($_POST['txtSenha']) && empty($_POST['txtSenha']))
            $resposta = 'Acesso negado. Senha deve ser informada.';
        else
        if(isset($_POST['txtLogin']) && isset($_POST['txtSenha']) && !empty($_POST['txtLogin']) && !empty($_POST['txtSenha'])){
            //POST login/senha
            $login = $_POST['txtLogin'];
            $senha = $_POST['txtSenha'];
            $cLogin = new CLogin(new MLogin());
            $cLogin->defineLogin($login, $senha);
            if($cLogin->autentica($nome, $empresa, $codfunc)){
                $_SESSION['usuario_ea'] = $login;
                $_SESSION['senha_ea'] = $senha;
                $_SESSION['codfunc'] = $codfunc;
                $_SESSION['fun_nome'] = $nome;
                $_SESSION['empresa'] = $empresa;
            }else
                    $nome = 'Acesso negado. Login e/ou usuário inválidos.';
        }
        if(!isset($_SESSION['usuario_ea']) || empty($_SESSION['usuario_ea']))
        {
            echo '<div class="ls-login-parent">
                    <div class="ls-login-inner">
                        <div class="ls-login-container">
                            <div class="ls-login-box">
                                <h1 class="ls-login-logo ls-ico-pencil2"> Gerencianz</h1>
                                <form class="ls-form ls-login-form" method="POST">
                                    <fieldset>
                                        <label class="ls-label">
                                            <b class="ls-label-text ls-hidden-accessible">Usuário</b>
                                            <input class="ls-login-bg-user ls-field-lg" type="text" placeholder="Usuário" autofocus="" id="txtLogin" name="txtLogin" value="">
                                        </label>
                                        <label class="ls-label">
                                            <b class="ls-label-text ls-hidden-accessible">Senha</b>
                                            <div class="ls-prefix-group ls-field-lg">
                                            <input id="txtSenha" name="txtSenha" class="ls-login-bg-password" type="password" placeholder="Senha" value="">
                                            <a class="ls-label-text-prefix ls-toggle-pass ls-ico-eye" data-toggle-class="ls-ico-eye, ls-ico-eye-blocked" data-target="#txtSenha" href="#"></a>
                                            </div>
                                        </label>
                                        <button class="ls-btn-primary ls-btn-block ls-btn-lg" type="submit">Entrar</button>
                                        <small class="msg-erro" id="erroSenha">'.$nome.'</small>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        else //redireciona para menu de telas
            header('Location: ./site/index.php');

    ?>
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="./utils/locastyle/javascripts/locastyle.js" type="text/javascript"></script>
</body>
</html>