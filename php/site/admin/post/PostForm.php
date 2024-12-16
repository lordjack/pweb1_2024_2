<?php
include "../db.class.php";
include_once "../header.php";

$db = new db('post');
$db->checkLogin();

$categorias = $db->all('categoria');

// Verificação de POST
if (!empty($_POST)) {
    if (empty($_POST['id'])) {
        $db->insert($_POST);
        echo "<div class='alert alert-success'><b>Registro criado com sucesso</b></div>";
    } else {
        $db->update($_POST);
        echo "<div class='alert alert-success'><b>Registro atualizado com sucesso</b></div>";
    }
    header("location: PostList.php");
}

// Verificação de GET (para editar)
if (!empty($_GET['id'])) {
    $data = $db->find('post', $_GET['id']);
}
?>

<div class="container mt-5">
    <form action="PostForm.php" method="post">
        <h4 class="mb-4">Formulário Post</h4>

        <input type="hidden" name="id" value="<?php echo $data->id ?? "" ?>">

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" id="titulo" value="<?php echo $data->titulo ?? "" ?>">
        </div>

        <div class="row mb-3">

            <div class="col-md-4">
                <label for="categoria_id" class="form-label">Categoria</label>
                <select name="categoria_id" class="form-select" id="categoria_id">
                    <?php
                    foreach ($categorias as $categoria) {
                        $selected = $categoria->id == $data->categoria_id ? "selected" : "";
                        echo "<option $selected value='$categoria->id'>$categoria->nome</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-4">
                <label for="data_publicacao" class="form-label">Data Publicação</label>
                <input type="datetime-local" name="data_publicacao" class="form-control" id="data_publicacao" value="<?php echo $data->data_publicacao ?? "" ?>">
            </div>

            <div class="col-md-4">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-select" id="status">
                    <option <?php !empty($data->status) && $data->status === "SIM" ? "selected" : "" ?> value="SIM">SIM</option>
                    <option <?php !empty($data->status) && $data->status === "NAO" ? "selected" : "" ?> value="NAO">NÃO</option>
                </select>
            </div>
            
        </div>

        <div class="mb-3">
            <label for="texto" class="form-label">Texto</label>
            <textarea name="texto" class="form-control" id="texto" rows="4"><?php echo $data->texto ?? "" ?></textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href='./PostList.php' class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</div>

<?php include_once "../footer.php"; ?>
