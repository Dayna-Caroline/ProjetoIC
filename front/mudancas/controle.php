<?php
    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";

    if(!$_GET['pagina']||$_GET['pagina']=="0")
    {
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../front/mudancas/controle.php?pagina=1'>";
    }
?>

<!DOCTYPE html>

<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <link rel="stylesheet" href="../../styles/mud/mudancas.css">
        <title>Smart Grid</title>
    </head>

    <body onclick="verifica()" onload="verifica()">

        <div class="tudo">

        <div class="aba">
                <div class="logo">
                    <a href="../../front/projetos/menu.php"><img src="../../imgs/logo.png" alt="Logo da empresa" class="img-logo"></a>
                    <h2 class="nav-text">Smart Grids</h2>
                </div>
                <ul>
                    <li class="navitem"><a href="../empresa/empresa.php"><i class="fas fa-city"></i><span class="nav-text">Empresa</span></a></li>
                    <li class="navitem"><a href="../projetos/menu.php?pagina=1"><i class="fas fa-stream"></i><span class="nav-text">Projetos</span></a></li>
                    <li class="pag navitem"><a href="../funcs/funcionarios.php?pagina=1"><i class="fas fa-users"></i><span class="nav-text">Funcionários</span></a></li>
                    <li class="navitem"><a href="../equip/equipamentos.php"><i class="fas fa-battery-three-quarters"></i><span class="nav-text">Equipamentos</span></a></li>
                    <li class="navitem"><a href="../mudancas/controle.php?pagina=1"><i class="fas fa-cogs"></i><span class="nav-text">Controle</span></a></li>
                    <li class="navitem"><a href="../results/resultados.php"><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
                </ul>
            </div>

            <div class="conteudo">

                <h1>MUDANÇAS</h1>

                <!-- ------------------------------- BUSCA ----------------------------- -->
                <form class="projetos" action="../../front/mudancas/controle.php?pagina=1" method="post">
                    <div class="busca">
                        <input type="text" class="busca" value="<?php if(@$_POST['busca']) echo $_POST['busca']; ?>" name="busca" id="busca" placeholder="Filtrar por ID ou descrição" autocomplete="off">
                        <button type="submit"><i class="fa fa-search icon" aria-hidden="true"></i></a>
                    </div>
                </form>

                <!-- ------------------------------ TABELA ----------------------------- -->
                <form class="projetos" action="" method="post">

                    <?php

                        // Verifica o filtro usado na busca
                    

                        if(@$_POST['busca'])
                        {
                            $aux = $_POST['busca'];
                            for ($i = 0; $i < strlen($aux); $i++)
                            {
                                $char = $aux[$i];
                                if (is_numeric($char)) 
                                {
                                    $query = "SELECT id_mudanca, descricao FROM mudancas WHERE empresa = '{$_SESSION['id_empresa']}'  AND CAST(id_mudanca AS CHAR) LIKE '%{$_POST['busca']}%' OR CAST(descricao AS CHAR) LIKE '%{$_POST['busca']}%';";
                                } 
                                else 
                                {
                                    $query = "SELECT id_mudanca, descricao FROM mudancas WHERE empresa = '{$_SESSION['id_empresa']}'  AND descricao LIKE '%{$_POST['busca']}%';";
                                    break;
                                }
                            }
                        }

                        else // sem filtros
                        {
                            $query = "SELECT id_mudanca, descricao FROM mudancas WHERE empresa = '{$_SESSION['id_empresa']}' ;";
                        }

                        $result = mysqli_query($conecta, $query);
                        $row = mysqli_num_rows($result);
                        
                        if($row != 0)
                        {
                            // Caso não haja filtro ou existam mais de 11 projetos cadastrados, exibe resultados em páginas

                            if( $row>10 && @!$_POST['busca'] )
                            {

                                $numpag=ceil($row/10);
                                $pagina=$_GET['pagina'];

                                if( (($pagina-1)*10)+1 > $row )//URL com pagina existente
                                {
                                    echo '<script language="javascript">';
                                    echo "alert('Página não encontrada.')";
                                    echo '</script>';
                                    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../front/mudancas/controle.php?pagina=1'>";
                                }

                                $bot=(($pagina-1)*10)+1;
                                $top=$pagina*10;

                                // verifica a pagina atual
                                
                                if($top>$row){
                                    echo "<div class=\"botoes\">";
                                        echo "<div class=\"num-projetos\">".$row." Mudanças</div>";
                                        echo "<div class=\"exibir-resultados\"><b>Exibindo Mudanças ".$bot." até ".$row."</b></div>"; 
                                        echo "<a style=\""; if($pagina==1) {echo"visibility: hidden;";} echo "\" href=\"controle.php?pagina=".($pagina-1)."\" class=\"next\">".($pagina-1)." <i style=\"color: #2096f7;\" class=\"fas fa-chevron-left\"></i></a>";
                                        echo "<p class=\"atual\">...</p>";
                                        echo "<a style=\""; if($pagina==$numpag) {echo"visibility: hidden;";} echo "\" href=\"controle.php?pagina=".($pagina+1)."\" class=\"next\"><i style=\"margin-right:0px; color: #2096f7\" class=\"fas fa-chevron-right\"></i>&nbsp;".($pagina+1)."</a>";
                                    echo "</div>";
                                }

                                else{
                                    echo "<div class=\"botoes\">";
                                        echo "<div class=\"num-projetos\">".$row." Mudanças</div>";
                                        echo "class=\"exibir-resultados\"><b>Exibindo Mudanças ".$bot." até ".$top."</b></div>";    
                                        echo "<a style=\""; if($pagina==1) {echo"visibility: hidden;";} echo "\" href=\"controle.php?pagina=".($pagina-1)."\" class=\"next\">".($pagina-1)." <i style=\"color: #2096f7;\" class=\"fas fa-chevron-left\"></i></a>";
                                        echo "<p class=\"atual\">...</p>";
                                        echo "<a style=\""; if($pagina==$numpag) {echo"visibility: hidden;";} echo "\" href=\"controle.php?pagina=".($pagina+1)."\" class=\"next\"><i style=\"margin-right:0px; color: #2096f7\" class=\"fas fa-chevron-right\"></i>&nbsp;".($pagina+1)."</a>";                      
                                    echo "</div>";
                                }
                                
                                echo "
                                <div class=\"legenda\">
                                    <div class=\"leg-box\"><input type=\"checkbox\" id=\"marcatodos\" onclick=\"marca(this)\"></div>
                                    <div class=\"leg-id\"><b>ID</b></div>
                                    <div class=\"leg-desc\"><b>FUNCIONÁRIO</b></div>
                                </div>";

                                // Exibe os resultados

                                for($i=1; $i<=$row ; $i++ )
                                {

                                    $linha = mysqli_fetch_array($result);
                                    $id = $linha['id_mudanca'];
                                    $nome = $linha['descricao'];

                                
                                    if($i>=$bot&&$i<=$top)
                                    {
                                        echo "
                                        <div class=\"item\">
                                        <div class=\"item-box\"> <input id=".$id." value=".$id." name=\"check_list[]\" type=\"checkbox\"> </div>
                                        <div class=\"item-id\">".$id."</div>
                                        <div class=\"item-desc\">".$nome."</div>
                                        </div>";
                                    }                                        
                            
                                }

                            }

                            // Exibe resultados em lista

                            else{

                                echo "<div class=\"botoes\">";
                                if($row>1)
                                {
                                    echo "<div class=\"num-projetos\">".$row." Mudanças</div>";
                                    echo "<div class=\"exibir-resultados\"><b>Exibindo ".$row." MUDANCAS</b></div>";
                                }
                                else
                                {
                                    echo "<div class=\"num-projetos\">".$row." Mudanças</div>";
                                    echo "<div class=\"exibir-resultados\"><b>Exibindo ".$row." MUDANCAS</b></div>";
                                }
                                echo "</div>";

                                echo "
                                <div class=\"legenda\">
                                    <div class=\"leg-box\"><input id=\"marcatodos\" type=\"checkbox\" onclick=\"marca(this)\"> </div>
                                    <div class=\"leg-id\"><b>ID</b></div>
                                    <div class=\"leg-desc\"><b>MUDANÇAS</b></div>
                                </div>";

                                for($i=0; $i<$row ; $i++ ){

                                    $linha = mysqli_fetch_array($result);
                                    $id = $linha['id_profissional'];
                                    $nome = $linha['nome'];

                                    echo "
                                        <div class=\"item\">
                                        <div class=\"item-box\"> <input id=".$id." value=".$id." name=\"check_list[]\" type=\"checkbox\"> </div>
                                        <div class=\"item-id\">".$id."</div>
                                        <div class=\"item-desc\">".$nome."</div>
                                        </div>";
                                }
                            }

                        }

                        // Não encontrou nenhum projeto

                        else{
                            echo "
                            <div class=\"legenda\">
                                <div class=\"leg-box\"><input type=\"checkbox\" disabled></div>
                                <div class=\"leg-id\"><b>ID</b></div>
                                <div class=\"leg-desc\"><b>mudanças</b></div>
                            </div>
                            <div class=\"item\">
                            <div class=\"item-box\"> <input id=\"\" value=\"\" name=\"selecionado\" disabled type=\"checkbox\"> </div>
                            <div class=\"item-id\">---</div>
                            <div class=\"item-desc\">Sua empresa não possuí MUDANÇAS solicitadas</div>
                            <div class=\"item-res\">---</div>
                            </div>";
                        }
                    
                    ?>

                    <div class="botoes">
                        <a href=""><button value="" name="" class="novo func" style="cursor: pointer;">Solicitar Mudança</button></a>
                       
                    </div>

                </form>
            
            </div>

        </div>


    </body>

</html>