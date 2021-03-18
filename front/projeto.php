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
                    <li class="navitem"><a href="empresa.php"><i class="fas fa-city"></i><span class="nav-text">Empresa</span></a></li>
                    <li class="pag navitem"><a href="menu.php?pagina=1"><i class="fas fa-stream"></i><span class="nav-text">Projetos</span></a></li>
                    <li class="navitem"><a href="funcionarios.php?pagina=1"><i class="fas fa-users"></i><span class="nav-text">Funcionários</span></a></li>
                    <li class="navitem"><a href=""><i class="fas fa-battery-three-quarters"></i><span class="nav-text">Equipamentos</span></a></li>
                    <li class="navitem"><a href="requisitos.php"><i class="fas fa-edit"></i><span class="nav-text">Requisitos</span></a></li>
                    <li class="navitem"><a href=""><i class="fas fa-cogs"></i><span class="nav-text">Controle</span></a></li>
                    <li class="navitem"><a href=""><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
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
                            <div style=\"color:#999999;cursor:default;\" class=\"leg-id2\"><b>ID Projeto</b></div>
                            <div style=\"cursor:not-allowed;\" class=\"item-id2\"><input style=\"cursor:not-allowed;\" type=\"text\" disabled value=\"".$id."\"></div>
                        </div>";
                        
                        echo "<div class=\"item2\">
                            <div style=\"color:#999999;cursor:default;\" class=\"leg-id2\"><b>ID Empresa</b></div>
                            <div style=\"cursor:not-allowed;\" class=\"item-id2\"><input type=\"text\" style=\"cursor:not-allowed;\" disabled value=\"".$id_empresa."\"></div>
                        </div>";

                        echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>ID Responsável</b></div>
                            <div class=\"item-id2\"><input type=\"text\" name=\"responsavel\" value=\"".$responsavel."\"></div>
                        </div>";

                        echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>Descrição do projeto</b></div>
                            <div class=\"item-id2\"><input type=\"text\" name=\"descricao\" value=\"".$descricao."\"></div>
                        </div>";

                        echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>Finalidade do projeto</b></div>
                            <div class=\"item-id2\"><input type=\"text\" name=\"finalidade\" value=\"".$finalidade."\"></div>
                        </div>";

                        echo "<div class=\"item2\">
                        
                            <div class=\"leg-id2\"><b>Orçamento (R$)</b></div>
                            <div style=\"width:140px;\" class=\"item-id2\"><input class=\"numero\" type=\"number\" name=\"orcamento\" step=\".01\" value=\"".$orcamento."\"></div>
                            
                            <div class=\"leg-id2\" style=\"margin-right: 10px;\"><b>Custo final (R$)</b></div>
                            <div style=\"width:140px;\" class=\"item-id2\"><input class=\"numero\" type=\"number\" step=\".01\" name=\"c_final\" value=\"".$c_final."\"></div>
                        
                        </div>";

                        echo "<div class=\"item2\">
                        
                            <div class=\"leg-id2\"><b>Data de Início</b></div>
                            <div style=\"width:150px;\" class=\"item-id2\"><input name=\"inicio\" type=\"date\" value=\"".$inicio."\"></div>
                            
                            <div class=\"leg-id2\"><b>Data de Aprovação</b></div>
                            <div style=\"width:150px;\" class=\"item-id2\"><input name=\"aprovacao\" type=\"date\" value=\"".$aprovacao."\"></div>
                        
                        </div>";

                        echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>Data do término</b></div>
                            <div style=\"width:150px;\" class=\"item-id2\"><input name=\"fim\" type=\"date\" value=\"".$fim."\"></div>
                        </div>";

                    ?>
                </div>
            
            </div>

        </div>

        <script src="../js/funcs_projetos.js"></script>

    </body>

</html>