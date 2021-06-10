<?php

    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";

    if(!$_GET['proj']){
        header("location: ../../front/projetos/menu.php?e=1&pagina=1"); die();
    }

    $query = "SELECT * FROM projeto WHERE md5(id_projeto) = '{$_GET['proj']}';";

    // executa a query

    $result = mysqli_query($conecta, $query);
    $row = mysqli_num_rows($result);

    if($row==0)
    {
        header("location: ../../front/projetos/menu.php?e=1&pagina=1"); die();
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
                    <li class="navitem"><a href="../controle/controle.php"><i class="fas fa-cogs"></i><span class="nav-text">Consumo</span></a></li>
                    <li class="navitem"><a href="../results/resultados.php"><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
                </ul>
            </div>

            <div class="conteudo">

                <div  class="titulo">
                    <?php echo "<a href=\"requisitos.php?proj=".$_GET['proj']."\"><p class=\"volt alt\">
                    &#8592;  Voltar</p></a>"; ?>
                    <h1>Criar Requisito</h1>
                </div>

                <!-- ERRO -->
                <?php
                    switch(@$_GET['s'])
                    {
                        
                        case 2:
                            echo "<div id=\"erro\" class=\"erro\" onclick=\"fecha_e()\">
                                <p>Não foi possível terminar o cadastro do requisito, tente novamente em alguns instantes.</p>
                            </div>";
                        break;

                        case 3:
                            $campos=explode("_",$_GET['e']);
                            echo "<div id=\"erro\" class=\"erro\" onclick=\"fecha_e()\">
                                <br><p><b>Atenção! Verifique os seguintes campos:</b></p><br>";
                                foreach($campos as $aux) {
                                    if($aux=='2')echo"<p> - Titulo (deve conter entre 5 e 50 caracteres!)</p><br>";
                                    if($aux=='1')echo"<p> - Descrição (deve conter entre 10 e 100 caracteres!)</p><br>";
                                    if($aux=='3')echo"<p> - Processo (deve conter entre 10 e 50 caracteres!)</p><br>";
                                    if($aux=='4')echo"<p> - Tipo inválido!</p><br>";
                                }
                            echo "</div>";
                        break;

                    }
                ?>

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
                        <div class=\"leg-id2\" style=\"margin-left:25px; margin-right: 15px; width:150px;\"><b>Tipo</b></div>
                        <div style=\"width:140px;\" class=\"item-id2\"><input id=\"tipo\" required onkeypress=\"alterou()\" class=\"numero\" type=\"number\" name=\"tipo\"></div>
                        </div>

                        <br><br>
                        ";

                    ?>

                    <br><div class="botoes">
                        <button type="submit" value="<?php echo $_GET['proj'] ?>" name="cadastra" class="novo" style="cursor: pointer;margin-left:120px;">Concluír Cadastro</button>
                    </div>

                </div>
            
            </div>

        </div>

        <script src="../../js/funcs_cad_proj.js"></script>

    </body>

</html>