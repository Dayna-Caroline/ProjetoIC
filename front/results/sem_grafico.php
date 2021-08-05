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
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <link rel="stylesheet" href="../../styles/projetos/menu.css">
        <link rel="stylesheet" href="../../styles/results/resultados.css">

        <style>
            rect{
                background-color: transparent;
            }
        </style>

        <title>Smart Grid</title>
    </head>

    <body>

        <div class="tudo">

        <div class="aba" id="aba">
                <div class="logo">
                    <a href="../../front/projetos/menu.php"><img src="../../imgs/logo.png" alt="Logo da empresa" class="img-logo"></a>
                    <h2 class="nav-text">Smart Grids</h2>
                </div>
                <ul>
                    <li class="navitem"><a href="../empresa/empresa.php"><i class="fas fa-city"></i><span class="nav-text">Empresa</span></a></li>
                    <li class="navitem"><a href="../projetos/menu.php?pagina=1"><i class="fas fa-stream"></i><span class="nav-text">Projetos</span></a></li>
                    <li class="navitem"><a href="../funcs/funcionarios.php?pagina=1"><i class="fas fa-users"></i><span class="nav-text">Funcionários</span></a></li>
                    <li class="navitem"><a href="../equip/equipamentos.php"><i class="fas fa-battery-three-quarters"></i><span class="nav-text">Equipamentos</span></a></li>
                    <li class="navitem"><a href="../controle/consumo.php"><i class="fas fa-cogs"></i><span class="nav-text">Consumo</span></a></li>
                    <li class="pag navitem"><a href="../results/resultados.php"><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
                </ul>
            </div>

        <div class="conteudo" id="conteudo" style="background-color:white;">
               <h1>Análise dos dados</h1>

                <div class="graficos" style="color: red;">
                    <center>Você ainda não tem dados suficientes para a criação dos gráficos e estatísticas.</center>
                </div>
                <div class="p" style="margin-left: 50px;">
                    <br>
                    <h3>Tente cadastrar: (caso não tenha)</h3>
                    <ul>
                        <li>- Equipamentos</li>
                        <li>- Profissionais</li>
                        <li>- Projetos</li>
                        <li>- Consumos</li>
                    </ul>
                </div>
            </div>
        </div>

        <script src="../../js/func_nav.js"></script>

    </body>
</html>