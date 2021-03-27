<?php

    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";

    $query = "SELECT id_profissional, nome, empresa FROM profissional WHERE empresa = '{$_SESSION['id_empresa']}';";

    // executa a query

    $result = mysqli_query($conecta, $query);
    $row = mysqli_num_rows($result);

    if($row==0){
        header("location: ../../front/funcs/cad_funcs.php");
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
                    <h1>Criar projeto</h1>
                </div>

                <form class="projetos2" method="post" action="../../back/projetos/projetos.php">

                    <?php
                        echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>ID Responsável</b></div>
                            <div class=\"item-id2\">
                                <select name=\"profissional\" style=\"cursor: pointer\" required id=\"profissional\">";

                                for($i=0;$i<$row;$i++){
                                    $linha = mysqli_fetch_array($result);
                                    echo "<option value=\"".$linha['id_profissional']."\">".$linha['id_profissional']." - ".$linha['nome']."</option>";
                                }

                                echo "</select>
                            </div>
                        </div>";

                        echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>Descrição do projeto</b></div>
                            <div class=\"item-id2\"><input required type=\"text\" name=\"descricao\"></div>
                        </div>";

                        echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>Finalidade do projeto</b></div>
                            <div class=\"item-id2\"><input required type=\"text\" name=\"finalidade\"></div>
                        </div>";

                        echo "<div class=\"item2\">
                        
                            <div class=\"leg-id2\"><b>Orçamento (R$)</b></div>
                            <div style=\"width:140px;\" class=\"item-id2\"><input required class=\"numero\" type=\"number\" name=\"orcamento\" step=\".01\"></div>
                            
                            <div class=\"leg-id2\" style=\"margin-right: 10px;\"><b>Custo final (R$)</b></div>
                            <div style=\"width:140px;\" class=\"item-id2\"><input required class=\"numero\" type=\"number\" step=\".01\" name=\"c_final\"></div>
                        
                        </div>";

                        echo "<div class=\"item2\">
                        
                            <div class=\"leg-id2\"><b>Data de Início</b></div>
                            <div style=\"width:150px;\" class=\"item-id2\"><input required name=\"inicio\" type=\"date\"></div>
                            
                            <div class=\"leg-id2\"><b>Data de Aprovação</b></div>
                            <div style=\"width:150px;\" class=\"item-id2\"><input required name=\"aprovacao\" type=\"date\"></div>
                        
                        </div>";

                        echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>Prévia do término</b></div>
                            <div style=\"width:150px;\" class=\"item-id2\"><input required name=\"previa\" type=\"date\"></div>
                        </div>";

                    ?>

                    <br><div class="botoes">
                        <button type="submit" value="cadastrar" name="cadastrar" class="novo" style="cursor: pointer;margin-left:300px;">Concluír Cadastro</button>
                    </div>

                </div>
            
            </div>

        </div>

    </body>

</html>