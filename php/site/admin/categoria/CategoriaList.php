    <?php
    include "../db.class.php";
    include_once "../header.php";

    $db = new db('categoria');
    $db->checkLogin();

    if (!empty($_GET['id'])) {
        $db->destroy($_GET['id']);
        header('Location: CategoriaList.php');
    }

    if (!empty($_POST)) {
        $dados = $db->search($_POST);
    } else {
        $dados = $db->all();
    }
    ?>

    <!-- Título -->
    <div class="container mt-5">
        <h4>Listagem de Categoria</h4>

        <!-- Formulário de busca -->
        <form action="./CategoriaList.php" method="post" class="mb-4">
            <div class="row">
                <div class="col-md-2">
                    <select name="tipo" class="form-select">
                        <option value="nome">Nome</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" name="valor" class="form-control" placeholder="Pesquisar">
                </div>

                <div class="d-flex col-4 gap-2">
                    <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
            
                    <a class="btn btn-success" href='./CategoriaForm.php'><i class="fa-solid fa-plus"></i> Cadastrar</a><br>
                </div>
            </div>
        </form>

        <!-- Tabela de Categorias -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Ação</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($dados as $item) {
                    echo "
                    <tr>
                        <th scope='row'>$item->id</th>
                        <td>$item->nome</td>
                        <td ><a class='btn btn-warning' href='./CategoriaForm.php?id=$item->id'><i class='fa-solid fa-pen-to-square'></i></a></td>
                        <td ><a class='btn btn-danger' onclick='return confirm(\"Deseja Excluir? \")' href='./CategoriaList.php?id=$item->id'><i class='fa-solid fa-trash'></i></a></td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include_once "../footer.php"; ?>
