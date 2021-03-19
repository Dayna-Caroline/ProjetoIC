<?php

    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";

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
    }

    $query2 = "SELECT id_profissional, nome, empresa FROM profissional WHERE empresa = '{$_SESSION['id_empresa']}';";

    // executa a query

    $result2 = mysqli_query($conecta, $query2);
    $row2 = mysqli_num_rows($result2);


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

    <body onload="visualizar()">

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
                    <li class="navitem"><a href="../controle/controle.php"><i class="fas fa-cogs"></i><span class="nav-text">Controle</span></a></li>
                    <li class="navitem"><a href="../results/resultados.php"><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
                </ul>
            </div>

            <div class="conteudo">

                <div  class="titulo">
                    <h1>Detalhes do projeto</h1>
                </div>

                <!--  PROJETO (LER, ALTERAR, EXCLUIR, CONCLUIR)  -->
                <div class="projetos2">

                    <div class="botoes">
                        <button id="visualizar" onclick="visualizar()" class="visualizar" style="cursor: pointer;">visualizar</button>
                        <button id="editar" onclick="editar()" class="editar" style="cursor: pointer;">editar</button>
                    </div>

                    <form action="../../back/projetos/projetos.php" method="post">

                        <?php
                            echo "<div class=\"item2\">
                                <div style=\"color:#999999;cursor:default;\" class=\"leg-id2\"><b>ID Projeto</b></div>
                                <div style=\"width:150px;cursor:not-allowed;\" class=\"item-id2\"><select style=\"cursor:not-allowed;\" disabled > <option value=\"".$id."\">".$id."</option></select></div>
                                <div style=\"color:#999999;cursor:default;\" class=\"leg-id2\"><b>ID Empresa</b></div>
                                <div style=\"width:150px;cursor:not-allowed;\" class=\"item-id2\"><select style=\"cursor:not-allowed;\" disabled > <option value=\"".$id_empresa."\">".$id_empresa."</option></select></div>
                            </div>";

                            echo "<div class=\"item2\">
                                <div class=\"leg-id2\"><b>ID Responsável</b></div>

                                <div style=\"width:150px;\" class=\"item-id2\">
                                    <select name=\"profissional\" required id=\"profissional\">";

                                    for($i=0;$i<$row2;$i++){
                                        $linha2 = mysqli_fetch_array($result2);
                                        echo "<option "; 
                                            if($linha2['id_profissional']==$responsavel)
                                            { echo "selected "; } 
                                        echo " value=\"".$linha2['id_profissional']."\">".$linha2['id_profissional']." - ".$linha2['nome']."</option>";
                                    }

                                    echo "</select>
                                </div>

                            </div>";

                            echo "<div class=\"item2\">
                                <div class=\"leg-id2\"><b>Descrição do projeto</b></div>
                                <div class=\"item-id2\"><input type=\"text\" id=\"descricao\" name=\"descricao\" value=\"".$descricao."\"></div>
                            </div>";

                            echo "<div class=\"item2\">
                                <div class=\"leg-id2\"><b>Finalidade do projeto</b></div>
                                <div class=\"item-id2\"><input type=\"text\" id=\"finalidade\"  name=\"finalidade\" value=\"".$finalidade."\"></div>
                            </div>";

                            echo "<div class=\"item2\">
                            
                                <div class=\"leg-id2\"><b>Orçamento (R$)</b></div>
                                <div style=\"width:140px;\" class=\"item-id2\"><input id=\"orcamento\" class=\"numero\" type=\"number\" name=\"orcamento\" step=\".01\" value=\"".$orcamento."\"></div>
                                
                                <div class=\"leg-id2\" style=\"margin-right: 10px;\"><b>Custo final (R$)</b></div>
                                <div style=\"width:140px;\" class=\"item-id2\"><input id=\"c_final\"  class=\"numero\" type=\"number\" step=\".01\" name=\"c_final\" value=\"".$c_final."\"></div>
                            
                            </div>";

                            echo "<div class=\"item2\">
                            
                                <div class=\"leg-id2\"><b>Data de Início</b></div>
                                <div style=\"width:150px;\" class=\"item-id2\"><input id=\"inicio\" name=\"inicio\" type=\"date\" value=\"".$inicio."\"></div>
                                
                                <div class=\"leg-id2\"><b>Data de Aprovação</b></div>
                                <div style=\"width:150px;\" class=\"item-id2\"><input id=\"aprovacao\" name=\"aprovacao\" type=\"date\" value=\"".$aprovacao."\"></div>
                            
                            </div>";

                            echo "<div class=\"item2\">
                                <div class=\"leg-id2\"><b>Data do término</b></div>
                                <div style=\"width:150px;\" class=\"item-id2\"><input id=\"fim\" name=\"fim\" type=\"date\" value=\"".$fim."\"></div>
                            </div><br><br>";

                        ?>

                        <div class="botoes">
                            <button type="submit" value="<?php echo $id; ?>" name="conclui" class="novo" style="cursor: pointer;margin-left:100px;">Concluír Projeto</button>
                            <button type="submit" value="<?php echo $id; ?>" name="req" class="req" style="cursor: pointer;">Abrir Requisitos</button>
                            <button type="submit" value="<?php echo $id; ?>" name="arquiva" style="cursor: pointer;" class="arq">Excluir Projeto</button>
                        </div>

                    </form>

                </div>
            
            </div>

        </div>

        <script src="../../js/funcs_projetos.js"></script>

    </body>

</html>