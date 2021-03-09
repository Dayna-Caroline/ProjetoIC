<?php
    include "../back/autenticacao.php";
    include "../back/conexao_local.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="../styles/menu.css">
    <title>Smart Grid</title>
</head>
<body>
    <div class="tudo">
        <div class="aba">
            <div class="logo">
                <a href="../index.php"><img src="../imgs/logo.png" alt="Logo da empresa" class="img-logo"></a>
                <h2>Smart Grids</h2>
            </div>
            <ul>
                <li><a href="empresa.php"><i class="fas fa-city"></i></i>Empresa</a></li>
                <li><a href=""><i class="fas fa-users"></i>Funcionários</a></li>
                <li><a href=""><i class="fas fa-battery-three-quarters"></i>Equipamentos</a></li>
                <li><a href=""><i class="fas fa-edit"></i>Requisitos</a></li>
                <li><a href=""><i class="fas fa-cogs"></i>Controle</a></li>
                <li><a href=""><i class="fas fa-chart-pie"></i>Resultados</a></li>
            </ul>
        </div>
        <div class="conteudo">
        </div>
    </div>
</body>
</html>