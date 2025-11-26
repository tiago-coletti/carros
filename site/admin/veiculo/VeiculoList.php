<?php
include '../header.php';
include '../db.class.php';

$db = new db('veiculo');
//var_dump($dados);
$db->checkLogin();

if (!empty($_GET['id'])) {
    $db->destroy($_GET['id']);
    header('Location: VeiculoList.php');
    exit;
}

if (!empty($_POST)) {
    $dados = $db->search($_POST);
} else {
    $dados = $db->all();
}

?>

<h3>Listagem de Veículos</h3>

<form action="./VeiculoList.php" method="post">
    <div class="row">
        <div class="col">
            <select name="tipo" class="form-select">
                <option value="placa">Placa</option>
                <option value="cor">Cor</option>
                <option value="status">Status</option>
            </select>
        </div>

        <div class="col">
            <input type="text" name="valor" placeholder="Pesquisar" class="form-control">
        </div>

        <div class="col">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="./VeiculoForm.php" class="btn btn-success">Cadastrar</a>
        </div>
    </div>
</form>

<div class="row mt-4">
    <div class="col">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Placa</th>
                    <th scope="col">Modelo (ID)</th>
                    <th scope="col">Ano</th>
                    <th scope="col">Cor</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Status</th>
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
                            <td>$item->placa</td>
                            <td>$item->modelo_id</td>
                            <td>$item->ano_fabricacao</td>
                            <td>$item->cor</td>
                            <td>R$ $item->preco</td>
                            <td>$item->status</td>
                            <td><a href='./VeiculoForm.php?id=$item->id' class='btn btn-warning btn-sm'>Editar</a></td>
                            <td><a 
                                 href='./VeiculoList.php?id=$item->id'
                                 onclick='return confirm(\"Deseja realmente excluir?\")'
                                 class='btn btn-danger btn-sm'
                                >Excluir</a></td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' class='text-center'>Nenhum veículo encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>


    </div>
</div>


<?php
include '../footer.php';
?>