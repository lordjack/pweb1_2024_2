<?php
 include "../db.class.php";

    $db = new db('post');

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

    <div>
        <select name="tipo">
            <option value="nome">Nome</option>
        </select>
        <input type="text" name="valor">
        <button type="submit">Buscar</button>
        <a href='./PostForm.php'>Cadastrar</a><br>
    </div>

</form>

<table>
    <thead>
        <th>ID</th>
        <th>Titulo</th>
        <th>Data Publicação</th>
        <th>Status</th>
        <th>Categoria</th>
        <th>Ação</th>
        <th>Ação</th>
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
                        <td><a href='./PostForm.php?id=$item->id'>Editar</a></td>
                        <td><a onclick='return confirm(\"Deseja Excluir? \")' href='./PostList.php?id=$item->id'>Deletar</a></td>
                    </tr>
                    ";
                }
            ?>
        </tr>
    </tbody>
</table>