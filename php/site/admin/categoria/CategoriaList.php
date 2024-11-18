<?php
 include "../db.class.php";

    $db = new db();

    $dados = $db->all();

?>
<h4>Listagem de Categoria</h4>
<table>
    <thead>
        <th>ID</th>
        <th>Nome</th>
    </thead>
    <tbody>
        <tr>
            <?php
                foreach ($dados as $item){
                    echo "
                        <td>$item->id</td>
                        <td>$item->nome</td>
                    ";
                }
            ?>
        </tr>
    </tbody>
</table>