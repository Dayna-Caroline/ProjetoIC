<?php

    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";
    
    $query = "SELECT * FROM requisitos WHERE md5(id_requisito) = '{$_GET['id']}' AND ativo='s';";

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
        $custo=$linha['custo'];
    }
    else{ header("location: ../../front/requisitos/requisitos.php?e=1&pagina=1"); die(); }

    $query2 = "SELECT projeto.id_projeto, projeto.concluido FROM projeto, profissional WHERE projeto.id_projeto = '$linha[projeto]' AND projeto.ativo = 's' AND profissional.ativo='s' AND projeto.responsavel=profissional.id_profissional;";

    // executa a query

    $result2 = mysqli_query($conecta, $query2);
    $linha2 = mysqli_fetch_array($result2);
    $row2 = mysqli_num_rows($result2);
    if($row2==0){header("location: ../../front/projetos/menu.php?e=3&pagina=1"); die();}

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

        <div class="aba" id="aba">
                <div class="logo">
                    <a href="../../front/projetos/menu.php"><img src="../../imgs/logo.png" alt="Logo da empresa" class="img-logo"></a>
                    <h2 class="nav-text">Smart Grids</h2>
                </div>
                <ul>
                    <li class="navitem"><a href="../empresa/empresa.php"><i class="fas fa-city"></i><span class="nav-text">Empresa</span></a></li>
                    <li class="pag navitem"><a href="../projetos/menu.php?pagina=1"><i class="fas fa-stream"></i><span class="nav-text">Projetos</span></a></li>
                    <li class="navitem"><a href="../funcs/funcionarios.php?pagina=1"><i class="fas fa-users"></i><span class="nav-text">Funcionários</span></a></li>
                    <li class="navitem"><a href="../equip/equipamentos.php"><i class="fas fa-battery-three-quarters"></i><span class="nav-text">Equipamentos</span></a></li>
                    <li class="navitem"><a href="../controle/consumo.php"><i class="fas fa-cogs"></i><span class="nav-text">Consumo</span></a></li>
                    <li class="navitem"><a href="../results/resultados.php"><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
                </ul>
            </div>

            <div class="conteudo" id="conteudo">

                <div  class="titulo">
                    <?php echo "<a href=\"requisitos.php?proj=".md5($linha['projeto'])."\"><p class=\"volt alt\">
                    &#8592;  Voltar</p></a>"; ?>
                    <h1>Detalhes do Requisito</h1>
                </div>

                <!--  REQUISITO (LER, ALTERAR, EXCLUIR)  -->
                <div class="projetos2">

                    <div class="botoes">
                        <button id="visualizar" onclick="visualizar();" class="visualizar" style="cursor: pointer;">visualizar</button>
                        <button id="editar" onclick="editar()" class="editar" style="cursor: pointer;">editar</button>
                    </div>

                    <!-- ERRO -->
                    <?php
                        switch(@$_GET['s'])
                        {

                            case 1:
                                echo "<div id=\"sucesso\" class=\"sucesso2\" onclick=\"fecha_s()\">
                                    <p>Alterações salvas com sucesso!</p>
                                </div>";
                            break;

                            case 2:
                                echo "<div id=\"erro\" class=\"erro2\" onclick=\"fecha_e()\">
                                    <p>Não foi possível concluír as alterações!</p>
                                </div>";
                            break;

                            case 5:
                                echo "<div id=\"erro\" class=\"erro2\" onclick=\"fecha_e()\">
                                    <p>Não foi possível excluír o requisito!</p>
                                </div>";
                            break;

                            case 3:
                                $campos=explode("_",$_GET['e']);
                                echo "<div id=\"erro\" class=\"erro2\" onclick=\"fecha_e()\">
                                    <br><p><b>Atenção! Verifique os seguintes campos:</b></p><br>";
                                    foreach($campos as $aux) {
                                        if($aux=='2')echo"<p> - Titulo (deve conter entre 5 e 50 caracteres!)</p><br>";
                                        if($aux=='1')echo"<p> - Descrição (deve conter entre 10 e 100 caracteres!)</p><br>";
                                        if($aux=='3')echo"<p> - Processo (deve conter entre 10 e 50 caracteres!)</p><br>";
                                        if($aux=='4')echo"<p> - Tipo inválido!</p><br>";
                                        if($aux=='5')echo"<p> - Custo inválido!</p><br>";
                                    }
                                echo "</div>";
                            break;

                        }
                    ?>

                    <form action="../../back/requisitos/requisitos.php" onchange="alterou()" method="post">

                        <?php

                            echo "<div class=\"item2\">

                                <div style=\"color:#999999;cursor:default;  margin-right:5px;\" class=\"leg-id2\"><b>ID Requisito</b></div>
                                <div style=\"width:150px;cursor:not-allowed;\" class=\"item-id2\"><select style=\"cursor:not-allowed;\" disabled > <option value=\"".$id."\">".$id."</option></select></div>

                            </div>";

                            echo "<div class=\"item2\">

                                <div style=\"color:#999999;cursor:default; margin-right:5px;\" class=\"leg-id2\"><b>ID Projeto</b></div>
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
                                <div style=\"width:150px; margin-left: 5px;\" class=\"item-id2\"><input id=\"cadastro\" onkeypress=\"alterou()\" name=\"cadastro\" required  type=\"date\" value=\"".$cadastro."\"></div>
                            ";

                            if($linha2['concluido']=='s'){
                                echo "<div class=\"leg-id2\" style=\"margin-right: 20px; margin-left: 20px; width:150px;\"><b>Tipo</b></div>
                                <div style=\"width:140px;\" class=\"item-id2\"><input id=\"tipo\" disabled class=\"numero\" type=\"number\" name=\"tipo\" value=\"".$tipo."\"></div>";
                            }
                            
                            else{
                                echo "<div class=\"leg-id2\" style=\"margin-right: 20px; margin-left: 20px; width:150px;\"><b>Tipo</b></div>
                                <div style=\"width:140px;\" class=\"item-id2\"><input id=\"tipo\" required onkeypress=\"alterou()\" class=\"numero\" type=\"number\" name=\"tipo\" value=\"".$tipo."\"></div>";
                            }
                                
                            echo "</div>

                                <div class=\"item2\">
                                <div class=\"leg-id2\"><b>Versão</b></div>
                                <div style=\"width:140px; margin-left: 5px;\" class=\"item-id2\"><input id=\"versao\" required class=\"numero\" onkeypress=\"alterou()\" type=\"number\" name=\"versao\" value=\"".$versao."\"></div>
                            ";

                            if($linha2['concluido']=='s'){
                                echo "<div class=\"leg-id2\" style=\" margin-left: 15px;margin-right:-5px;\"><b>Custo (R$)</b></div>
                                <div style=\"width:100px;\" class=\"item-id3\"><input style=\"padding-left:10px;\" step=\".01\" id=\"custo2\"class=\"numero\" disabled type=\"number\" name=\"custo\" value=\"".$custo."\"></div>
                                ";
                            }

                            else{
                                echo "<div class=\"leg-id2\" style=\" margin-left: 15px;margin-right:-5px;\"><b>Custo (R$)</b></div>
                                <div style=\"width:100px;\" class=\"item-id3\"><input style=\"padding-left:10px;\" step=\".01\" id=\"custo\"class=\"numero\" onkeypress=\"alterou()\" type=\"number\" name=\"custo\" value=\"".$custo."\"></div>
                                ";
                            }

                            echo "</div>
                                
                                <div class=\"item2\" style=\"width:400px;\">
                                    <button type=\"submit\" style=\"margin-top: 5px; margin-left:250px; cursor: pointer;\" value=\"".$id."\" id=\"altera\" name=\"altera\" class=\"salvar\">Salvar&nbsp;&nbsp;<i class=\"fas fa-check\"></i></button>
                                    <button type=\"submit\" style=\"margin-top: 5px; cursor: pointer;\" value=\"".$id."\"  id=\"cancela\" name=\"cancela\" class=\"cancelar\">Cancelar&nbsp;&nbsp;<i class=\"fas fa-times\"></i></button>
                                </div>
                                
                                <br><br>
                            ";

                        ?>

                        <?php
                    
                            if($linha2['concluido']=='n'){
                                echo "
                                    <div class=\"botoes\"><button type=\"submit\" value=\"".$id."\" name=\"arquiva\" style=\"cursor: pointer; margin-left:300px;\" class=\"arq\">Excluir</button></div>
                                ";
                            }
                        
                        ?>

                    </form>

                    <?php 
                    
                        if($linha2['concluido']=='n'){
                            echo "
                                <form action=\"../../front/mudancas/solic_mud.php\"  method=\"post\">
                                    <button type=\"submit\" value=\"".$id."\" name=\"mudanca\" style=\"cursor: pointer; margin-left:300px;\" class=\"arq\">Solicitar Mudança</button>
                                </form>
                            ";
                        }
                    
                    ?>
                    
                   <form action="../../front/mudancas/hist_mud.php?pagina=1&mudanca=<?php echo $id;?>" method="post">
                       <button type="submit" value="<?php echo $id; ?>" name="mudanca" style="cursor: pointer; margin-left:300px;" class="arq">Historico de mudanças</button>
                   </form>
                   
                </div>

            </div>

        </div>

        <script src="../../js/funcs_requisitos.js"></script>
        <script src="../../js/func_nav.js"></script>

    </body>

</html>