<?php
include '../header.php';
include '../db.class.php';

$db = new db('marca');
$data = null;

if (!empty($_POST)) {
    try {
        $errors = [];

        if (empty($_POST['nome_marca'])) {
            $errors[] = 'O nome da marca é obrigatório';
        }

        if (empty($_POST['pais_origem'])) {
            $errors[] = 'O país de origem é obrigatório';
        }

        // Validações opcionais para os novos campos podem ser adicionadas aqui

        if (empty($_POST['id'])) {
            unset($_POST['id']); 

            $db->store($_POST);
            echo 'Registro Salvo com sucesso!';
        } else {
            $db->update($_POST);

            echo 'Registro Atualizado com sucesso!';
        }

        echo "<script>
            setTimeout(
                ()=> window.location.href = 'MarcaList.php', 2000
            );
        </script>";
    } catch (Exception $e) {
        var_dump($errors, $e->getMessage());
        exit();
    }
}

if (!empty($_GET['id'])) {
    $data = $db->find($_GET['id']);
}
?>

<h3>Formulário de Marca</h3>
<form action="" method="post">
    <input type="hidden" name="id" value="<?= $data->id ?? '' ?>">

    <div class="row">
        <div class="col-6">
            <label for="" class="form-label">Nome da Marca</label>
            <input class="form-control" type="text" name="nome_marca" value="<?= $data->nome_marca ?? '' ?>">
        </div>

        <div class="col-6">
            <label for="" class="form-label">País de Origem</label>
            <input class="form-control" type="text" name="pais_origem" value="<?= $data->pais_origem ?? '' ?>">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-6">
            <label for="" class="form-label">Ano de Fundação</label>
            <input class="form-control" type="number" name="ano_fundacao" value="<?= $data->ano_fundacao ?? '' ?>">
        </div>

        <div class="col-6">
            <label for="" class="form-label">Site Oficial</label>
            <input class="form-control" type="text" name="site_oficial" value="<?= $data->site_oficial ?? '' ?>">
        </div>
    </div>

    <div class="row">
        <div class="col mt-4">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="./MarcaList.php" class="btn btn-primary">Voltar</a>
        </div>
    </div>

</form>

<?php include '../footer.php'; ?>