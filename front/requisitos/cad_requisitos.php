<?php

    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";

    // erro = 3: erro; nao da pra cadastrar requisito de um projeto q nao existe

    if(!$_GET['proj']){
        header("location: ../../front/projetos/menu.php?erro=1&pagina=1"); die();
    }

?>

<!DOCTYPE html>

<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <link rel="stylesheet" href="../../styles/projetos/menu.css">
        <link rel="stylesheet" href="../../styles/projetos/projeto.css">
        <title>Smart Grid</title>
    </head>

    <body>

        <div class="tudo">

            <!-- NAVBAR -->
            
            <div class="aba">
                <div class="logo">
                    <a href="../../front/projetos/menu.php"><img src="../../imgs/logo.png" alt="Logo da empresa" class="img-logo"></a>
                    <h2 class="nav-text">Smart Grids</h2>
                </div>
                <ul>
                    <li class="navitem"><a href="../empresa/empresa.php"><i class="fas fa-city"></i><span class="nav-text">Empresa</span></a></li>
                    <li class="pag navitem"><a href="../projetos/menu.php?pagina=1"><i class="fas fa-stream"></i><span class="nav-text">Projetos</span></a></li>
                    <li class="navitem"><a href="../funcs/funcionarios.php?pagina=1"><i class="fas fa-users"></i><span class="nav-text">Funcionários</span></a></li>
                    <li class="navitem"><a href="../equip/equipamentos.php"><i class="fas fa-battery-three-quarters"></i><span class="nav-text">Equipamentos</span></a></li>
                    <li class="navitem"><a href="../mudancas/controle.php"><i class="fas fa-cogs"></i><span class="nav-text">Controle</span></a></li>
                    <li class="navitem"><a href="../results/resultados.php"><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
                </ul>
            </div>

            <div class="conteudo">

                <div  class="titulo">
                    <h1>Criar Requisito</h1>
                </div>

                <form class="projetos2" method="post" action="../../back/requisitos/requisitos.php">

                    <?php

                        echo "<div class=\"item2\">
                        <div class=\"leg-id2\"><b>Título</b></div>
                        <div class=\"item-id2\"><input type=\"text\" id=\"titulo\" onkeypress=\"alterou()\" required name=\"titulo\"></div>
                        </div>";

                        echo "<div class=\"item2\">
                        <div class=\"leg-id2\"><b>Descrição</b></div>
                        <div class=\"item-id2\"><input type=\"text\" id=\"descricao\" onkeypress=\"alterou()\" required name=\"descricao\"></div>
                        </div>";

                        echo "<div class=\"item2\">
                        <div class=\"leg-id2\"><b>Processo</b></div>
                        <div class=\"item-id2\"><input type=\"text\" id=\"processo\" onkeypress=\"alterou()\" required name=\"processo\"></div>
                        </div>";

                        echo "<div class=\"item2\">

                        <div class=\"leg-id2\"><b>Cadastro</b></div>
                        <div style=\"width:150px; margin-left:5px;\" class=\"item-id2\"><input id=\"cadastro\" onkeypress=\"alterou()\" name=\"cadastro\" required  type=\"date\"></div>
                        <div class=\"leg-id2\" style=\"margin-left:25px; margin-right: 15px; width:150px;\"><b>Tipo</b></div>
                        <div style=\"width:140px;\" class=\"item-id2\"><input id=\"tipo\" required onkeypress=\"alterou()\" class=\"numero\" type=\"number\" name=\"tipo\"></div>
                        </div>

                        <br><br>
                        ";

                    ?>

                    <br><div class="botoes">
                        <button type="submit" value="<?php echo $_GET['proj'] ?>" name="cadastra" class="novo" style="cursor: pointer;margin-left:525px;">Concluír Cadastro</button>
                    </div>

                </div>
            
            </div>

        </div>

    </body>

</html>