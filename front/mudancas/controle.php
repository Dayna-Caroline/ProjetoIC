<?php
    error_reporting(0);
    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";


    if(!$_GET['pagina']||$_GET['pagina']=="0")
    {
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../front/mudancas/controle.php?pagina=1'>";
    }

   /*if(!@$_GET['proj'])
        { echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../front/requisitos/requisitos.php'>"; }*/
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
    <body onclick="verifica()">

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

                <h1>Controle de Mudanças</h1>

                <!-- ------------------------------- BUSCA ----------------------------- -->
                <form class="projetos" action="../../front/mudancas/controle.php?pagina=1" method="post">
                    <div class="busca">
                        <input type="text" class="busca" value="<?php if(@$_POST['busca']) echo $_POST['busca']; ?>" name="busca" id="busca" placeholder="Filtrar por ID ou descricao" autocomplete="off">
                        <button type="submit"><i class="fa fa-search icon" aria-hidden="true"></i></a>
                    </div>
                </form>

                <!-- ------------------------------ TABELA ----------------------------- -->
                <form class="projetos" action="../../front/mudancas/controle.php" method="post">

                    <?php

                        // Verifica o filtro usado na busca
          if(@$_GET['busca'])
          {          
                   
            $aux = $_GET['busca'];
            for ($i = 0; $i < strlen($aux); $i++)
                {
                    $char = $aux[$i];
                    if (is_numeric($char)) 
                    {
                        $query = "SELECT DISTINCT mudancas.id_mudanca, mudancas.descricao, mudanca.requisito  FROM mudancas, requisitos, projeto WHERE projeto.empresa = '{$_SESSION['id_empresa']}' AND CAST(mudancas.id_mudanca AS CHAR) LIKE '%{$_GET['busca']}%' OR mudanca.descricao LIKE '%{$_GET['busca']}%' ;";
                    } 
                    else 
                    {
                        $query = "SELECT DISTINCT mudancas.id_mudanca, mudanca.descricao, mudanca.requisito FROM mudancas, projeto, requisitos WHERE projeto.empresa = '{$_SESSION['id_empresa']}' ";
                        break;
                    }
                }
        }
        
                         else
                             
                        { $query = "SELECT DISTINCT mudancas.id_mudanca, mudanca.descricao, mudanca.requisito FROM mudancas, requisitos, projeto WHERE projeto.empresa = '{$_SESSION['id_empresa']}';"; }  
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
                                        echo "<div class=\"exibir-resultados\"><b>Exibindo mudancas ".$bot." até ".$row."</b></div>"; 
                                        echo "<a style=\""; if($pagina==1) {echo"visibility: hidden;";} echo "\" href=\"controle.php?pagina=".($pagina-1)."\" class=\"next\">".($pagina-1)." <i style=\"color: #2096f7;\" class=\"fas fa-chevron-left\"></i></a>";
                                        echo "<p class=\"atual\">...</p>";
                                        echo "<a style=\""; if($pagina==$numpag) {echo"visibility: hidden;";} echo "\" href=\"controle.php?pagina=".($pagina+1)."\" class=\"next\"><i style=\"margin-right:0px; color: #2096f7\" class=\"fas fa-chevron-right\"></i>&nbsp;".($pagina+1)."</a>";
                                    echo "</div>";
                                }

                                else{
                                    echo "<div class=\"botoes\">";
                                        echo "<div class=\"num-projetos\">".$row." Mudanças</div>";
                                        echo "class=\"exibir-resultados\"><b>Exibindo mudanças ".$bot." até ".$top."</b></div>";    
                                        echo "<a style=\""; if($pagina==1) {echo"visibility: hidden;";} echo "\" href=\"controle.php?pagina=".($pagina-1)."\" class=\"next\">".($pagina-1)." <i style=\"color: #2096f7;\" class=\"fas fa-chevron-left\"></i></a>";
                                        echo "<p class=\"atual\">...</p>";
                                        echo "<a style=\""; if($pagina==$numpag) {echo"visibility: hidden;";} echo "\" href=\"controle.php?pagina=".($pagina+1)."\" class=\"next\"><i style=\"margin-right:0px; color: #2096f7\" class=\"fas fa-chevron-right\"></i>&nbsp;".($pagina+1)."</a>";                      
                                    echo "</div>";
                                }
                                
                                echo "
                                <div class=\"legenda\">
                                    <div class=\"leg-box\"><input type=\"checkbox\" onclick=\"marca(this)\"></div>
                                    <div class=\"leg-id\"><b>ID Mudança </b></div>
                                    <div class=\"leg-id\"><b>ID Requsiito </b></div>
                                    <div class=\"leg-desc\"><b>Mudanças Solicitadas</b></div>
                                </div>";

                                // Exibe os resultados

                                for($i=1; $i<=$row ; $i++ )
                                {

                                    $linha = mysqli_fetch_array($result);
                                    $id_mudanca = $linha['id_mudanca'];
                                    $desc = $linha['descricao'];
                                    $id_req=$linha['id_requisito'];

                                
                                    if($i>=$bot&&$i<=$top)
                                    {
                                        echo "
                                        <div class=\"item\">
                                        <div class=\"item-box\"> <input id=".$id_mudanca." value=".$id_mudanca." name=\"check_list[]\" type=\"checkbox\"> </div>
                                        <div class=\"item-id\">".$id_mudanca."</div>
                                        <div class=\"item-desc\">".$desc."</div>
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
                                    echo "<div class=\"exibir-resultados\"><b>Exibindo ".$row." Mudanças</b></div>";
                                }
                                else
                                {
                                    echo "<div class=\"num-projetos\">".$row." Mudança</div>";
                                    echo "<div class=\"exibir-resultados\"><b>Exibindo ".$row." Mudanças</b></div>";
                                }
                                echo "</div>";

                                echo "
                                <div class=\"legenda\">
                                    <div class=\"leg-box\"><input type=\"checkbox\" onclick=\"marca(this)\"> </div>
                                    <div class=\"leg-id\"><b>ID PROJ</b></div>
                                    <div class=\"leg-desc\"><b>MUDANÇAS</b></div>
                                </div>";

                                for($i=0; $i<$row ; $i++ ){

                                    $linha = mysqli_fetch_array($result);
                                    $id_mudanca = $linha['id_mudanca'];
                                    $desc = $linha['descricao'];

                                    echo "
                                        <div class=\"item\">
                                        <div class=\"item-box\"> <input id=".$id_mudanca." value=".$id_mudanca." name=\"check_list[]\" type=\"checkbox\"> </div>
                                        <div class=\"item-id\">".$id_mudanca."</div>
                                        <div class=\"item-desc\">".$desc."</div>
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
                                <div class=\"leg-desc\"><b>FUNCIONÁRIO</b></div>
                            </div>
                            <div class=\"item\">
                            <div class=\"item-box\"> <input id=\"\" value=\"\" name=\"selecionado\" disabled type=\"checkbox\"> </div>
                            <div class=\"item-id\">---</div>
                            <div class=\"item-desc\">Sua empresa não possuí funcionários cadastrados</div>
                            <div class=\"item-res\">---</div>
                            </div>";
                        }
                    ?>

                   
                </form>
            
            </div>

        </div>

     <script src="../../js/funcs_menu.js"></script>
    </body>

</html>