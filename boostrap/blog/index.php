<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog Aula Pweb1 - 2024-2</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/style.css">
  <?php
  include_once "../../php/site/admin/db.class.php";

  $db = new db('post');

  $dados = $db->all();
  ?>
</head>

<body>
  <div class="container">
    <header class="blog-header py-3">
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
          <a class="link-secondary" href="#">Se Inscreva</a>
        </div>
        <div class="col-4 text-center">
          <a class="display-6 link-secondary fw-bold" href="#">Oeste News</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
          <a class="btn btn-outline-secondary" href="#">Cadastrar</a>
        </div>
      </div>
      <div class="nav-scroller py-1 mb-2">
        <nav class="nav flex justify-content-between">
          <a class="p-2 link-secondary" href="#">Mundo</a>
          <a class="p-2 link-secondary" href="#">Brasil</a>
          <a class="p-2 link-secondary" href="#">Tecnologia</a>
          <a class="p-2 link-secondary" href="#">Desing</a>
          <a class="p-2 link-secondary" href="#">Cultura</a>
          <a class="p-2 link-secondary" href="#">Negócios</a>
          <a class="p-2 link-secondary" href="#">Politica</a>
          <a class="p-2 link-secondary" href="#">Opniões</a>
          <a class="p-2 link-secondary" href="#">Ciência</a>
          <a class="p-2 link-secondary" href="#">Saúde</a>
          <a class="p-2 link-secondary" href="#">Estilo</a>
          <a class="p-2 link-secondary" href="#">Viagens</a>
        </nav>
      </div>
    </header>

    <main class="container">
      <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
        <div class="col-md-6 px-0">
          <h1 class="display-4 fst-italic">Titulo de uma postagem de blog mais longa</h1>
          <p class="lead">Multiplas linhas de texto para forma o lede, informando qualquer texto aqui.</p>
          <p class="lead"><a class="text-white fw-bold" href="#">Continue lendo...</a></p>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
              <div class="col-md-8">
                <div class="card-body">
                  <strong class="d-inline-block mb-2 text-primary">Mundo</strong>
                  <h3 class="card-title fw-bold">Postagem em destaque</h3>
                  <small class="text-body-secondary">14 Out</small>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="stretched-link">Continue lendo</a>
                </div>
              </div>
              <div class="col-md-4">
                <img src="img/direito_aluno.jpg" class="img-fluid rounded-start" alt="...">
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">

          <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
              <div class="col-md-8">
                <div class="card-body">
                  <strong class="d-inline-block mb-2 text-success">Design</strong>
                  <h5 class="card-title fw-bold">Titulo de postagem</h3>
                    <small class="text-body-secondary">21 Out</small>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="stretched-link">Continue lendo</a>
                </div>
              </div>
              <div class="col-md-4">
                <img src="img/direito_aluno.jpg" class="img-fluid rounded-start" alt="...">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-8">
          <?php
          foreach ($dados as $item) {

            if ($item->status == "SIM") {

              $data_publicacao = date('d/m/Y H:i', strtotime($item->data_publicacao));

              $categoria = $db->find("categoria", $item->categoria_id);

              echo "
                            <article class='blog-post'>
                              <h2 class='blog-post-title'>$item->titulo</h2>
                              <p class='blog-post-meta'>$data_publicacao <a href='#'>Categoria: $categoria->nome</a></p>
                              <p style='text-align:justify'>$item->texto</p>
                            </article>
                          ";
            }
          }
          ?>

          <h3 class="pb-4 mb-4 fst-italic border-botton">Chapecó e Região</h3>


          <br>
          <br>
          <article class="blog-post">
            <h2 class="blog-post-title">Postagem de exemplo 02</h2>
            <p class="blog-post-meta">23 Setembro, 2024 <a href="#">Jack</a></p>
            <p style="text-align:justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tincidunt metus ac felis mollis, sed cursus mi elementum. Sed ultrices, est non ornare ullamcorper, sem metus aliquet lectus, quis molestie urna enim sit amet purus. Sed viverra purus erat, luctus ultricies mauris gravida id. Morbi vestibulum nunc tortor, a tempus ex finibus ut. Quisque auctor imperdiet orci, vitae pharetra sem lacinia vitae. Praesent pretium eros nunc, a laoreet ipsum semper et. Praesent sit amet laoreet turpis. Phasellus efficitur varius congue. Vestibulum convallis mauris sit amet eros viverra dapibus. In efficitur dictum est vitae vehicula. Ut pretium libero ligula, ut ullamcorper sem cursus posuere. Proin vel auctor dolor, non tristique urna.</p>
            <p style="text-align:justify">Mauris auctor viverra convallis. Aenean gravida dui in quam rutrum laoreet. Sed a velit et ligula lacinia ornare. Sed pellentesque magna nulla, ac ullamcorper metus fringilla nec. Pellentesque vel mi scelerisque, lacinia neque eu, rhoncus mi. Etiam consectetur erat ut dolor gravida pharetra. Aliquam pretium odio at tellus ullamcorper elementum. Integer porta lectus vel dignissim gravida. Morbi nec suscipit nisl. Mauris tempor justo eu elit mollis, quis blandit felis finibus. Donec aliquam dolor volutpat turpis viverra, eu vulputate libero posuere. Proin et suscipit nisl, a condimentum lectus.</p>

            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">First</th>
                  <th scope="col">Last</th>
                  <th scope="col">Handle</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fat</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td colspan="2">Larry the Bird</td>
                  <td>@twitter</td>
                </tr>
              </tbody>
            </table>

          </article>

          <article class="blog-post">
            <h2 class="blog-post-title">Postagem 03 - Novo recurso</h2>
            <p class="blog-post-meta">Dezembro 14, 2022 por <a href="#">Chaves</a></p>
            <p style="text-align: justify;">
              Este é um conteúdo de espaço reservado de parágrafo adicional. Ele foi escrito para preencher o espaço disponível e mostrar como um trecho de texto mais longo afeta o conteúdo ao redor. Repetiremos com frequência para manter o fluxo da demonstração, portanto, fique atento a essa mesma sequência de texto.
            </p>
            <ul>
              <li>Primeiro item da lista</li>
              <li>Segundo item da lista com uma descrição mais longa</li>
              <li>Terceiro item da lista para fechá-la</li>
            </ul>
            <p>Este é um conteúdo de espaço reservado de parágrafo adicional. É uma versão um pouco mais curta do outro corpo de texto altamente repetitivo usado por toda parte.</p>
          </article>

          <nav class="py-4">
            <a class="btn btn-outline-primary rounded-4" href="#">Anteriores</a>
            <a class="btn btn-outline-secondary disabled rounded-4" href="#">Próximos</a>
          </nav>


        </div>
        <div class="col-md-4">
          <!-- Comentário  aqui!-->
          <div class="position-sticky top-0">
            <div class="p-4 mb-3 bg-light rounded">
              <h4 class="fst-italic">Sobre</h4>
              <p class="mb-0" style="text-align:justify">Personalize esta seção para contar um pouco
                aos seus visitantes sobre sua publicação, escritores,
                conteudo ou algo complementar difrente.
                Totalmente para você</p>
            </div>


            <div class="p-4">
              <h4 class="fst-italic">Arquivos</h4>
              <ol class="list-unstyled mb-0">
                <li><a href="#">Outubro 2024</a></li>
                <li><a href="#">Setembro 2024</a></li>
                <li><a href="#">Agosto 2024</a></li>
                <li><a href="#">Julho 2024</a></li>
                <li><a href="#">Junho 2024</a></li>
                <li><a href="#">Maio 2024</a></li>
                <li><a href="#">Abril 2024</a></li>
                <li><a href="#">Março 2024</a></li>
                <li><a href="#">Fevereiro 2024</a></li>
                <li><a href="#">Janeiro 2024</a></li>
                <li><a href="#">Dezembro 2023</a></li>
              </ol>
            </div>

            <div class="p-4">
              <h4 class="fst-italic">Links Úteis</h4>
              <ol class="list-unstyled mb-0">
                <li><a href="#"><i class="fa-brands fa-github"></i> Github</a></li>
                <li><a href="#"><i class="fa-brands fa-twitter"></i> Twitter</a></li>
                <li><a href="#"><i class="fa-brands fa-facebook"></i> Facebook</a></li>
              </ol>
            </div>

          </div>

        </div>
      </div>

    </main>

  </div>

  <footer class="p-2 bg-light border-top text-center">
    <div class="p-4 text-secondary">
      <p>Todos os direitos reservados <a href="#">Oeste News</a>
        por <a href="#">@oestenews</a>.</p>
      <p><a href="#">Voltar ao top</a></p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>