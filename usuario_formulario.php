<html>
    <head>
        <title>Usuário | Projeto para Web com PHP</title>
        <link rel="stylesheet"
              href="lib/bootstrap-4.2.1-dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php include 'includes/topo.php'; ?>
                </div>
            </div>
            <div class="row" style="min-height: 500px;">
                <div class="col-md-12">
                    <?php include 'includes/menu.php'; ?>
                </div>
                <div class="col-md-10" style="padding-top: 50px;">
                    <?php
                        require_once 'includes/funcoes.php';
                        require_once 'core/conexao_mysql.php';
                        require_once 'core/sql.php';
                        require_once 'core/mysql.php';

                        if(isset($_SESSION['login'])) {
                            $id = (int) $_SESSION['login']['usuario']['id'];

                            $criterio = [
                                ['id', '=', $id] // o id do banco ser igual o id do usuario
                            ];

                            $retorno = buscar (
                                'usuario',
                                ['id', 'nome','email'], //vai ter só 1 resultado (por id)
                                $criterio
                            );

                            $entidade = $retorno[0]; // a primeira linha do retorno
                        }
                    ?>
                    <h2>Usuário</h2>
                    <form method="post" action="core/usuario_repositorio.php">
                        <input type="hidden" name="acao"
                               value="<?php echo empty($id) ? 'insert' : 'update' ?>"><!-- o ? age como um "if"
                               o que esta a esquerda é caso seja verdade, o que esta a direita é falso-->
                        <input type="hidden" name="id"
                               value="<?php echo $entidade['id'] ?? '' ?>"> <!-- Uma maneira mais redundante,
                            o caso seja verdade é a propia comparação, e o falso é apos as 2 interrogações-->
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input class="form-control" type="text"
                                required id="nome" name="nome"
                                value="<?php echo $entidade['nome'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="text"
                                required id="email" name="email"
                                value="<?php echo $entidade['email'] ?? '' ?>">
                        </div> 
                        <?php if(!isset($_SESSION['login'])): //começa um if php, que tem final depois ?> 
                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input class="form-control" type="password"
                                required id="senha" name="senha">
                        </div>
                        <?php endif; ?>
                        <div class="text-right">
                            <button class="btn btn-success"
                                     type="submit">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php
                        include 'includes/rodape.php';
                    ?>
                </div>
            </div>
        </div>
        <script src="lib/bootstrap-4.2.1-dist/js/bootstrap.min.js"></script>
    </body>
</html>