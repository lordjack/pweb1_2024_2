<?php
    include "./db.class.php";
    include_once "./header.php";

    $db = new db('categoria');
    $db->checkLogin(); // Verificação de login do usuário administrativo
  
    // Contagem de postagens
    $postCount = $db->query("SELECT COUNT(*) as total FROM post")->fetchObject()->total;
    // Contagem de categorias
    $categoryCount = $db->query("SELECT COUNT(*) as total FROM categoria")->fetchObject()->total;

/*
    $result = $db->query("SELECT data_publicacao FROM post ORDER BY data_criacao DESC LIMIT 1");
    $lastPost = $result->fetchObject();

    // A data da última postagem
    $lastPostDate = $lastPost->data_publicacao;

    // Criar objetos DateTime para a data atual e a data da última postagem
    $currentDate = new DateTime(); // Data atual
    $lastPostDateTime = new DateTime($lastPostDate); // Data da última postagem

    // Calcular a diferença entre as duas datas
    $interval = $currentDate->diff($lastPostDateTime);
*/
?>

<div class="container mt-5">

    <div class="row">
        <div class="col-12 mb-4">
            <h2>Bem-vindo ao Painel Administrativo</h2>
            <p>Controle completo do seu blog. Selecione uma das opções abaixo para começar.</p>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Postagens</h5>
                    <p class="card-text">Total de postagens no sistema</p>
                    <h3 class="display-4"><?php echo $postCount; ?></h3>
                    <a href="PostList.php" class="btn btn-light mt-3">Ver Postagens</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Categorias</h5>
                    <p class="card-text">Total de categorias cadastradas</p>
                    <h3 class="display-4"><?php echo $categoryCount; ?></h3>
                    <a href="CategoriaList.php" class="btn btn-light mt-3">Ver Categorias</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Configurações</h5>
                    <p class="card-text">Acesse as configurações do sistema</p>
                    <a href="#" class="btn btn-light mt-3">Ver Configurações</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Resumo das Atividades Recentes</h5>
                </div>
                <div class="card-body">
                    <p>Você pode incluir gráficos, atividades recentes ou qualquer outra informação importante aqui.</p>
                    <div class="alert alert-info">
                        Exemplo: Última postagem criada há 2 dias<?php // echo $interval->days . " dias, " . $interval->h . " horas, " . $interval->i . " minutos e " . $interval->s . " segundos.";?>.
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include_once "../footer.php" ?>
