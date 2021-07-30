<?php

    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";

    $query = "SELECT * FROM projeto WHERE empresa = '{$_SESSION['id_empresa']}' AND ativo = 's' AND md5(id_projeto) = '{$_GET['id']}';";

    // executa a query
    // erro = 1: não encontrou o projeto;

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
        $previa=$linha['previa'];
        $fim=$linha['fim'];
        $custo=$linha['custo'];
        $c_final=$linha['c_final'];
        $id_empresa=$linha['empresa'];
        $ativo=$linha['ativo'];
        $concluido=$linha['concluido'];
    }
    
    else
    { header("location: ../../front/projetos/menu.php?e=1&pagina=1"); die(); }

    $query3 = "SELECT * FROM profissional WHERE empresa = '{$_SESSION['id_empresa']}' AND profissional.ativo = 's' AND id_profissional='$linha[responsavel]';";
    $result3 = mysqli_query($conecta, $query3);
    $row3 = mysqli_num_rows($result3);
    if($row3==0)
    { header("location: ../../front/projetos/menu.php?pagina=1&e=3"); die(); }
    
    $query2 = "SELECT id_profissional, nome, empresa FROM profissional WHERE empresa = '{$_SESSION['id_empresa']}'AND profissional.ativo = 's';";
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
                    <a href="menu.php?pagina=1"><p class="volt alt">&#8592;  Voltar</p></a>
                    <h1>Detalhes do projeto - <?php echo $id;?></h1>
                </div>

                <div class="espaco" style="margin-bottom: -40px;"></div>

                <!--  PROJETO (LER, ALTERAR, EXCLUIR, CONCLUIR)  -->
                <div class="projetos2">

                    <div class="botoes">
                        <button id="visualizar" onclick="visualizar();" class="visualizar" style="cursor: pointer;">visualizar</button>
                        <button id="editar" onclick="editar()" class="editar" style="cursor: pointer;">editar</button>
                    </div>

                    <?php
                            switch(@$_GET['s'])
                            {
                                case 1:
                                    echo "<div id=\"sucesso\" class=\"sucesso2\" onclick=\"fecha_s()\">
                                        <p><i class=\"fas fa-check\"></i> Alterações salvas com sucesso!</p>
                                    </div>";
                                break;

                                case 2:
                                    echo "<div id=\"erro\" class=\"erro2\" onclick=\"fecha_e()\">
                                        <p><i class=\"fas fa-exclamation-triangle\"></i> Não foi possível concluír as alterações!</p>
                                    </div>";
                                break;

                                case 3:
                                    $campos=explode("_",$_GET['e']);
                                    echo "<div id=\"erro\" class=\"aviso2\" onclick=\"fecha_e()\">
                                        <br><p><b><i class=\"fas fa-exclamation-triangle\"></i> Atenção! Verifique os seguintes campos:</b></p><br>";
                                        foreach($campos as $aux){
                                            if($aux=='1')echo"<p> - Responsável</p><br>";
                                            if($aux=='2')echo"<p> - Descrição (deve conter entre 10 e 100 caracteres)</p><br>";
                                            if($aux=='3')echo"<p> - Finalidade (deve conter entre 10 e 100 caracteres)</p><br>";
                                            if($aux=='4')echo"<p> - Orçamento</p><br>";
                                            if($aux=='5')echo"<p> - Inicio</p><br>";
                                            if($aux=='6')echo"<p> - Aprovação</p><br>";
                                            if($aux=='7')echo"<p> - Prévia do término</p><br>";
                                        }
                                    echo "</div>";
                                break;

                                case 4:
                                    echo "<div id=\"erro\" class=\"erro2\" onclick=\"fecha_e()\">
                                        <p><i class=\"fas fa-exclamation-triangle\"></i>Não foi possível concluír o projeto!</p>
                                    </div>";
                                break;

                                case 5:
                                    echo "<div id=\"erro\" class=\"erro2\" onclick=\"fecha_e()\">
                                        <p><i class=\"fas fa-exclamation-triangle\"></i>Não foi possível excluír o projeto!</p>
                                    </div>";
                                break;

                                case 7:
                                    echo "<div id=\"sucesso\" class=\"sucesso2\" onclick=\"fecha_s()\">
                                        <p><i class=\"fas fa-check\"></i> O projeto foi concluído!</p>
                                    </div>";
                                break;

                                case 8:
                                    echo "<div id=\"sucesso\" class=\"sucesso2\" onclick=\"fecha_s()\">
                                        <p><i class=\"fas fa-check\"></i> O projeto foi reaberto!</p>
                                    </div>";
                                break;

                                case 9:
                                    echo "<div id=\"erro\" class=\"erro2\" onclick=\"fecha_e()\">
                                        <p><i class=\"fas fa-exclamation-triangle\"></i>Não foi possível reabrir o projeto!</p>
                                    </div>";
                                break;

                            }
                        
                        ?>

                    <form action="../../back/projetos/projetos.php" onchange="alterou()" method="post">

                        <?php

                            echo "<div class=\"item2\">
                                <div class=\"leg-id2 ab\" style=\"margin-right: 1px;\"><b>Responsável</b></div>

                                <div style=\"width:150px;\" class=\"item-id2\">
                                    <select style=\"padding-left:10px;\" name=\"responsavel\" id=\"profissional\">";

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
                                <div class=\"leg-id2 ab\"><b>Descrição</b></div>
                                <div class=\"item-id2\"><input style=\"padding-left:10px;\" type=\"text\" maxlenght=\"100\" id=\"descricao\" onkeypress=\"alterou()\" name=\"descricao\" value=\"".$descricao."\"></div>
                            </div>";

                            echo "<div class=\"item2\">
                                <div class=\"leg-id2 ab\"><b>Finalidade</b></div>
                                <div class=\"item-id2\"><input style=\"padding-left:10px;\" type=\"text\" maxlenght=\"100\" id=\"finalidade\" onkeypress=\"alterou()\" name=\"finalidade\" value=\"".$finalidade."\"></div>
                            </div>";

                            echo "<div class=\"item2\">
                            
                                <div class=\"leg-id2 ab\" style=\"margin-right: 1px;\"><b>Orçamento (R$)</b></div>
                                <div style=\"width:140px;\" class=\"item-id2\"><input style=\"padding-left:10px;\" id=\"orcamento\" class=\"numero\" type=\"number\" name=\"orcamento\" step=\".01\" value=\"".$orcamento."\"></div>
                                
                                <div class=\"leg-id2\" style=\"margin-left: 15px; margin-right: -5px;\" ><b>Data de Aprovação</b></div>
                                <div style=\"width:150px;\" class=\"item-id2\"><input style=\"padding-left:10px; padding-right:3px; \" id=\"aprovacao\" name=\"aprovacao\" type=\"date\" value=\"".$aprovacao."\"></div>
                                
                            </div>";

                            echo "<div class=\"item2\">
                            
                                <div class=\"leg-id2 ab\" style=\"margin-right: 1px;\"><b>Data de Início</b></div>
                                <div style=\"width:150px;\" class=\"item-id2\"><input style=\"padding-left:10px; padding-right:3px;\" id=\"inicio\" name=\"inicio\" type=\"date\" value=\"".$inicio."\"></div>
                                
                                <div class=\"leg-id2 ab resp\" id=\"resp\" ><b>Previa do término</b></div>
                                <div style=\"width:150px;\" class=\"item-id2\"><input style=\"padding-left:10px; padding-right:3px;\" id=\"previa\" name=\"previa\" type=\"date\" value=\"".$previa."\"></div>

                            </div>";

                            echo "<div class=\"item2\">";

                                if($concluido=='s')
                                { echo "
                                <div class=\"leg-id2\" style=\" margin-left: -30px;margin-right:35px;\"><b>Custo final (R$)</b></div>
                                <div style=\"width:140px;\" class=\"item-id2\"><input style=\"padding-left:10px;\" id=\"c_final\"class=\"numero\" type=\"number\" name=\"c_final\" value=\"".$c_final."\"></div>
                                
                                <div class=\"leg-id2 ab\" style=\"margin-left: 40px; margin-right:-30px;\"><b>Data do término</b></div>
                                <div style=\"width:150px;\" class=\"item-id2\"><input style=\"padding-left:10px; padding-right:3px;\" id=\"fim\" name=\"fim\" type=\"date\" value=\"".$fim."\"></div>
                                </div>

                                <div class=\"item2\" style=\"width:400px;\">
                                    <button type=\"submit\" style=\"margin-top: 5px; margin-left:250px; cursor: pointer;\" value=\"".$id."\" id=\"salvar\" name=\"salvar_concluido\" class=\"salvar\">Salvar&nbsp;&nbsp;<i class=\"fas fa-check\"></i></button>
                                    <button type=\"submit\" style=\"margin-top: 5px; cursor: pointer;\" value=\"".$id."\"  id=\"cancelar\" name=\"cancelar\" class=\"cancelar\">Cancelar&nbsp;&nbsp;<i class=\"fas fa-times\"></i></button>
                                </div>

                                ";}

                                else
                                { echo "
                                <div class=\"leg-id2\" style=\" margin-left: -50px;margin-right:55px;\"><b>Custo (R$)</b></div>
                                <div style=\"width:300px;\" class=\"item-id3\"><input style=\"padding-left:10px;\" id=\"custo\"class=\"numero\" type=\"number\" name=\"custo\" value=\"".$custo."\"></div>
                                
                                <button type=\"submit\" style=\"margin-top: -5px; margin-left:-80px; cursor: pointer;\" value=\"".$id."\" id=\"salvar\" name=\"salvar\" class=\"salvar\">Salvar&nbsp;&nbsp;<i class=\"fas fa-check\"></i></button>
                                <button type=\"submit\" style=\"margin-top: -5px; cursor: pointer;\" value=\"".$id."\"  id=\"cancelar\" name=\"cancelar\" class=\"cancelar\">Cancelar&nbsp;&nbsp;<i class=\"fas fa-times\"></i></button>
                                
                                </div>";
                            }

                        ?>

                        <div class="botoes" style="margin-top:30px;">

                            <?php
                                if($concluido=='n')
                                { echo "<button type=\"submit\" value=\"".$id."\" name=\"conclui\" class=\"conclui\" style=\"cursor: pointer; margin-left:100px;\">Concluír</button>
                                        <button type=\"submit\" value=\"".$id."\" name=\"req\" class=\"req\" style=\"cursor: pointer;\">Requisitos</button>
                                "; }
                                else
                                { echo "<button type=\"submit\" value=\"".$id."\" name=\"reabrir\" class=\"conclui\" style=\"cursor: pointer; margin-left:100px;\">Reabrir</button>
                                        <button type=\"submit\" value=\"".$id."\" name=\"req\" class=\"req\" style=\"cursor: pointer;\">Requisitos</button>
                                "; }
                            ?>

                            <button type="submit" value="<?php echo $id; ?>" name="arquiva" style="cursor: pointer;" class="arq">Excluir</button>
                        
                        </div>

                    </form>

                </div>
            
            </div>

        </div>

        <script src="../../js/funcs_projetos.js"></script>
        <script src="../../js/func_nav.js"></script>

    </body>

</html>