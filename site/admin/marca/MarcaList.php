<?php
include '../header.php';
include '../database/db.class.php';

$db = new db('marca');
$db->checkLogin();

if (!empty($_GET['id'])) {
    $db->destroy($_GET['id']);
    header('Location: MarcaList.php');
    exit;
}

if (!empty($_POST)) {
    $dados = $db->search($_POST);
} else {
    $dados = $db->all();
}
?>

<h3>Listagem de Marcas</h3>

<form action="./MarcaList.php" method="post">
    <div class="row">
        <div class="col">
            <select name="tipo" class="form-select">
                <option value="nome_marca">Nome</option>
                <option value="pais_origem">País</option>
            </select>
        </div>

        <div class="col">
            <input type="text" name="valor" placeholder="Pesquisar" class="form-control">
        </div>

        <div class="col">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="./MarcaForm.php" class="btn btn-success">Cadastrar</a>
        </div>
    </div>
</form>

<div class="row mt-4">
    <div class="col">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome da Marca</th>
                    <th scope="col">País de Origem</th>
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
                            <td>$item->nome_marca</td>
                            <td>$item->pais_origem</td>
                            <td><a href='./MarcaForm.php?id=$item->id' class='btn btn-warning btn-sm'>Editar</a></td>
                            <td><a 
                                 href='./MarcaList.php?id=$item->id'
                                 onclick='return confirm(\"Deseja realmente excluir?\")'
                                 class='btn btn-danger btn-sm'
                                >Excluir</a></td>
                        </tr>";
                    }
                } else {
                     echo "<tr><td colspan='5' class='text-center'>Nenhuma marca encontrada.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include '../footer.php';
?>