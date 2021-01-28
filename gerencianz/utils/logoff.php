<?php
    session_start();
    unset($_SESSION['usuario_ea']);
    unset($_SESSION['senha_ea']);
    unset($_SESSION['fun_nome']);
    session_destroy();
    header('Location: ../login.php');
?>