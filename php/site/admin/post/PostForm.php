<?php
include "../db.class.php";
include_once "../header.php";

$db = new db('post');
$db->checkLogin();

$categorias = $db->all('categoria');
$data = null;
$errors = [];
$success = '';

// Verificação de POST com validação simplificada
if (!empty($_POST)) {
    // Validações básicas
    if (empty(trim($_POST['titulo']))) {
        $errors[] = "Título é obrigatório";
    }

    if (empty($_POST['categoria_id'])) {
        $errors[] = "Categoria é obrigatória";
    }

    if (empty(trim($_POST['texto']))) {
        $errors[] = "Texto é obrigatório";
    }

    // Se não há erros, processa
    if (empty($errors)) {
        try {
            // Sanitização básica dos dados
            $postData = [
                'titulo' => trim($_POST['titulo']),
                'categoria_id' => $_POST['categoria_id'],
                'data_publicacao' => !empty($_POST['data_publicacao']) ? $_POST['data_publicacao'] : date('Y-m-d H:i:s'),
                'status' => $_POST['status'] ?? 'SIM',
                'texto' => trim($_POST['texto'])
            ];

            if (empty($_POST['id'])) {
                $db->insert($postData);
                $success = "Registro criado com sucesso!";
            } else {
                $postData['id'] = $_POST['id'];
                $db->update($postData);
                $success = "Registro atualizado com sucesso!";
            }

            // Redirecionamento após sucesso
            echo "<script>setTimeout(() => window.location.href = 'PostList.php', 1500);</script>";
        } catch (Exception $e) {
            $errors[] = "Erro ao salvar: " . $e->getMessage();
        }
    }
}

// Verificação de GET (para editar)
if (!empty($_GET['id'])) {
    $data = $db->find('post', $_GET['id']);
}

// Função para formatar data para datetime-local
function formatDate($date)
{
    return $date ? date('Y-m-d\TH:i', strtotime($date)) : '';
}
?>

<div class="container mt-5">
    <!-- Mensagens de erro -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Mensagem de sucesso -->
    <?php if (!empty($success)): ?>
        <div class="alert alert-success">
            <strong><?= htmlspecialchars($success) ?></strong>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">
                <?= !empty($data) ? 'Editar Post' : 'Novo Post' ?>
            </h4>
        </div>
        <div class="card-body">
            <form action="PostForm.php" method="post">
                <input type="hidden" name="id" value="<?= $data->id ?? '' ?>">

                <!-- Título -->
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título *</label>
                    <input type="text"
                        name="titulo"
                        class="form-control"
                        id="titulo"
                        value="<?= htmlspecialchars($data->titulo ?? '') ?>"
                        required>
                </div>

                <div class="row mb-3">
                    <!-- Categoria -->
                    <div class="col-md-6">
                        <label for="categoria_id" class="form-label">Categoria *</label>
                        <select name="categoria_id" class="form-select" id="categoria_id" required>
                            <option value="">Selecione uma categoria</option>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria->id ?>"
                                    <?= (!empty($data->categoria_id) && $categoria->id == $data->categoria_id) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($categoria->nome) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-select" id="status">
                            <option value="SIM" <?= (!isset($data->status) || $data->status === "SIM") ? "selected" : "" ?>>
                                Ativo
                            </option>
                            <option value="NAO" <?= (isset($data->status) && $data->status === "NAO") ? "selected" : "" ?>>
                                Inativo
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Data de Publicação -->
                <div class="mb-3">
                    <label for="data_publicacao" class="form-label">Data de Publicação</label>
                    <input type="datetime-local"
                        name="data_publicacao"
                        class="form-control"
                        id="data_publicacao"
                        value="<?= formatDate($data->data_publicacao ?? '') ?>">
                    <small class="form-text text-muted">Deixe vazio para usar a data atual</small>
                </div>

                <!-- Texto -->
                <div class="mb-3">
                    <label for="texto" class="form-label">Texto *</label>
                    <textarea name="texto"
                        class="form-control"
                        id="texto"
                        rows="5"
                        required><?= htmlspecialchars($data->texto ?? '') ?></textarea>
                </div>

                <!-- Botões -->
                <div class="d-flex gap-2 justify-content-between">
                    <div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Salvar
                        </button>
                        <button type="reset" class="btn btn-outline-secondary">
                            Limpar
                        </button>
                    </div>
                    <a href="./PostList.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: 1px solid rgba(0, 0, 0, 0.125);
    }

    .form-label {
        font-weight: 500;
    }

    .btn {
        transition: all 0.2s ease-in-out;
    }

    .btn:hover {
        transform: translateY(-1px);
    }
</style>

<?php include_once "../footer.php"; ?>