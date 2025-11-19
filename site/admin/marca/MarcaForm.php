<?php
include '../header.php';
include '../database/db.class.php';

$db = new db('modelo');
$data = null;

if (!empty($_POST)) {
    try {
        $errors = [];

        if (empty($_POST['tipo_carroceria'])) {
            $errors[] = 'O tipo do veículo é obrigatório';
        }

        if (empty($_POST['nome_modelo'])) {
            $errors[] = 'O nome do modelo é obrigatório';
        }

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
                ()=> window.location.href = 'ModeloList.php', 2000
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

<h3>Formulário de Modelo de Veículo</h3>
<form action="" method="post">
    <input type="hidden" name="id" value="<?= $data->id ?? '' ?>">

    <div class="row">
        <div class="col-4">
            <label for="" class="form-label">Tipo de Veículo</label>
            <input class="form-control" type="text" name="tipo_carroceria" value="<?= $data->tipo_carroceria ?? '' ?>">
        </div>

        <div class="col-4">
            <label for="" class="form-label">Nome do Modelo</label>
            <input class="form-control" type="text" name="nome_modelo" value="<?= $data->nome_modelo ?? '' ?>">
        </div>
    </div>

    <div class="row">
        <div class="col mt-4">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="./ModeloList.php" class="btn btn-primary">Voltar</a>
        </div>
    </div>

</form>

<?php include '../footer.php'; ?>