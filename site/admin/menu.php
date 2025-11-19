<?php
$path = './';
if (!file_exists('main.php') && file_exists('../main.php')) {
    $path = '../';
}
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="nav-link active" aria-current="page" href="<?=$path?>main.php">Carros</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?=$path?>main.php">Início</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?=$path?>usuario/UsuarioList.php">Usuários</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?=$path?>veiculo/VeiculoList.php">Veículos</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?=$path?>categoria/CategoriaList.php">Marcas</a>
        </li>

      </ul>
    </div>

  </div>
</nav>