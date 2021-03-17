<?php

    include "../back/autenticacao.php";
    include "../back/conexao_local.php";

    $query = "SELECT * FROM projeto WHERE empresa = '{$_SESSION['id_empresa']}' AND md5(id_projeto) = '{$_GET['id']}';";

    // executa a query
    $result = mysqli_query($conecta, $query);
    $row = mysqli_num_rows($result);
    if($row>0)
    {
        $linha = mysqli_fetch_array($result);
        $id=$linha['id_projeto'];
        $descricao=$linha['descricao'];
        $finalidade=$linha['finalidade'];
        $orcamento=$linha['orcamento'];
        $responsavel=$linha['responsavel'];
        $aprovacao=$linha['aprovacao'];
        $inicio=$linha['inicio'];
        $fim=$linha['fim'];
        $c_final=$linha['c_final'];
        $id_empresa=$linha['empresa'];
        $ativo=$linha['ativo'];
    }


?>

<!DOCTYPE html>

<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <link rel="stylesheet" href="../styles/menu.css">
        <link rel="stylesheet" href="../styles/projeto.css">
        <title>Smart Grid</title>
    </head>

    <body>

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

                <div  class="titulo">
                    <h1>Detalhes do projeto</h1>
                </div>

                <!--  PROJETO (LER, ALTERAR, EXCLUIR, CONCLUIR)  -->
                <div class="projetos2">
                    <?php
                        echo "<div class=\"item2\">
                            <div style=\"color:rgb(92, 91, 91);cursor:default;\" class=\"leg-id2\"><b>ID Projeto</b></div>
                            <div class=\"item-id2\"><input type=\"text\" disabled value=\"".$id."\"></div>
                        </div>";
                        
                        echo "<div class=\"item2\">
                            <div style=\"color:rgb(92, 91, 91);cursor:default;\" class=\"leg-id2\"><b>ID Empresa</b></div>
                            <div class=\"item-id2\"><input type=\"text\" disabled value=\"".$id_empresa."\"></div>
                        </div>";

                        echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>ID Responsável</b></div>
                            <div class=\"item-id2\"><input type=\"text\" value=\"".$responsavel."\"></div>
                        </div>";

                        echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>Descrição do projeto</b></div>
                            <div class=\"item-id2\"><input type=\"text\" value=\"".$descricao."\"></div>
                        </div>";

                        echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>Finalidade do projeto</b></div>
                            <div class=\"item-id2\"><input type=\"text\" value=\"".$finalidade."\"></div>
                        </div>";

                        echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>Orçamento</b></div>
                            <div class=\"item-id2\"><input type=\"text\" value=\"".$orcamento."\"></div>
                        </div>";

                        echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>Data de Início</b></div>
                            <div class=\"item-id2\"><input type=\"text\" value=\"".$inicio."\"></div>
                        </div>";

                        echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>Data de Aprovação</b></div>
                            <div class=\"item-id2\"><input type=\"text\" value=\"".$aprovacao."\"></div>
                        </div>";

                        if($ativo!='s'){

                            echo "<div class=\"item2\">
                                <div class=\"leg-id2\"><b>Data do término</b></div>
                                <div class=\"item-id2\"><input type=\"text\" value=\"".$fim."\"></div>
                            </div>";

                            echo "<div class=\"item2\">
                                <div class=\"leg-id2\"><b>Custo final</b></div>
                                <div class=\"item-id2\"><input type=\"text\" value=\"".$c_final."\"></div>
                            </div>";
                            
                        }

                    ?>
                </div>
            
            </div>

        </div>

        <script src="../js/funcs_projetos.js"></script>

    </body>

</html>