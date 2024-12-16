<?php
 include "../db.class.php"; 
 include_once "../header.php";
    $db = new db('post');

    $db->checkLogin();

    if(!empty($_GET['id'])){
        $db->destroy($_GET['id']);
        header('Location:PostList.php');
    }

    if(!empty($_POST)){
        $dados = $db->search($_POST);
    } else {
        $dados = $db->all();
    }

?>
<h4>Listagem de Post</h4>

<form action="./PostList.php" method="post">
    <div class="row">
        <div class="col-3">
            <select class="form-select" name="tipo">
                <option value="nome">Nome</option>
            </select>
        </div>
        <div class="col-4">
            <input class="form-control" type="text" name="valor">
        </div>
        <div class="d-flex col-4 gap-2">
            <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
    
            <a class="btn btn-success" href='./PostForm.php'><i class="fa-solid fa-plus"></i> Cadastrar</a><br>
        </div>
    </div>
</form>

<table class="table table-striped table-hover">
    <thead>
        <th scope="col">ID</th>
        <th scope="col">Titulo</th>
        <th scope="col">Data Publicação</th>
        <th scope="col">Status</th>
        <th scope="col">Categoria</th>
        <th scope="col">Ação</th>
        <th scope="col">Ação</th>
    </thead>
    <tbody>
        <tr>
            <?php
                foreach ($dados as $item){

                    $data_publicacao = date('d/m/Y H:i', strtotime($item->data_publicacao));
                   
                    $categoria = $db->find("categoria",$item->categoria_id);
                    // var_dump($categoria);
                    // exit;

                    echo "
                    <tr>
                        <td>$item->id</td>
                        <td>$item->titulo</td>
                        <td>$data_publicacao</td>
                        <td>$item->status</td>
                        <td>$categoria->nome</td>
                        <td><a class='btn btn-warning' href='./PostForm.php?id=$item->id'><i class='fa-solid fa-pen-to-square'></i></a></td>
                        <td><a class='btn btn-danger' onclick='return confirm(\"Deseja Excluir? \")' href='./PostList.php?id=$item->id'><i class='fa-solid fa-trash'></i></a></td>
                    </tr>
                    ";
                }
            ?>
        </tr>
    </tbody>
</table>

<?php include_once "../footer.php" ?>