<?php

    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";

    $query = "SELECT id_profissional, nome, empresa FROM profissional WHERE empresa = '{$_SESSION['id_empresa']}' AND profissional.ativo = 's';";

    // executa a query
    // mensagem = 1: cadastre um funcionario antes de cadastrar um projeto;

    $result = mysqli_query($conecta, $query);
    $row = mysqli_num_rows($result);

    if($row==0)
    { header("location: ../../front/funcs/funcionarios.php?pagina=1&m=1"); die(); }

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
                    <a href="menu.php?pagina=1"><p class="volt alt">&#8592;  Voltar</p></a>
                    <h1>Criar projeto</h1>
                </div>

                <?php
                    switch(@$_GET['s'])
                    {

                        case 2:
                            echo "<div id=\"erro\" class=\"erro\" onclick=\"fecha_e()\">
                                <p><i class=\"fas fa-exclamation-triangle\"></i> Não foi possível concluír o cadastro do projeto!</p>
                            </div>";
                        break;

                        case 3:
                            $campos=explode("_",$_GET['e']);
                            echo "<div id=\"erro\" class=\"aviso\" onclick=\"fecha_e()\">
                                <br><p><b><i class=\"fas fa-exclamation-triangle\"></i> Atenção! Verifique os seguintes campos:</b></p><br>";
                                foreach($campos as $aux){
                                    if($aux=='1')echo"<p> - Responsável</p><br>";
                                    if($aux=='2')echo"<p> - Descrição (entre 20 e 100 caracteres)</p><br>";
                                    if($aux=='3')echo"<p> - Finalidade (entre 20 e 100 caracteres)</p><br>";
                                    if($aux=='4')echo"<p> - Orçamento</p><br>";
                                    if($aux=='5')echo"<p> - Inicio</p><br>";
                                    if($aux=='6')echo"<p> - Aprovação</p><br>";
                                    if($aux=='7')echo"<p> - Prévia do término</p><br>";
                                }
                            echo "</div>";
                        break;
                    }
                        
                ?>

                <form class="projetos2" method="post" action="../../back/projetos/projetos.php">

                    <?php
                        echo "<div class=\"item2\">
                            <div class=\"leg-id2 ab\"><b>Responsável</b></div>
                            <div class=\"item-id2\">
                                <select name=\"responsavel\" style=\"cursor: pointer; padding-left:10px;\" required id=\"responsavel\">";

                                for($i=0;$i<$row;$i++){
                                    $linha = mysqli_fetch_array($result);
                                    echo "<option value=\"".$linha['id_profissional']."\">".$linha['id_profissional']." - ".$linha['nome']."</option>";
                                }

                                echo "</select>
                            </div>
                        </div>";

                        echo "<div class=\"item2\">
                            <div class=\"leg-id2 ab\"><b>Descrição do projeto</b></div>
                            <div class=\"item-id2\"><input required type=\"text\" maxlenght=\"100\" size=\"100\" style=\"padding-left:10px;\" name=\"descricao\" autocomplete='off'></div>
                        </div>";

                        echo "<div class=\"item2\">
                            <div class=\"leg-id2 ab\"><b>Finalidade do projeto</b></div>
                            <div class=\"item-id2\"><input required type=\"text\" maxlenght=\"100\" style=\"padding-left:10px;\" name=\"finalidade\" autocomplete='off'></div>
                        </div>";

                        echo "<div class=\"item2\">
                        
                            <div class=\"leg-id2 ab\" ><b>Orçamento (R$)</b></div>
                            <div style=\"width:140px;\" class=\"item-id2 ab\"><input style=\"padding-left:10px;\" required autocomplete='off' class=\"numero\" type=\"number\" name=\"orcamento\" step=\".01\"></div>
                            
                            <div class=\"leg-id2\" style=\"margin-left: 10px; margin-right: -5px;\" ><b>Data de Aprovação</b></div>
                            <div style=\"width:150px;\" class=\"item-id2\"><input style=\"padding-left:10px;\" required autocomplete='off' name=\"aprovacao\" type=\"date\"></div>
                        
                        </div>";

                        echo "<div class=\"item2\">
                        
                            <div class=\"leg-id2 ab\"><b>Data de Início</b></div>
                            <div style=\"width:150px;\" class=\"item-id2 ab\"><input style=\"padding-left:10px;\" required autocomplete='off' name=\"inicio\" type=\"date\"></div>
                            
                            <div class=\"leg-id2 ab\" style=\"margin-left: 25px;margin-right: -30px;\"><b>Prévia do término</b></div>
                            <div style=\"width:150px;\" class=\"item-id2\"><input style=\"padding-left:10px;\" required autocomplete='off' name=\"previa\" type=\"date\"></div>
                       
                        </div>";

                    ?>

                    <br><div class="botoes">
                        <button type="submit" value="cadastrar" name="cadastrar" class="novo" style="cursor: pointer;margin-left:300px;">Concluír Cadastro</button>
                    </div>

                </div>
            
            </div>

        </div>

        <script src="../../js/funcs_cad_proj.js"></script>

    </body>

</html>