<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<?php
$hiddenPage = ['login.php', 'registro.php'];
$currentPage = basename($_SERVER['PHP_SELF']);

$showMenu = !in_array($currentPage, $hiddenPage);

if ($showMenu) {
    if (file_exists(__DIR__ . '/menu.php')) {
        include __DIR__ . '/menu.php';
    }
}
?>

    <div class="container mt-4">
        <div class="row">