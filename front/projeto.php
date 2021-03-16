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

    <body onclick="verifica()">

        <div class="tudo">

            <!-- NAVBAR -->
            
            <div class="aba">
                <div class="logo">
                    <a href="../index.php"><img src="../imgs/logo.png" alt="Logo da empresa" class="img-logo"></a>
                    <h2>Smart Grids</h2>
                </div>
                <ul>
                    <li><a href="empresa.php"><i class="fas fa-city"></i></i><span class="nav-text">Empresa</span></a></li>
                    <li class="pag"><a href="menu.php?pagina=1"><i class="fas fa-stream"></i></i><span class="nav-text">Projetos</span></a></li>
                    <li><a href="funcionarios.php?pagina=1"><i class="fas fa-users"></i><span class="nav-text">Funcionários</span></a></li>
                    <li><a href=""><i class="fas fa-battery-three-quarters"></i><span class="nav-text">Equipamentos</span></a></li>
                    <li><a href="requisitos.php"><i class="fas fa-edit"></i><span class="nav-text">Requisitos</span></a></li>
                    <li><a href=""><i class="fas fa-cogs"></i><span class="nav-text">Controle</span></a></li>
                    <li><a href=""><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
                </ul>
            </div>

            <div class="conteudo">

                <h1>Projeto </h1>

                <!--  PROJETO (LER, ALTERAR, EXCLUIR, CONCLUIR)  -->
                
            
            </div>

        </div>

        <script src="../js/funcs_menu.js"></script>

    </body>

</html>