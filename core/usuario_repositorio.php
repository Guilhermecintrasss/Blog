<?php
session_start();
require_once '../includes/funcoes.php';
require_once 'conexao_mysql.php';
require_once 'sql.php';
require_once 'mysql.php';
$salt = 'ifsp';

foreach($_POST as $indice => $dado){
    $$indice = limparDados($dado); // vai criando todas as variais de acordo com o nome delas
}

foreach($_GET as $indice => $dado){
    $$indice = limparDados($dado);
}
switch($acao){
    case 'insert':
        $dados =[
            'nome' => $nome, // por isso aqui usamos $nome, ela foi criada automaticamente no limparDados($dado)
            'email' => $email,
            'senha' => crypt($senha,$salt)
            ];

            insere(
                'usuario',
                $dados
            );
            

            break;
    case 'update':
        $id = (int)$id;
        $dados = [
            'nome' => $nome,
            'email' => $email
        ];

        $criterio = [
            ['id', '=', $id]
        ];

        atualiza(
            'usuario',
            $dados,
            $criterio
        );

        break;
        case 'login':
            $criterio = [
                ['email', '=', $email],
                ['AND', 'ativo', '=', 1]
                ];

        $retorno = buscar(
            'usuario',
            ['id','nome','email','senha','adm'],
            $criterio
        );

        if(count($retorno) > 0){
            if(crypt($senha,$salt) == $retorno[0]['senha']){ // verifica a senha pela criptografia
                $_SESSION['login']['usuario'] = $retorno[0]; // cria a variavel tipo Session "['login']['usuario']'
                // ela simplesmente serve como um login
                if(!empty($_SESSION['url_retorno'])){ // se a url for diferente de vazio, ela vai fazer que o usuario seja direcionado para ela
                    header('Location:' . $_SESSION['url_retorno']);
                    $_SESSION['url_retorno'] = '';
                    exit;
                }
            }
        }

    break;
    case 'logout':
    session_destroy();
    break;

        case 'status':
            $id = (int)$id;
            $valor = (int)$valor;

        $dados = [
            'ativo'=> $valor
            ];

        $criterio = [
            ['id','=', $id]
            ];

        atualiza(
            'usuario',
            $dados,
            $criterio
        );

        header('Location: ../usuarios.php');
        exit;
        break;
    case 'adm':
        $id = (int)$id;
        $valor = (int)$valor;
        
        $dados = [
            'adm'=> $valor
            ];

        $criterio = [
           ['id','=',$id] 
            ];

        atualiza(
            'usuario',
            $dados,
            $criterio
        );

        header('Location: ../usuarios.php');
        exit;
        break;


}
header ('Location: ../index.php');
?>