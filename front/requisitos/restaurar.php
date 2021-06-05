<?php

    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";

    // Verifica o filtro usado na busca

    if(!@$_GET['proj'])
    { header("location: ../../front/projetos/menu.php?erro=1&pagina=1"); die(); }

    if(!@$_GET['pagina'])
    { header("location: ../../front/requisitos/restaurar.php?proj=".$_GET['proj']."&pagina=1&busca=".@$_GET['busca'].""); die(); }
    
    if(@$_GET['busca'])
    {
        $aux = $_GET['busca'];
        for ($i = 0; $i < strlen($aux); $i++)
            {
                $char = $aux[$i];
                if (is_numeric($char)) 
                {
                    $query = "SELECT DISTINCT requisitos.id_requisito, requisitos.descricao, requisitos.titulo FROM requisitos, projeto WHERE projeto.empresa = '{$_SESSION['id_empresa']}' AND requisitos.ativo='n' AND projeto.ativo='s' AND md5(projeto.id_projeto) = '{$_GET['proj']}' AND CAST(requisitos.id_requisito AS CHAR) LIKE '%{$_GET['busca']}%' OR requisitos.titulo LIKE '%{$_GET['busca']}%' OR requisitos.descricao LIKE '%{$_GET['busca']}%' AND projeto.id_projeto = requisitos.projeto;";
                } 
                else 
                {
                    $query = "SELECT DISTINCT requisitos.id_requisito, requisitos.descricao, requisitos.titulo FROM requisitos, projeto WHERE projeto.empresa = '{$_SESSION['id_empresa']}' AND requisitos.ativo='n' AND projeto.ativo='s' AND md5(projeto.id_projeto) = '{$_GET['proj']}' AND projeto.id_projeto = requisitos.projeto;";
                    break;
                }
            }
    }
    
    //

    // sem filtros
        else
        { $query = "SELECT DISTINCT requisitos.id_requisito, requisitos.descricao, requisitos.titulo FROM requisitos, projeto WHERE projeto.empresa = '{$_SESSION['id_empresa']}' AND requisitos.ativo='n' AND projeto.ativo='s' AND md5(projeto.id_projeto) = '{$_GET['proj']}' AND projeto.id_projeto = requisitos.projeto;"; }
    //

    // executa a query
        $result = mysqli_query($conecta, $query);
        $row = mysqli_num_rows($result);

        if($row==0&&@$_GET['pagina']>1)
        { 
            header("location: ../../front/requisitos/restaurar.php?proj=".$_GET['proj']."&pagina=1&busca=".$_GET['busca'].""); die();
        }
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

    <body onclick="verifica()" onload="verifica()">

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

                <?php echo "<a href=\"../requisitos/requisitos.php?proj=".$_GET['proj']."&pagina=1\"><p class=\"volt alt\">&nbsp; &nbsp; &nbsp; &#8592;  Voltar</p></a>"; ?>

                <h1>Requisitos Excluidos do Projeto <?php 

                    $sql = "SELECT id_projeto FROM projeto WHERE md5(id_projeto) = '{$_GET['proj']}';";
                    $resultado = mysqli_query($conecta, $sql);
                    $linha=mysqli_fetch_array($resultado);
                    echo $linha['id_projeto'];

                ?></h1>

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
                            // Caso existam mais de 11 requisitos cadastrados, exibe resultados em páginas

                            if( $row>10 )
                            {

                                $numpag=ceil($row/10);
                                $pagina=$_GET['pagina'];

                                if( (($pagina-1)*10)+1 > $row )//URL com pagina inesistente
                                {
                                    header("location: ../../front/requisitos/restaurar.php?proj=".$_GET['proj']."&pagina=1&busca=".$_GET['busca']."&erro=1"); die();
                                }

                                $bot=(($pagina-1)*10)+1;
                                $top=$pagina*10;

                                // verifica a pagina atual
                                
                                if($top>$row){
                                    echo "<div class=\"botoes\">";
                                        echo "<div class=\"num-projetos\">".$row." requisitos</div>";
                                        echo "<div class=\"exibir-resultados\"><b>Exibindo Requisitos ".$bot." até ".$row."</b></div>"; 
                                        echo "<a style=\""; if($pagina==1) {echo"visibility: hidden;";} echo "\" href=\"restaurar.php?proj=".$_GET['proj']."&pagina=".($pagina-1)."&busca=".$_GET['busca']."\" class=\"next\">".($pagina-1)."<i style=\"color: #2096f7;\" class=\"fas fa-chevron-left\"></i></a>";
                                        echo "<p class=\"atual\">...</p>";
                                        echo "<a style=\""; if($pagina==$numpag) {echo"visibility: hidden;";} echo "\" href=\"restaurar.php?proj=".$_GET['proj']."&pagina=".($pagina+1)."&busca=".$_GET['busca']."\" class=\"next\"><i style=\"margin-right:0px; color: #2096f7\" class=\"fas fa-chevron-right\"></i>&nbsp;".($pagina+1)."</a>";
                                    echo "</div>";
                                }

                                else{
                                    echo "<div class=\"botoes\">";
                                        echo "<div class=\"num-projetos\">".$row." requisitos</div>";
                                        echo "<div class=\"exibir-resultados\"><b>Exibindo Requisitos ".$bot." até ".$top."</b></div>";    
                                        echo "<a style=\""; if($pagina==1) {echo"visibility: hidden;";} echo "\" href=\"restaurar.php?proj=".$_GET['proj']."&pagina=".($pagina-1)."&busca=".$_GET['busca']."\" class=\"next\">".($pagina-1)." <i style=\"color: #2096f7;\" class=\"fas fa-chevron-left\"></i></a>";
                                        echo "<p class=\"atual\">...</p>";
                                        echo "<a style=\""; if($pagina==$numpag) {echo"visibility: hidden;";} echo "\" href=\"restaurar.php?proj=".$_GET['proj']."&pagina=".($pagina+1)."&busca=".$_GET['busca']."\" class=\"next\"><i style=\"margin-right:0px; color: #2096f7\" class=\"fas fa-chevron-right\"></i>&nbsp;".($pagina+1)."</a>";                      
                                    echo "</div>";
                                }
                                
                                echo "
                                <div class=\"legenda\">
                                    <div title=\"Marcar todos\" class=\"leg-box\"><input type=\"checkbox\" id=\"marcatodos\" onclick=\"marca(this)\"> </div>
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
                                        <div class=\"item-box\"> <input id=".$id." value=".$id." name=\"check_list_restaurar[]\" type=\"checkbox\"> </div>
                                        <a href=\"\"><div class=\"item-id\">".$id."</div></a>
                                        <a href=\"\"><div class=\"item-desc\">".$descricao."</div></a>
                                        <a href=\"\"><div class=\"item-res\">".$titulo."</div></a>
                                        </div>";
                                    }                                        
                            
                                }

                            }

                            // Exibe resultados em lista

                            else{

                                $pagina=$_GET['pagina'];

                                if( (($pagina-1)*10)+1 > $row )//URL com pagina inesistente
                                {
                                    header("location: ../../front/requisitos/restaurar.php?proj=".$_GET['proj']."&pagina=1&busca=".$_GET['busca']."&erro=1"); die();
                                }

                                echo "<div class=\"botoes\">";
                                if($row>1)
                                {
                                    echo "<div class=\"num-projetos\">".$row." requisitos</div>";
                                    echo "<div class=\"exibir-resultados\"><b>Exibindo ".$row." Requisitos</b></div>";
                                }
                                else
                                {
                                    echo "<div class=\"num-projetos\">".$row." requisito</div>";
                                    echo "<div class=\"exibir-resultados\"><b>Exibindo ".$row." Requisito</b></div>";
                                }
                                echo "</div>";

                                echo "
                                <div class=\"legenda\">
                                    <div title=\"Marcar todos\" class=\"leg-box\"><input type=\"checkbox\" id=\"marcatodos\" onclick=\"marca(this)\"> </div>
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
                                        <div class=\"item-box\"> <input id=".$id." value=".$id." name=\"check_list_restaurar[]\" type=\"checkbox\"> </div>
                                        <a href=\"\"><div class=\"item-id\">".$id."</div></a>
                                        <a href=\"\"><div class=\"item-desc\">".$descricao."</div></a>
                                        <a href=\"\"><div class=\"item-res\">".$titulo."</div></a>
                                        </div>";
                                }
                            }

                        }

                        // Não encontrou nenhum requisito

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
                            <div class=\"item-desc\">Nenhum requisito foi excluído.</div>
                            <div class=\"item-res\">---</div>
                            </div>";
                        }

                    ?>

                    <div class="botoes">
                        <button type="submit" disabled id="restaura" value="<?php echo $_GET['proj']; ?>" name="restaura" class="res">Restaurar</button>
                    </div>

            </div>

        </div>

        <script src="../../js/funcs_res_proj.js"></script>

    </body>

</html>