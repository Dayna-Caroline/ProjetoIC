<?php

    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";

    // Verifica o filtro usado na busca
    // erro = 2; a pagina não foi encontrada, voce foi redirecionado para a pagina inicial;

    if(!@$_GET['pagina'])
    { header("location: ../../front/projetos/menu.php?pagina=1&busca=".@$_GET['busca'].""); die(); }

    if(@$_GET['busca'])
    {
        $aux = $_GET['busca'];
        for ($i = 0; $i < strlen($aux); $i++)
            {
                $char = $aux[$i];
                if (is_numeric($char)) 
                {
                    $query = "SELECT id_projeto, descricao, responsavel FROM projeto WHERE empresa = '{$_SESSION['id_empresa']}' AND ativo='n' AND CAST(id_projeto AS CHAR) LIKE '%{$_GET['busca']}%' OR CAST(responsavel AS CHAR) LIKE '%{$_GET['busca']}%' OR descricao LIKE '%{$_GET['busca']}%';";
                } 
                else 
                {
                    $query = "SELECT id_projeto, descricao, responsavel FROM projeto WHERE empresa = '{$_SESSION['id_empresa']}' AND ativo='n' AND  descricao LIKE '%{$_GET['busca']}%';";
                    break;
                }
            }
    }
    
//

// sem filtros

    else
    { $query = "SELECT id_projeto, descricao, responsavel FROM projeto WHERE empresa = '{$_SESSION['id_empresa']}' AND ativo='n';"; }
//

// executa a query
    $result = mysqli_query($conecta, $query);
    $row = mysqli_num_rows($result);

    if($row==0&&@$_GET['pagina']>1)
    { header("location: ../../front/projetos/menu.php?pagina=1&busca=".$_GET['busca'].""); die(); }
//


?>

<!DOCTYPE html>

<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <link rel="stylesheet" href="../../styles/projetos/menu.css">
        <title>Smart Grid</title>
    </head>

    <body onclick="verifica()" onload="verifica()" >

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
                    <li class="navitem"><a href="../mudancas/controle.php?pagina=1"><i class="fas fa-cogs"></i><span class="nav-text">Controle</span></a></li>
                    <li class="navitem"><a href="../results/resultados.php"><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
                </ul>
            </div>

            <!-- PAGINA -->

            <div class="conteudo">

                <div>
                    <a href="menu.php?pagina=1"><p class="volt alt">&nbsp; &nbsp; &nbsp; &#8592;  Voltar</p></a>
                    <h1>Projetos Excluidos</h1>
                </div>

                <!--  BUSCA  -->
                <form class="projetos" action="../../front/projetos/restaurar.php" method="get">
                    <div class="busca">
                        <input type="text" class="busca" value="<?php if(@$_GET['busca']) echo $_GET['busca']; ?>" name="busca" id="busca" placeholder="Filtrar por ID, Descrição ou Responsável" autocomplete="off">
                        <button type="submit"><i class="fa fa-search icon" aria-hidden="true"></i></a>
                        <input type="text" style="visibility:hidden; height:0px; width:0px;" value="<?php if(@$_GET['pagina']) echo $_GET['pagina']; ?>" name="pagina">
                    </div>
                </form>
            
                <!--  TABELA  -->
                <form class="projetos" action="../../back/projetos/projetos.php" method="post">

                    <?php
                        
                        if($row != 0)
                        {
                            // Caso existam mais de 11 projetos cadastrados, exibe resultados em páginas

                            if( $row>10 )
                            {

                                $numpag=ceil($row/10);
                                $pagina=$_GET['pagina'];

                                if( (($pagina-1)*10)+1 > $row )//URL com pagina existente
                                { header("location: ../../front/projetos/restaurar.php?pagina=1&erro=2"); die(); }

                                $bot=(($pagina-1)*10)+1;
                                $top=$pagina*10;

                                // verifica a pagina atual
                                
                                if($top>$row){
                                    echo "<div class=\"botoes\">";
                                        echo "<div class=\"num-projetos\">".$row." projetos</div>";
                                        echo "<div class=\"exibir-resultados\"><b>Exibindo Projetos ".$bot." até ".$row."</b></div>"; 
                                        echo "<a style=\""; if($pagina==1) {echo"visibility: hidden;";} echo "\" href=\"restaurar.php?pagina=".($pagina-1)."&busca=".$_GET['busca']."\" class=\"next\">".($pagina-1)."<i style=\"color: #2096f7;\" class=\"fas fa-chevron-left\"></i></a>";
                                        echo "<p class=\"atual\">...</p>";
                                        echo "<a style=\""; if($pagina==$numpag) {echo"visibility: hidden;";} echo "\" href=\"restaurar.php?pagina=".($pagina+1)."&busca=".$_GET['busca']."\" class=\"next\"><i style=\"margin-right:0px; color: #2096f7\" class=\"fas fa-chevron-right\"></i>&nbsp;".($pagina+1)."</a>";
                                    echo "</div>";
                                }

                                else{
                                    echo "<div class=\"botoes\">";
                                        echo "<div class=\"num-projetos\">".$row." projetos</div>";
                                        echo "<div class=\"exibir-resultados\"><b>Exibindo Projetos ".$bot." até ".$top."</b></div>";    
                                        echo "<a style=\""; if($pagina==1) {echo"visibility: hidden;";} echo "\" href=\"restaurar.php?pagina=".($pagina-1)."&busca=".$_GET['busca']."\" class=\"next\">".($pagina-1)." <i style=\"color: #2096f7;\" class=\"fas fa-chevron-left\"></i></a>";
                                        echo "<p class=\"atual\">...</p>";
                                        echo "<a style=\""; if($pagina==$numpag) {echo"visibility: hidden;";} echo "\" href=\"restaurar.php?pagina=".($pagina+1)."&busca=".$_GET['busca']."\" class=\"next\"><i style=\"margin-right:0px; color: #2096f7\" class=\"fas fa-chevron-right\"></i>&nbsp;".($pagina+1)."</a>";                      
                                    echo "</div>";
                                }
                                
                                echo "
                                <div class=\"legenda\">
                                    <div title=\"Marcar todos\" class=\"leg-box\"><input id=\"marcatodos\" type=\"checkbox\" onclick=\"marca(this)\"> </div>
                                    <div title=\"ID do projeto\" class=\"leg-id\"><b>ID</b></div>
                                    <div title=\"Descrição do Projeto\" class=\"leg-desc\"><b>DESCRIÇÃO</b></div>
                                    <div title=\"ID do Funcionário responsável pelo projeto\" class=\"leg-res\"><b>RESPONSÁVEL</b></div>
                                </div>";

                                // Exibe os resultados

                                for($i=1; $i<=$row ; $i++ )
                                {

                                    $linha = mysqli_fetch_array($result);
                                    $id = $linha['id_projeto'];
                                    $descricao = $linha['descricao'];
                                    $responsavel = $linha['responsavel'];

                                
                                    if($i>=$bot&&$i<=$top)
                                    {
                                        echo "
                                        <div class=\"item\">
                                        <div class=\"item-box\"> <input id=".$id." value=".$id." name=\"check_list_restaurar[]\" type=\"checkbox\"> </div>
                                        <a href=\"\"\"><div class=\"item-id\">".$id."</div></a>
                                        <a href=\"\"><div class=\"item-desc\">".$descricao."</div></a>
                                        <a href=\"\"><div class=\"item-res\">".$responsavel."</div></a>
                                        </div>";
                                    }                                        
                            
                                }

                            }

                            // Exibe resultados em lista

                            else{

                                $pagina=$_GET['pagina'];

                                if( (($pagina-1)*10)+1 > $row )//URL com pagina existente
                                { header("location: ../../front/projetos/restaurar.php?pagina=1&erro=2"); die(); }

                                echo "<div class=\"botoes\">";
                                if($row>1)
                                {
                                    echo "<div class=\"num-projetos\">".$row." projetos</div>";
                                    echo "<div style=\"margin-left:230px;\" class=\"exibir-resultados\"><b>Exibindo ".$row." Projetos</b></div>";
                                }
                                else
                                {
                                    echo "<div class=\"num-projetos\">".$row." projeto</div>";
                                    echo "<div style=\"margin-left:240px;\" class=\"exibir-resultados\"><b>Exibindo ".$row." Projeto</b></div>";
                                }
                                echo "</div>";

                                echo "
                                <div class=\"legenda\">
                                    <div title=\"Marcar todos\" class=\"leg-box\"><input id=\"marcatodos\" type=\"checkbox\" onclick=\"marca(this)\"> </div>
                                    <div title=\"ID do projeto\" class=\"leg-id\"><b>ID</b></div>
                                    <div title=\"Descrição do Projeto\" class=\"leg-desc\"><b>DESCRIÇÃO</b></div>
                                    <div title=\"ID do Funcionário responsável pelo projeto\" class=\"leg-res\"><b>RESPONSÁVEL</b></div>
                                </div>";

                                for($i=0; $i<$row ; $i++ ){

                                    $linha = mysqli_fetch_array($result);
                                    $id = $linha['id_projeto'];
                                    $descricao = $linha['descricao'];
                                    $responsavel = $linha['responsavel'];

                                    echo "
                                        <div class=\"item\">
                                        <div class=\"item-box\"> <input id=".$id." value=".$id." name=\"check_list_restaurar[]\" type=\"checkbox\"> </div>
                                        <a href=\"\"><div class=\"item-id\">".$id."</div></a>
                                        <a href=\"\"><div class=\"item-desc\">".$descricao."</div></a>
                                        <a href=\"\"><div class=\"item-res\">".$responsavel."</div></a>
                                        </div>";
                                }
                            }

                        }

                        // Não encontrou nenhum projeto

                        else{
                            echo "
                            <div class=\"legenda\">
                                <div title=\"Marcar todos\" class=\"leg-box\"><input type=\"checkbox\" disabled> </div>
                                <div title=\"ID do projeto\" class=\"leg-id\"><b>ID</b></div>
                                <div title=\"Descrição do Projeto\" class=\"leg-desc\"><b>DESCRIÇÃO</b></div>
                                <div title=\"ID do Funcionário responsável pelo projeto\" class=\"leg-res\"><b>RESPONSÁVEL</b></div>
                            </div>

                            <div class=\"item\">
                            <div class=\"item-box\"> <input id=\"\" value=\"\" name=\"selecionado\" disabled type=\"checkbox\"> </div>
                            <div class=\"item-id\">---</div>
                            <div class=\"item-desc\">Nenhum projeto excluído.</div>
                            <div class=\"item-res\">---</div>
                            </div>";
                        }

                    ?>

                    <div class="botoes">
                        <button type="submit" disabled id="restaura" value="restaura" name="restaura" class="res">Restaurar</button>
                    </div>

                </form>

            </div>

        </div>

        <script src="../../js/funcs_res_proj.js"></script>

    </body>

</html>