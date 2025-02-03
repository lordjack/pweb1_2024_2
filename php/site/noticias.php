<?php
 include "./header.php";
 include "./admin/db.class.php";
?>

<div class="row">
    <div class="col">
        <h2>Notícias</h2>
        
        <?php

            $db = new db('post');
            $posts = $db->all();

            foreach($posts as $item){
                echo "<h2>$item->titulo</h2>";
                echo "<h6>Publicado em: ".date('d/m/Y H:i', strtotime($item->data_publicacao))."</h6>";
                echo "<p>$item->texto</p>";
            }
        ?>
    </div>
</div>


<?php
 include "./footer.php";
?>