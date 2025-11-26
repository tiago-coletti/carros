<?php
include './header.php';
include './db.class.php';

$db = new db('usuario');
$db->checkLogin();
?>

<div class="container mt-5">

    <h3 class="mb-4">Bem vindo, <?= $_SESSION['nome'] ?? 'Administrador' ?></h3>
    
    <div class="row g-4">

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body border-start border-primary border-4">
                    <h5 class="card-title text-primary fw-bold">Usuários</h5>
                    <p class="card-text">Gerencie o acesso administrativo e dados dos clientes.</p>
                    
                    <div class="d-grid gap-2">
                        <a href="./usuario/UsuarioList.php" class="btn btn-primary">Gerenciar Usuários</a>
                        <a href="./usuario/UsuarioForm.php" class="btn btn-outline-primary">Novo Usuário</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body border-start border-warning border-4">
                    <h5 class="card-title text-warning fw-bold">Marcas</h5>
                    <p class="card-text">Cadastre as fabricantes e marcas de carros.</p>
                    
                    <div class="d-grid gap-2">
                        <a href="./marca/MarcaList.php" class="btn btn-warning text-white">Gerenciar Marcas</a>
                        <a href="./marca/MarcaForm.php" class="btn btn-outline-warning">Nova Marca</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body border-start border-danger border-4">
                    <h5 class="card-title text-danger fw-bold">Modelos</h5>
                    <p class="card-text">Cadastre os diferentes modelos das marcas.</p>
                    
                    <div class="d-grid gap-2">
                        <a href="./modelo/ModeloList.php" class="btn btn-danger text-white">Gerenciar Modelos</a>
                        <a href="./modelo/ModeloForm.php" class="btn btn-outline-danger">Novo Modelo</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body border-start border-success border-4">
                    <h5 class="card-title text-success fw-bold">Veículos</h5>
                    <p class="card-text">Gerencie o estoque de carros à venda na loja.</p>
                    
                    <div class="d-grid gap-2">
                        <a href="./veiculo/VeiculoList.php" class="btn btn-success">Gerenciar Veículos</a>
                        <a href="./veiculo/VeiculoForm.php" class="btn btn-outline-success">Novo Veículo</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <div class="row mt-5">
        <div class="col text-center">
            <a href="login.php?logout=true" class="btn btn-danger btn-sm">Sair do Sistema</a>
        </div>
    </div>
</div>

<?php
include './footer.php';
?>