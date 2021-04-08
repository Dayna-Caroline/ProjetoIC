<?php

    error_reporting(0);
    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";

    // Verifica o filtro usado na busca

        if(!@$_GET['proj'])
        { echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../front/projetos/menu.php'>"; }

        if(!@$_GET['pagina'])
        { echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../front/requisitos/requisitos.php?proj=\"".$_GET['proj']."\"&pagina=1&busca=".@$_GET['busca']."'>"; }

        if(@$_GET['busca'])
        {
            $aux = $_GET['busca'];
            for ($i = 0; $i < strlen($aux); $i++)
                {
                    $char = $aux[$i];
                    if (is_numeric($char)) 
                    {
                        $query = "SELECT DISTINCT requisitos.id_requisito, requisitos.descricao, requisitos.titulo FROM requisitos, projeto WHERE projeto.empresa = '{$_SESSION['id_empresa']}' AND md5(projeto.id_projeto) = '{$_GET['proj']}' AND CAST(requisitos.id_requisito AS CHAR) LIKE '%{$_GET['busca']}%' OR requisitos.titulo LIKE '%{$_GET['busca']}%' OR requisitos.descricao LIKE '%{$_GET['busca']}%';";
                    } 
                    else 
                    {
                        $query = "SELECT DISTINCT requisitos.id_requisito, requisitos.descricao, requisitos.titulo FROM requisitos, projeto WHERE projeto.empresa = '{$_SESSION['id_empresa']}' AND md5(projeto.id_projeto) = '{$_GET['proj']}'";
                        break;
                    }
                }
        }
        
    //

    // sem filtros
        else
        { $query = "SELECT DISTINCT requisitos.id_requisito, requisitos.descricao, requisitos.titulo FROM requisitos, projeto WHERE projeto.empresa = '{$_SESSION['id_empresa']}' AND md5(projeto.id_projeto) = '{$_GET['proj']}';"; }
    //

    // executa a query
        $result = mysqli_query($conecta, $query);
        $row = mysqli_num_rows($result);

        if($row==0&&@$_GET['pagina']>1)
        { echo "<<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../front/requisitos/requisitos.php?pagina=1&busca=".$_GET['busca']."'>"; }
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

    <body>

        <div class="tudo">

        <div class="aba">
                <div class="logo">
                    <a href="../../front/projetos/menu.php"><img src="../../imgs/logo.png" alt="Logo da empresa" class="img-logo"></a>
                    <h2 class="nav-text">Smart Grids</h2>
                </div>
                <ul>
                    <li class="navitem"><a href="../empresa/empresa.php"><i class="fas fa-city"></i><span class="nav-text">Empresa</span></a></li>
                    <li class="navitem pag"><a href="../projetos/menu.php?pagina=1"><i class="fas fa-stream"></i><span class="nav-text">Projetos</span></a></li>
                    <li class="navitem"><a href="../funcs/funcionarios.php?pagina=1"><i class="fas fa-users"></i><span class="nav-text">Funcionários</span></a></li>
                    <li class="navitem"><a href="../equip/equipamentos.php"><i class="fas fa-battery-three-quarters"></i><span class="nav-text">Equipamentos</span></a></li>
                    <li class="navitem"><a href="../mudancas/controle.php"><i class="fas fa-cogs"></i><span class="nav-text">Controle</span></a></li>
                    <li class="navitem"><a href="../results/resultados.php"><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
                </ul>
            </div>

            <div class="conteudo">

                <h1>Requisitos do Projeto <?php ?></h1>

                <!--  BUSCA  -->
                <form class="projetos" action="../../front/requisitos/requisitos.php" method="get">
                    <div class="busca">
                        <input type="text" class="busca" value="<?php if(@$_GET['busca']) echo $_GET['busca']; ?>" name="busca" id="busca" placeholder="Filtrar por ID, Descrição ou Título" autocomplete="off">
                        <button type="submit"><i class="fa fa-search icon" aria-hidden="true"></i></a>
                        <input type="text" style="visibility:hidden; height:0px; width:0px;" value="<?php if(@$_GET['pagina']) echo $_GET['pagina']; ?>" name="pagina">
                        <input type="text" style="visibility:hidden; height:0px; width:0px;" value="<?php if(@$_GET['proj']) echo $_GET['proj']; ?>" name="proj">
                    </div>
                </form>

                <!--  TABELA  -->
                <form class="projetos" action="../../back/requisitos/requisitos.php" method="post">

                    <?php
                        
                        if($row != 0)
                        {
                            // Caso existam mais de 11 projetos cadastrados, exibe resultados em páginas

                            if( $row>10 )
                            {

                                $numpag=ceil($row/10);
                                $pagina=$_GET['pagina'];

                                if( (($pagina-1)*10)+1 > $row )//URL com pagina existente
                                {
                                    echo '<script language="javascript">';
                                    echo "alert('Página não encontrada.')";
                                    echo '</script>';
                                    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../front/requisitos/requisitos.php?pagina=1'>";
                                }

                                $bot=(($pagina-1)*10)+1;
                                $top=$pagina*10;

                                // verifica a pagina atual
                                
                                if($top>$row){
                                    echo "<div class=\"botoes\">";
                                        echo "<div class=\"num-projetos\">".$row." requisitos</div>";
                                        echo "<div class=\"exibir-resultados\"><b>Exibindo Requisitos ".$bot." até ".$row."</b></div>"; 
                                        echo "<a style=\""; if($pagina==1) {echo"visibility: hidden;";} echo "\" href=\"requisitos.php?pagina=".($pagina-1)."&busca=".$_GET['busca']."\" class=\"next\">".($pagina-1)."<i style=\"color: #2096f7;\" class=\"fas fa-chevron-left\"></i></a>";
                                        echo "<p class=\"atual\">...</p>";
                                        echo "<a style=\""; if($pagina==$numpag) {echo"visibility: hidden;";} echo "\" href=\"requisitos.php?pagina=".($pagina+1)."&busca=".$_GET['busca']."\" class=\"next\"><i style=\"margin-right:0px; color: #2096f7\" class=\"fas fa-chevron-right\"></i>&nbsp;".($pagina+1)."</a>";
                                    echo "</div>";
                                }

                                else{
                                    echo "<div class=\"botoes\">";
                                        echo "<div class=\"num-projetos\">".$row." requisitos</div>";
                                        echo "<div class=\"exibir-resultados\"><b>Exibindo Requisitos ".$bot." até ".$top."</b></div>";    
                                        echo "<a style=\""; if($pagina==1) {echo"visibility: hidden;";} echo "\" href=\"requisitos.php?pagina=".($pagina-1)."&busca=".$_GET['busca']."\" class=\"next\">".($pagina-1)." <i style=\"color: #2096f7;\" class=\"fas fa-chevron-left\"></i></a>";
                                        echo "<p class=\"atual\">...</p>";
                                        echo "<a style=\""; if($pagina==$numpag) {echo"visibility: hidden;";} echo "\" href=\"requisitos.php?pagina=".($pagina+1)."&busca=".$_GET['busca']."\" class=\"next\"><i style=\"margin-right:0px; color: #2096f7\" class=\"fas fa-chevron-right\"></i>&nbsp;".($pagina+1)."</a>";                      
                                    echo "</div>";
                                }
                                
                                echo "
                                <div class=\"legenda\">
                                    <div title=\"Marcar todos\" class=\"leg-box\"><input type=\"checkbox\" onclick=\"marca(this)\"> </div>
                                    <div title=\"ID do requisito\" class=\"leg-id\"><b>ID</b></div>
                                    <div title=\"Descrição do requisito\" class=\"leg-desc\"><b>DESCRIÇÃO</b></div>
                                    <div title=\"Titulo do requisito\" class=\"leg-res\"><b>TÍTULO</b></div>
                                </div>";

                                // Exibe os resultados

                                for($i=1; $i<=$row ; $i++ )
                                {

                                    $linha = mysqli_fetch_array($result);
                                    $id = $linha['id_requisito'];
                                    $descricao = $linha['descricao'];
                                    $titulo = $linha['titulo'];

                                
                                    if($i>=$bot&&$i<=$top)
                                    {
                                        echo "
                                        <div class=\"item\">
                                        <div class=\"item-box\"> <input id=".$id." value=".$id." name=\"check_list[]\" type=\"checkbox\"> </div>
                                        <a href=\"projeto.php?id=".md5($id)."\"><div class=\"item-id\">".$id."</div></a>
                                        <a href=\"projeto.php?id=".md5($id)."\"><div class=\"item-desc\">".$descricao."</div></a>
                                        <a href=\"projeto.php?id=".md5($id)."\"><div class=\"item-res\">".$titulo."</div></a>
                                        </div>";
                                    }                                        
                            
                                }

                            }

                            // Exibe resultados em lista

                            else{

                                echo "<div class=\"botoes\">";
                                if($row>1)
                                {
                                    echo "<div class=\"num-projetos\">".$row." requisitos</div>";
                                    echo "<div class=\"exibir-resultados\"><b>Exibindo ".$row." Requisitoss</b></div>";
                                }
                                else
                                {
                                    echo "<div class=\"num-projetos\">".$row." requisito</div>";
                                    echo "<div class=\"exibir-resultados\"><b>Exibindo ".$row." Requisito</b></div>";
                                }
                                echo "</div>";

                                echo "
                                <div class=\"legenda\">
                                    <div title=\"Marcar todos\" class=\"leg-box\"><input type=\"checkbox\" onclick=\"marca(this)\"> </div>
                                    <div title=\"ID do requisito\" class=\"leg-id\"><b>ID</b></div>
                                    <div title=\"Descrição do requisito\" class=\"leg-desc\"><b>DESCRIÇÃO</b></div>
                                    <div title=\"Titulo do requisito\" class=\"leg-res\"><b>TÍTULO</b></div>
                                </div>";

                                for($i=0; $i<$row ; $i++ ){

                                    $linha = mysqli_fetch_array($result);
                                    $id = $linha['id_requisito'];
                                    $descricao = $linha['descricao'];
                                    $titulo = $linha['titulo'];

                                    echo "
                                        <div class=\"item\">
                                        <div class=\"item-box\"> <input id=".$id." value=".$id." name=\"check_list[]\" type=\"checkbox\"> </div>
                                        <a href=\"projeto.php?id=".md5($id)."\"><div class=\"item-id\">".$id."</div></a>
                                        <a href=\"projeto.php?id=".md5($id)."\"><div class=\"item-desc\">".$descricao."</div></a>
                                        <a href=\"projeto.php?id=".md5($id)."\"><div class=\"item-res\">".$titulo."</div></a>
                                        </div>";
                                }
                            }

                        }

                        // Não encontrou nenhum projeto

                        else{
                            echo "
                            <div class=\"legenda\">
                                <div title=\"Marcar todos\" class=\"leg-box\"><input type=\"checkbox\" onclick=\"marca(this)\"> </div>
                                <div title=\"ID do requisito\" class=\"leg-id\"><b>ID</b></div>
                                <div title=\"Descrição do requisito\" class=\"leg-desc\"><b>DESCRIÇÃO</b></div>
                                <div title=\"Titulo do requisito\" class=\"leg-res\"><b>TÍTULO</b></div>
                            </div>

                            <div class=\"item\">
                            <div class=\"item-box\"> <input id=\"\" value=\"\" name=\"selecionado\" disabled type=\"checkbox\"> </div>
                            <div class=\"item-id\">---</div>
                            <div class=\"item-desc\">Nenhum requisito foi encontrado.</div>
                            <div class=\"item-res\">---</div>
                            </div>";
                        }

                    ?>

                    <div class="botoes">
                        <button type="submit" value="novo" name="novo" class="novo" style="cursor: pointer;">Adiconar Requisito</button>
                        <button type="submit" disabled id="arquiva" value="arquivar" name="arquiva" class="arq">Excluir Selecionados</button>
                    </div>

                </form>

            </div>

        </div>

        <script src="../../js/funcs_menu.js"></script>

    </body>

</html>