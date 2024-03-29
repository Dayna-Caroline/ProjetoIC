<?php 
    
    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";

    // Verifica o filtro usado na busca
    // erro = 2; a pagina não foi encontrada, voce foi redirecionado para a pagina inicial;

        if(!@$_GET['pagina'])
        { header("location: ../../front/projetos/menu.php?pagina=1&busca=".@$_GET['busca'].""); die(); }

        if(!@$_GET['filtro'])
        { $_GET['filtro']="nofilter"; }

        switch($_GET['filtro']){

            case "nofilter":
                $filtro="";
            break;

            case "pendente":
                $filtro=" AND concluido='n' ";
            break;

            case "concluido":
                $filtro=" AND concluido='s' ";
            break;

        }

        if(@$_GET['busca'])
        {
            $aux = $_GET['busca'];
            for ($i = 0; $i < strlen($aux); $i++)
                {
                    $char = $aux[$i];
                    if (is_numeric($char)) 
                    {
                        $query = "SELECT projeto.id_projeto, projeto.descricao, projeto.responsavel, profissional.nome FROM projeto, profissional WHERE (projeto.empresa = '{$_SESSION['id_empresa']}' $filtro AND profissional.ativo = 's' AND projeto.ativo='s' AND projeto.responsavel = profissional.id_profissional AND profissional.empresa = '{$_SESSION['id_empresa']}') AND (CAST(id_projeto AS CHAR) LIKE '%{$_GET['busca']}%' OR CAST(responsavel AS CHAR) LIKE '%{$_GET['busca']}%' OR descricao LIKE '%{$_GET['busca']}%') ORDER BY id_projeto;";
                    } 
                    else 
                    {
                        $query = "SELECT projeto.id_projeto, projeto.descricao, projeto.responsavel, profissional.nome FROM projeto, profissional WHERE (projeto.empresa = '{$_SESSION['id_empresa']}' $filtro AND profissional.ativo = 's' AND projeto.ativo='s' AND projeto.responsavel = profissional.id_profissional AND profissional.empresa = '{$_SESSION['id_empresa']}') AND  (descricao LIKE '%{$_GET['busca']}%') ORDER BY id_projeto;";
                        break;
                    }
                }
        }
        
    //

    // sem filtros

        else
        { $query = "SELECT projeto.id_projeto, projeto.descricao, projeto.responsavel, profissional.nome FROM projeto, profissional WHERE projeto.empresa = '{$_SESSION['id_empresa']}' $filtro AND profissional.ativo = 's' AND projeto.ativo='s' AND projeto.responsavel = profissional.id_profissional AND profissional.empresa = '{$_SESSION['id_empresa']}' ORDER BY id_projeto;"; }
    //

    // executa a query
        $result = mysqli_query($conecta, $query);
        $row = mysqli_num_rows($result);

        if($row==0&&@$_GET['pagina']>1)
        { header("location: ../../front/projetos/menu.php?pagina=1&e=2&busca=".$_GET['busca'].""); die(); }
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

    <body onclick="verifica()" onload="verifica();" >

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
                    <li class="navitem"><a href="../controle/consumo.php?pagina=1"><i class="fas fa-cogs"></i><span class="nav-text">Consumo</span></a></li>
                    <li class="navitem"><a href="../results/resultados.php"><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
                </ul>
            </div>

            <!-- PAGINA -->

            <div class="conteudo" id="conteudo" >

                <div>
                    <h1>Meus Projetos</h1>
                </div>

                <!-- ERRO -->
                <?php
                    switch(@$_GET['e'])
                    {
                        case 1:
                            echo "<div id=\"erro\" class=\"aviso\" onclick=\"fecha_e()\">
                                <p><i class=\"fas fa-exclamation-triangle\"></i> Projeto não encontrado! Você foi redirecionado para a primeira página.</p>
                            </div>";
                        break;

                        case 2:
                            echo "<div id=\"erro\" class=\"aviso\" onclick=\"fecha_e()\">
                                <p><i class=\"fas fa-exclamation-triangle\"></i> Página não encontrada! Você foi redirecionado para a primeira página.</p>
                            </div>";
                        break;
                        
                        case 3:
                            echo "<div id=\"erro\" class=\"aviso\" onclick=\"fecha_e()\">
                                <p><i class=\"fas fa-exclamation-triangle\"></i> O projeto que você está tentando acessar foi desativado!</p>
                            </div>";      
                        break;
                    }

                    switch(@$_GET['s'])
                    {
                        case 1:
                            echo "<div id=\"sucesso\" class=\"sucesso\" onclick=\"fecha_s()\">
                                <p><i class=\"fas fa-check\"></i> Projeto cadastrado com sucesso! </p>
                            </div>";
                        break;

                        case 8:
                            echo "<div id=\"sucesso\" class=\"sucesso\" onclick=\"fecha_s()\">
                                <p><i class=\"fas fa-check\"></i> O projeto foi excluído!</p>
                            </div>";
                        break;

                        case 5:
                            echo "<div id=\"erro\" class=\"erro\" onclick=\"fecha_e()\">
                                <p><i class=\"fas fa-exclamation-triangle\"></i> Não foi possível excluír o projeto!</p>
                            </div>";
                        break;
                    
                    }
                
                ?>

                <!--  BUSCA  -->
                <form class="projetos" action="../../front/projetos/menu.php" method="get">
                    
                    <div class="busca">
                        <input type="text" class="busca" value="<?php if(@$_GET['busca']) echo $_GET['busca']; ?>" name="busca" id="busca" placeholder="Buscar por ID, Descrição ou Responsável(ID)" autocomplete="off">
                        <button type="submit"><i class="fa fa-search icon" aria-hidden="true"></i></a>
                        <input type="text" style="visibility:hidden; height:0px; width:0px;" value="<?php if(@$_GET['pagina']) echo $_GET['pagina']; ?>" name="pagina">
                    </div>

                    <div class="radFiltro">

                        <input type="radio" <?php if(@$_GET['filtro']=="nofilter") echo "checked"; ?> class="radItem" id="nofilter" name="filtro" value="nofilter">
                        <label class="radLeg" for="nofilter">Todos</label><span class="divisor">&nbsp;&nbsp;&nbsp;|</span>

                        <input type="radio" <?php if(@$_GET['filtro']=="pendente") echo "checked"; ?> class="radItem" id="pendente" name="filtro" value="pendente">
                        <label class="radLeg" for="pendente">Pendentes</label><span class="divisor">&nbsp;&nbsp;&nbsp;|</span>

                        <input type="radio" <?php if(@$_GET['filtro']=="concluido") echo "checked"; ?> class="radItem" id="concluido" name="filtro" value="concluido">
                        <label class="radLeg" for="concluido">Concluídos</label>

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
                                { header("location: ../../front/projetos/menu.php?pagina=1&e=2&busca=".$_GET['busca'].""); die(); }

                                $bot=(($pagina-1)*10)+1;
                                $top=$pagina*10;

                                // verifica a pagina atual
                                
                                if($top>$row){
                                    echo "<div class=\"botoes\">";
                                        echo "<div class=\"num-projetos\">".$row." projetos</div>";
                                        echo "<div class=\"exibir-resultados\"><b>Exibindo Projetos ".$bot." até ".$row."</b></div>"; 
                                        echo "<a style=\""; if($pagina==1) {echo"visibility: hidden;";} echo "\" href=\"menu.php?pagina=".($pagina-1)."&busca=".$_GET['busca']."\" class=\"next\">".($pagina-1)."<i style=\"color: #2096f7;\" class=\"fas fa-chevron-left\"></i></a>";
                                        echo "<p class=\"atual\">...</p>";
                                        echo "<a style=\""; if($pagina==$numpag) {echo"visibility: hidden;";} echo "\" href=\"menu.php?pagina=".($pagina+1)."&busca=".$_GET['busca']."\" class=\"next\"><i style=\"margin-right:0px; color: #2096f7\" class=\"fas fa-chevron-right\"></i>&nbsp;".($pagina+1)."</a>";
                                    echo "</div>";
                                }

                                else{
                                    echo "<div class=\"botoes\">";
                                        echo "<div class=\"num-projetos\">".$row." projetos</div>";
                                        echo "<div class=\"exibir-resultados\"><b>Exibindo Projetos ".$bot." até ".$top."</b></div>";    
                                        echo "<a style=\""; if($pagina==1) {echo"visibility: hidden;";} echo "\" href=\"menu.php?pagina=".($pagina-1)."&busca=".$_GET['busca']."\" class=\"next\">".($pagina-1)." <i style=\"color: #2096f7;\" class=\"fas fa-chevron-left\"></i></a>";
                                        echo "<p class=\"atual\">...</p>";
                                        echo "<a style=\""; if($pagina==$numpag) {echo"visibility: hidden;";} echo "\" href=\"menu.php?pagina=".($pagina+1)."&busca=".$_GET['busca']."\" class=\"next\"><i style=\"margin-right:0px; color: #2096f7\" class=\"fas fa-chevron-right\"></i>&nbsp;".($pagina+1)."</a>";                      
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
                                    $nome = $linha['nome'];

                                
                                    if($i>=$bot&&$i<=$top)
                                    {
                                        echo "
                                        <div class=\"item\">
                                        <div class=\"item-box\"> <input id=".$id." value=".$id." name=\"check_list[]\" type=\"checkbox\"> </div>
                                        <a href=\"projeto.php?id=".md5($id)."\"><div class=\"item-id\">".$id."</div></a>
                                        <a href=\"projeto.php?id=".md5($id)."\"><div class=\"item-desc\">".$descricao."</div></a>
                                        <a href=\"projeto.php?id=".md5($id)."\"><div class=\"item-res\">".$responsavel." - ".$nome."</div></a>
                                        </div>";
                                    }                                        
                            
                                }

                            }

                            // Exibe resultados em lista

                            else{

                                $pagina=$_GET['pagina'];

                                if( (($pagina-1)*10)+1 > $row )//URL com pagina existente
                                { header("location: ../../front/projetos/menu.php?pagina=1&e=2&busca=".$_GET['busca'].""); die(); }

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
                                    $nome = $linha['nome'];

                                    echo "
                                        <div class=\"item\">
                                        <div class=\"item-box\"> <input id=".$id." value=".$id." name=\"check_list[]\" type=\"checkbox\"> </div>
                                        <a href=\"projeto.php?id=".md5($id)."\"><div class=\"item-id\">".$id."</div></a>
                                        <a href=\"projeto.php?id=".md5($id)."\"><div class=\"item-desc\">".$descricao."</div></a>
                                        <a href=\"projeto.php?id=".md5($id)."\"><div class=\"item-res\">".$responsavel." - ".$nome."</div></a>
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
                            <div class=\"item-desc\">Nenhum projeto foi encontrado.</div>
                            <div class=\"item-res\">---</div>
                            </div>";
                        }

                    ?>

                    <div class="botoes">
                        <button type="submit" value="novo" name="novo" class="novo" style="cursor: pointer;">Novo</button>
                        <button type="submit" disabled id="arquiva" value="arquivar" name="arquiva" class="arq">Excluir</button>
                        <button type="submit" id="restaurar" value="restaurar" name="restaurar" class="restaurar"><i class="fas fa-trash-restore-alt"></i></button>
                    </div>

                </form>
            
            </div>

        </div>

        <script src="../../js/funcs_menu.js"></script>

    </body>

</html>
