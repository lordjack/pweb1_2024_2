<?php
 include "../db.class.php";

    $db = new db();

    if(!empty($_POST)){
        $db->insert($_POST);
        echo "<b>Registro inserido com sucesso</b>";
        header("location: CategoriaList.php");
    }

?>

<form action="CategoriaForm.php" method="post">
    
    <h4>Formulário Categoria</h4>

    <label for="">Nome</label> <br>
    <input type="text" name="nome"> <br>

    <button type="submit">Salvar</button>
    <a href='./CategoriaList.php'>Voltar</a><br>

</form>