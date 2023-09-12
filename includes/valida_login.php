<?php
    $_SESSION['url_retorno'] = $_SERVER['PHP_SELF']; // vai setar a URL de retorno, ou seja
    // vai gravar onde estava antes, porque logo abaixo voce vai ser redirecionado para o login
    //dessa forma, toda vez que voce tentar fazer algo que só é permitido logado, vc é direcionado para o login
    // e depois de logado, vai automaticamente para a pagina que estava antes usando esse "url_retorno"

    if(!isset($_SESSION['login'])){
        header('Location: login_formulario.php');
        exit;
    }
?>