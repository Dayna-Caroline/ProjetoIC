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
        <link rel="stylesheet" href="../styles/requisitos.css">
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
                    <li><a href="menu.php?pagina=1"><i class="fas fa-stream"></i></i>Projetos</a></li>
                    <li><a href=""><i class="fas fa-users"></i>Funcionários</a></li>
                    <li><a href=""><i class="fas fa-battery-three-quarters"></i>Equipamentos</a></li>
                    <li><a href="requisitos.php"><i class="fas fa-edit"></i>Requisitos</a></li>
                    <li><a href=""><i class="fas fa-cogs"></i>Controle</a></li>
                    <li><a href=""><i class="fas fa-chart-pie"></i>Resultados</a></li>
                </ul>
            </div>

            <div class="conteudo">

                <h1>Gerenciamento de Requisitos</h1>

                <!-- seleciona aqui o projeto para ver os requisitos dele -->
                
                <!-- 
                <div class="fnc">

                    <div class="card">
                        <div class="icon-card" style="color:lightseagreen">
                            <i class="fas fa-plus"></i>
                        </div>
                        <h3>
                            Adicionar Requisito
                        </h3>
                        <div class="desc">
                            <p>sample text</p>
                        </div>
                    </div>
        
                    <div class="card">
                        <div class="icon-card" style="color:lightseagreen">
                            <i class="fas fa-bars"></i>
                        </div>
                        <h3>
                            Adicionar Requisito
                        </h3>
                        <div class="desc">
                            <p>sample text</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="icon-card" style="color:lightseagreen">
                            <i class="fas fa-engine"></i>
                        </div>
                        <h3>
                            Adicionar Requisito
                        </h3>
                        <div class="desc">
                            <p>sample text</p>
                        </div>
                    </div>
        
                </div>-->

            </div>

        </div>

    </body>

</html>