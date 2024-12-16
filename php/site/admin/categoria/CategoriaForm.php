<?php
 include "../db.class.php";
 include_once "../header.php";

    $db = new db('categoria');
    $db->checkLogin();

    if(!empty($_POST)){
        if(empty($_POST['id'])) {
            $db->insert($_POST);
            echo "<div class='alert alert-success'>Registro criado com sucesso</div>";
        }  else {
            $db->update($_POST);
            echo "<div class='alert alert-success'>Registro atualizado com sucesso</div>";
        }
        header("location: CategoriaList.php");
    }

    if(!empty($_GET['id'])){
        $data = $db->find($_GET['id']);
    }
?>

<div class="container mt-5">
    <h4 class="mb-4">Formulário Categoria</h4>

    <form action="CategoriaForm.php" method="post">

        <input type="hidden" name="id" value="<?php echo $data->id ?? ""; ?>">

        <div class="mb-3 col-4">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="<?php echo $data->nome ?? ""; ?>" required>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href='./CategoriaList.php' class="btn btn-secondary">Voltar</a>
        </div>

    </form>
</div>

<?php include_once "../footer.php" ?>
