<?php

    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <link rel="stylesheet" href="../../styles/projetos/menu.css">
        <title>Smart Grid</title>
    </head>

    <body>

        <div class="tudo">

        <div class="aba">
                <div class="logo">
                    <a href="../../index.php"><img src="../../imgs/logo.png" alt="Logo da empresa" class="img-logo"></a>
                    <h2 class="nav-text">Smart Grids</h2>
                </div>
                <ul>
                    <li class="navitem"><a href="../empresa/empresa.php"><i class="fas fa-city"></i><span class="nav-text">Empresa</span></a></li>
                    <li class="navitem"><a href="../projetos/menu.php?pagina=1"><i class="fas fa-stream"></i><span class="nav-text">Projetos</span></a></li>
                    <li class="navitem"><a href="../funcs/funcionarios.php?pagina=1"><i class="fas fa-users"></i><span class="nav-text">Funcionários</span></a></li>
                    <li class="navitem"><a href="../equip/equipamentos.php"><i class="fas fa-battery-three-quarters"></i><span class="nav-text">Equipamentos</span></a></li>
                    <li class="pag navitem"><a href="../requisitos/requisitos.php"><i class="fas fa-edit"></i><span class="nav-text">Requisitos</span></a></li>
                    <li class="navitem"><a href="../controle/controle.php"><i class="fas fa-cogs"></i><span class="nav-text">Controle</span></a></li>
                    <li class="navitem"><a href="../results/resultados.php"><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
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