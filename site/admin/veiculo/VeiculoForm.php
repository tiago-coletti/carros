<?php
include '../header.php';
include '../database/db.class.php';

$db = new db('veiculo');
$data = null;

$dbModelo = new db('modelo');
$modelos = $dbModelo->all();

//var_dump($modelos);
//exit;

if (!empty($_POST)) {
    try {
        $errors = [];

        //  var_dump($_POST);
        //  exit;

        if (empty($_POST['placa'])) {
            $errors[] = 'A placa é obrigatória';
        }

        if (empty($_POST['modelo_id'])) {
            $errors[] = 'O modelo é obrigatório';
        }

        if (empty($_POST['preco'])) {
            $errors[] = 'O preço é obrigatório';
        }

        if (empty($_POST['id'])) {
            unset($_POST['id']); //remove o campo do vetor $_POST

            $db->store($_POST);
            echo 'Registro Salvo com sucesso!';
        } else {
            $db->update($_POST);

            echo 'Registro Atualizado com sucesso!';
        }

        echo "<script>
            setTimeout(
                ()=> window.location.href = 'VeiculoList.php', 2000
            );
        </script>";
    } catch (Exception $e) {
        var_dump($errors, $e->getMessage());
        exit();
    }
}

if (!empty($_GET['id'])) {
    $data = $db->find($_GET['id']);
    //  var_dump($data);
    // exit;
}
?>


<h3>Formulário de Veículo</h3>
<form action="" method="post">
    <input type="hidden" name="id" value="<?= $data->id ?? '' ?>">

    <div class="row">
        <div class="col-4">
            <label for="" class="form-label">Placa</label>
            <input class="form-control" type="text" name="placa" value="<?= $data->placa ??
                '' ?>">
        </div>

        <div class="col-4">
            <label for="" class="form-label">Ano Fabricação</label>
            <input class="form-control" type="number" name="ano_fabricacao" value="<?= $data->ano_fabricacao ??
                '' ?>">
        </div>

        <div class="col-4">
            <label for="" class="form-label">Preço (R$)</label>
            <input class="form-control" type="text" name="preco" value="<?= $data->preco ??
                '' ?>">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-6">
            <label for="" class="form-label">Modelo</label>
            <select name="modelo_id" class="form-select">
                <option value="">Selecione...</option>
                <?php foreach ($modelos as $item) {
                    $selected = ($data->modelo_id ?? '') == $item->id ? 'selected' : '';
                    echo "<option value='$item->id' $selected>$item->nome_modelo</option>";
                } ?>
            </select>
        </div>
        <div class="col-6">
            <label for="" class="form-label">Status</label>
            <select name="status" class="form-select">
                <?php $st = $data->status ?? 'Disponível'; ?>
                <option value="Disponível" <?= $st == 'Disponível' ? 'selected' : '' ?>>Disponível</option>
                <option value="Vendido" <?= $st == 'Vendido' ? 'selected' : '' ?>>Vendido</option>
            </select>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <label for="" class="form-label">Cor</label>
            <input class="form-control" type="text" name="cor" value="<?= $data->cor ??
                '' ?>">
        </div>
    </div>

    <div class="row">
        <div class="col mt-4">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="./VeiculoList.php" class="btn btn-primary">Voltar</a>
        </div>
    </div>

</form>

<?php include '../footer.php';
?>