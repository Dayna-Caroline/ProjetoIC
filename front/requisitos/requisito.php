<?php

    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";

    $query = "SELECT * FROM requisitos WHERE md5(id_requisito) = '{$_GET['id']}';";

    // executa a query

    $result = mysqli_query($conecta, $query);
    $row = mysqli_num_rows($result);

    if($row>0)
    {
        $linha = mysqli_fetch_array($result);
        $id=$linha['id_requisito'];
        $descricao=$linha['descricao'];
        $projeto=$linha['projeto'];
        $titulo=$linha['titulo'];
        $processo=$linha['processo'];
        $cadastro=$linha['cadastro'];
        $versao=$linha['versao'];
        $tipo=$linha['tipo'];
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

    <body onload="visualizar()">

        <div class="tudo">

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
                    <h1>Detalhes do Requisito</h1>
                </div>

                <!--  REQUISITO (LER, ALTERAR, EXCLUIR)  -->
                <div class="projetos2">

                    <div class="botoes">
                        <button id="visualizar" onclick="visualizar();" class="visualizar" style="cursor: pointer;">visualizar</button>
                        <button id="editar" onclick="editar()" class="editar" style="cursor: pointer;">editar</button>
                    </div>

                    <form action="../../back/requisitos/requisitos.php" onchange="alterou()" method="post">

                        <?php
                            echo "<div class=\"item2\">

                                <div style=\"color:#999999;cursor:default;\" class=\"leg-id2\"><b>ID Requisito</b></div>
                                <div style=\"width:150px;cursor:not-allowed;\" class=\"item-id2\"><select style=\"cursor:not-allowed;\" disabled > <option value=\"".$id."\">".$id."</option></select></div>

                                <div style=\"color:#999999;cursor:default;\" class=\"leg-id2\"><b>ID Projeto</b></div>
                                <div style=\"width:150px;cursor:not-allowed;\" class=\"item-id2\"><select style=\"cursor:not-allowed;\" disabled > <option value=\"".$projeto."\">".$projeto."</option></select></div>
                                
                            </div>";

                            echo "<div class=\"item2\">
                                <div class=\"leg-id2\"><b>Título</b></div>
                                <div class=\"item-id2\"><input type=\"text\" id=\"titulo\" onkeypress=\"alterou()\" required name=\"titulo\" value=\"".$titulo."\"></div>
                            </div>";

                            echo "<div class=\"item2\">
                                <div class=\"leg-id2\"><b>Descrição</b></div>
                                <div class=\"item-id2\"><input type=\"text\" id=\"descricao\" onkeypress=\"alterou()\" required name=\"descricao\" value=\"".$descricao."\"></div>
                            </div>";

                            echo "<div class=\"item2\">
                                <div class=\"leg-id2\"><b>Processo</b></div>
                                <div class=\"item-id2\"><input type=\"text\" id=\"processo\" onkeypress=\"alterou()\" required name=\"processo\" value=\"".$processo."\"></div>
                            </div>";

                            echo "<div class=\"item2\">
                            
                                <div class=\"leg-id2\"><b>Cadastro</b></div>
                                <div style=\"width:150px;\" class=\"item-id2\"><input id=\"cadastro\" onkeypress=\"alterou()\" name=\"cadastro\" required  type=\"date\" value=\"".$cadastro."\"></div>
                                <div class=\"leg-id2\" style=\"margin-right: 10px; width:150px;\"><b>Tipo</b></div>
                                <div style=\"width:140px;\" class=\"item-id2\"><input id=\"tipo\" required onkeypress=\"alterou()\" class=\"numero\" type=\"number\" name=\"tipo\" value=\"".$tipo."\"></div>
                            </div>";

                            echo "<div class=\"item2\">
                                <div class=\"leg-id2\"><b>Versão</b></div>
                                <div style=\"width:140px;\" class=\"item-id2\"><input id=\"versao\" required class=\"numero\" onkeypress=\"alterou()\" type=\"number\" name=\"versao\" value=\"".$versao."\"></div>
                                
                                <button type=\"submit\" value=\"".$id."\" id=\"altera\" name=\"altera\" class=\"salvar\" style=\"cursor: pointer;\"><i class=\"fas fa-check\"></i></button>
                                <button type=\"submit\" value=\"".$id."\"  id=\"cancela\" name=\"cancela\" class=\"cancelar\" style=\"cursor: pointer;\"><i class=\"fas fa-times\"></i></button>
                                </div><br><br>
                            ";

                        ?>

                        <div class="botoes">

                            <button type="submit" value="<?php echo $id; ?>" name="arquiva" style="cursor: pointer; margin-left:300px;" class="arq">Excluir Requisito</button>
                           
                        
                        </div>

                    </form>
                    <form action="../../front/mudancas/solic_mud.php"  method="post">
                    <button type="submit" value="<?php echo $id; ?>" name="mudanca" style="cursor: pointer; margin-left:300px;" class="arq">Solicitar Mudança</button>
                    </form>
                   <form action="../../front/mudancas/hist_mud.php"  method="post">
                    <button type="submit" value="<?php echo $id; ?>" name="id" style="cursor: pointer; margin-left:300px;" class="arq">Historico Mudança</button>
                    </form>
                </div>

            </div>

        </div>

        <script src="../../js/funcs_requisitos.js"></script>

    </body>

</html>