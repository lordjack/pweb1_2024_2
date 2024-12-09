<?php
 include "../db.class.php";

    $db = new db('post');

    $db->checkLogin();

    $categorias = $db->all('categoria');

   // var_dump($categorias);
   // exit;

    if(!empty($_POST)){

        if(empty($_POST['id'])) {
            $db->insert($_POST);
            echo "<b>Registro criado com sucesso</b>";
        }  else {
            $db->update($_POST);
            echo "<b>Registro atualizado com sucesso</b>";
        }

        header("location: PostList.php");
    }

    if(!empty($_GET['id'])){
        $data = $db->find('post',$_GET['id']);
        //var_dump($data);
        //exit;
    }

?>

<form action="PostForm.php" method="post">
    
    <h4>Formulário Post</h4>

    <a href='../Login.php?logout=true' style="float: right;">Sair</a><br>

    <input type="hidden" name="id"
        value="<?php echo $data->id ?? "" ?>"    
    >

    <label for="">Titulo</label> <br>
    <input type="text" name="titulo"
        value="<?php echo $data->titulo ?? "" ?>"
    ><br>
    
    <label for="">Data Publicação</label> <br>
    <input type="datetime-local" name="data_publicacao"
        value="<?php echo $data->data_publicacao ?? "" ?>"
    ><br>
    <label for="">Status</label> <br>
    <?php 
        echo $data->status;
    ?>
    <select name="status">
        <option <?php !empty($data->status) && $data->status ==="SIM" ? "selected" :""?> value="SIM">SIM</option>
        <option <?php !empty($data->status) && $data->status ==="NAO" ? "selected" :""?> value="NAO">NÃO</option>
    </select><br>

    <label for="">Categoria</label> <br>
    <select name="categoria_id">
        <?php
            foreach($categorias as $categoria){
                $selected = $categoria->id == $data->categoria_id ? "selected": "";

                echo "<option $selected value='$categoria->id'>$categoria->nome</option>";
            }
        ?>
    </select><br>

    <label for="">Texto</label> <br>
    <textarea name="texto" rows="4"><?php echo $data->texto ?? "" ?></textarea><br>


    <button type="submit">Salvar</button>
    <a href='./PostList.php'>Voltar</a><br>

</form>