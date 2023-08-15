<?php
require_once '../includes/funcoes.php';
require_once '../core/conexao_mysql.php';
require_once '../core/sql.php';
require_once '../core/mysql.php';

insert_teste ('10', 'Adorei','1','3');
buscar_teste();
update_teste(1, '2', 'Bem ruimzinho','1','3');
buscar_teste();

function insert_teste($nota, $comentario, $usuario_id, $post_id): void{

    $dados = ['nota' => $nota, 'comentario' => $comentario, 'usuario_id' => $usuario_id, 'post_id' => $post_id]; 
    insere ('avaliacao', $dados);
}
function buscar_teste(): void{
    $avaliacoes = buscar('avaliacao',['id', 'nota', 'comentario', 'usuario_id', 'post_id'], [], '');
    print_r($avaliacoes);
}

function update_teste($id, $nota, $comentario, $usuario_id, $post_id): void{

    $dados = ['nota' => $nota, 'comentario' => $comentario, 'usuario_id' => $usuario_id, 'post_id' => $post_id];
    $criterio = [['id', '=', $id]];
    atualiza('avaliacao', $dados, $criterio);
}




?>