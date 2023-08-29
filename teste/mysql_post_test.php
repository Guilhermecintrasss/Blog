<?php
require_once '../includes/funcoes.php';
require_once '../core/conexao_mysql.php';
require_once '../core/sql.php';
require_once '../core/mysql.php';

insert_teste ('PostDoMaumau', 'Poxa mau, podia ser melhor', '1',date('Y-m-d H:i:s'));
//buscar_teste();
// update_teste(38, 'murilo', 'silva@gmail.com');
// buscar_teste();

//Teste inserção banco de dados
function insert_teste($titulo, $texto, $usuario_id,$data_post): void{
    $dados = ['titulo' => $titulo, 'texto' => $texto, 'usuario_id' => $usuario_id,
     'data_postagem' => $data_post];
    insere ('post', $dados);
}

//Teste select banco de dados
/*function buscar_teste(): void{
    $post = buscar('post',['id', 'titulo', 'texto', 'usuario_id'], [], '');
    print_r($post);
}

//Teste update banco de dados
function update_teste($id, $nome, $email): void{
    $dados = ['nome' => $nome, 'email' => $email];
    $criterio = [['id', '=', $id]];
    atualiza('usuario', $dados, $criterio);
}*/
?>
