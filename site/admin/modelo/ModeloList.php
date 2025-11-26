<?php
include '../header.php';
include '../db.class.php';

$db = new db('modelo');
$db->checkLogin();

if (!empty($_GET['id'])) {
    $db->destroy($_GET['id']);
    header('Location: ModeloList.php');
    exit;
}

if (!empty($_POST)) {
    $dados = $db->search($_POST);
} else {
    $dados = $db->all();
}
?>

<h3>Listagem de Modelos</h3>

<form action="./ModeloList.php" method="post">
    <div class="row">
        <div class="col">
            <select name="tipo" class="form-select">
                <option value="nome_modelo">Nome</option>
                <option value="tipo_carroceria">Tipo</option>
                <option value="ano_lancamento">Ano</option>
                <option value="combustivel">Combustível</option>
            </select>
        </div>

        <div class="col">
            <input type="text" name="valor" placeholder="Pesquisar" class="form-control">
        </div>

        <div class="col">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="./ModeloForm.php" class="btn btn-success">Cadastrar</a>
        </div>
    </div>
</form>

<div class="row mt-4">
    <div class="col">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome do Modelo</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Ano</th>
                    <th scope="col">Combustível</th>
                    <th scope="col">Ação</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($dados) {
                    foreach ($dados as $item) {
                        echo "<tr>
                            <th scope='row'>$item->id</th>
                            <td>$item->nome_modelo</td>
                            <td>$item->tipo_carroceria</td>
                            <td>$item->ano_lancamento</td>
                            <td>$item->combustivel</td>
                            <td><a href='./ModeloForm.php?id=$item->id' class='btn btn-warning btn-sm'>Editar</a></td>
                            <td><a 
                                 href='./ModeloList.php?id=$item->id'
                                 onclick='return confirm(\"Deseja realmente excluir?\")'
                                 class='btn btn-danger btn-sm'
                                >Excluir</a></td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Nenhum modelo encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include '../footer.php';
?>