<?php
include '../header.php';
include '../db.class.php';

$db = new db('modelo');
$dbMarca = new db('marca');

$data = null;
$marcas = $dbMarca->all();

if (!empty($_POST)) {
    try {
        if (empty($_POST['marca_id'])) {
             throw new Exception('A marca é obrigatória');
        }

        if (empty($_POST['tipo_carroceria'])) {
            throw new Exception('O tipo do veículo é obrigatório');
        }

        if (empty($_POST['nome_modelo'])) {
            throw new Exception('O nome do modelo é obrigatório');
        }

        if (empty($_POST['ano_lancamento'])) {
            throw new Exception('O ano de lançamento é obrigatório');
        }

        if (empty($_POST['combustivel'])) {
            throw new Exception('O combustível é obrigatório');
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
        var_dump($e->getMessage());
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
            <label for="" class="form-label">Marca</label>
            <select name="marca_id" class="form-select" required>
                <option value="">Selecione</option>
                <?php 
                if($marcas) {
                    foreach($marcas as $marca) {
                        $selected = ($data->marca_id ?? '') == $marca->id ? 'selected' : '';
                        echo "<option value='$marca->id' $selected>$marca->nome_marca</option>";
                    }
                }
                ?>
            </select>
        </div>

        <div class="col-4">
            <label for="" class="form-label">Tipo de Veículo</label>
            <input class="form-control" type="text" name="tipo_carroceria" value="<?= $data->tipo_carroceria ?? '' ?>" required>
        </div>

        <div class="col-4">
            <label for="" class="form-label">Nome do Modelo</label>
            <input class="form-control" type="text" name="nome_modelo" value="<?= $data->nome_modelo ?? '' ?>" required>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-6">
            <label for="" class="form-label">Ano de Lançamento</label>
            <input class="form-control" type="number" name="ano_lancamento" value="<?= $data->ano_lancamento ?? '' ?>" required>
        </div>

        <div class="col-6">
            <label for="" class="form-label">Combustível</label>
            <input class="form-control" type="text" name="combustivel" value="<?= $data->combustivel ?? '' ?>" required>
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