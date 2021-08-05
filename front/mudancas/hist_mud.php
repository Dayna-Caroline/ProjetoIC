<?php
    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";

    if(!$_GET['pagina']||$_GET['pagina']=="0")
    {
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../front/mudancas/hist_mud.php?pagina=1'>";
    }

    $id_req=$_GET['mudanca'];
?>

<!DOCTYPE html>

<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <link rel="stylesheet" href="../../styles/mud/menu_mud.css">
        <link rel="stylesheet" href="../../styles/mud/mud.css">
        
        <title>Smart Grid</title>
    </head>

    <body>

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
                    <li class="navitem"><a href="../controle/consumo.php?pagina=1"><i class="fas fa-cogs"></i><span class="nav-text">Consumo</span></a></li>
                    <li class="navitem"><a href="../results/resultados.php"><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
                </ul>
            </div>
                
            <div class="conteudo" id="conteudo">

            <div>
                    <a href="../projetos/menu.php?pagina=1"><p class="volt alt">&nbsp; &nbsp; &nbsp; &#8592;  Voltar</p></a>
                   
             </div>
                
            <h1>CONTROLE DE MUDANÇAS</h1>

             <form class="projetos" action="" method="post">
             <?php
                function data($data)
                {
                   return date("d/m/Y", strtotime($data));
                }
                 
            $query = "SELECT descricao, pedido, solicitante FROM mudancas WHERE requisito = '$id_req' order by pedido;";


                        $result = mysqli_query($conecta, $query);
                        $row = mysqli_num_rows($result);
                        
                        if($row != 0)
                        {
                            // Caso não haja filtro ou existam mais de 11 projetos cadastrados, exibe resultados em páginas

                            if( $row>10  )
                            {

                                $numpag=ceil($row/10);
                                $pagina=$_GET['pagina'];

                                if( (($pagina-1)*10)+1 > $row )//URL com pagina existente
                                {
                                    echo '<script language="javascript">';
                                    echo "alert('Página não encontrada.')";
                                    echo '</script>';
                                    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../front/mudancas/hist_mud.php?pagina=1'>";
                                }

                                $bot=(($pagina-1)*10)+1;
                                $top=$pagina*10;

                                // verifica a pagina atual
                                
                                if($top>$row){
                                    echo "<div class=\"botoes\">";
                                        echo "<div class=\"num-projetos\">".$row." Mudanças</div>";
                                        echo "<div class=\"exibir-resultados\"><b>Exibindo Mudanças ".$bot." até ".$row."</b></div>"; 
                                        echo "<a style=\""; if($pagina==1) {echo"visibility: hidden;";} echo "\" href=\"hist_mud.php?pagina=".($pagina-1)."\" class=\"next\">".($pagina-1)." <i style=\"color: #2096f7;\" class=\"fas fa-chevron-left\"></i></a>";
                                        echo "<p class=\"atual\">...</p>";
                                        echo "<a style=\""; if($pagina==$numpag) {echo"visibility: hidden;";} echo "\" href=\"hist_mud.php?pagina=".($pagina+1)."\" class=\"next\"><i style=\"margin-right:0px; color: #2096f7\" class=\"fas fa-chevron-right\"></i>&nbsp;".($pagina+1)."</a>";
                                    echo "</div>";
                                }

                                else{
                                    echo "<div class=\"botoes\">";
                                        echo "<div class=\"num-projetos\">".$row." Mudanças</div>";
                                        echo "class=\"exibir-resultados\"><b>Exibindo Mudanças ".$bot." até ".$top."</b></div>";    
                                        echo "<a style=\""; if($pagina==1) {echo"visibility: hidden;";} echo "\" href=\"hist_mud.php?pagina=".($pagina-1)."\" class=\"next\">".($pagina-1)." <i style=\"color: #2096f7;\" class=\"fas fa-chevron-left\"></i></a>";
                                        echo "<p class=\"atual\">...</p>";
                                        echo "<a style=\""; if($pagina==$numpag) {echo"visibility: hidden;";} echo "\" href=\"hist_mud.php?pagina=".($pagina+1)."\" class=\"next\"><i style=\"margin-right:0px; color: #2096f7\" class=\"fas fa-chevron-right\"></i>&nbsp;".($pagina+1)."</a>";                      
                                    echo "</div>";
                                }
                                
                                echo "
                                <div class=\"legenda\">
                                    <div class=\"leg-box\"><input type=\"checkbox\" id=\"marcatodos\" onclick=\"marca(this)\"></div>
                                    <div class=\"leg-id\"><b>DATA</b></div>
                                    <div class=\"leg-desc\"><b>MUDANÇA</b></div>
                                    <div  class=\"leg-res\"><b>SOLICITANTE</b></div>
                                </div>";

                                // Exibe os resultados
                                
                                

                                for($i=1; $i<=$row ; $i++ )
                                {

                                    $linha = mysqli_fetch_array($result);
                                    $data= data($linha['pedido']);
                                    $nome = $linha['descricao'];
                                    $id_solic=$linha['solicitante'];

                                    $querys = "SELECT nome FROM profissional WHERE id_profissional = '$id_solic';";
                                    $results = mysqli_query($conecta, $querys);
                                    $rows = mysqli_fetch_array($results);
                                    
                                        $nome_solic = $rows['nome'];
                                    

                                   /* $sqlso="select nome from profissional where id_profissional = '$id_solic';";
                                    $result = mysqli_query($conecta, $sqlso);
                                    $row = mysqli_num_rows($result);
                                    $nome_solic = $row['nome'];*/
                                
                                    if($i>=$bot&&$i<=$top)
                                    {
                                        echo "
                                        <div class=\"item\">
                                        <div class=\"item-box\"> <input id=".$data." value=".$data." name=\"check_list[]\" type=\"checkbox\"> </div>
                                        <div class=\"item-id\">".$data."</div>
                                        <div class=\"item-desc\">".$nome."</div>
                                        <div class=\"item-res\">".$nome_solic."</div>
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
                                    <div class=\"leg-id\"><b>DATA</b></div>
                                    <div class=\"leg-desc\"><b>MUDANÇAS</b></div>
                                    <div  class=\"leg-res\"><b>SOLICITANTE</b></div>
                                    
                                </div>";

                                for($i=0; $i<$row ; $i++ ){

                                    $linha = mysqli_fetch_array($result);
                                    $data = data($linha['pedido']);
                                    $nome = $linha['descricao'];
                                    $id_solic = $linha['solicitante'];

                                    

                                   $sqlso="select nome from profissional where id_profissional = '$id_solic';";
                                    $results = mysqli_query($conecta, $sqlso);
                                    $rows = mysqli_fetch_array($results);
                                   
                                    
                                        $nome_solic = $rows['nome'];
                                   
                                   
                                   // $nome_solic = $rows['nome'];
                                    echo "
                                        <div class=\"item\">
                                        <div class=\"item-box\"> <input id=".$data." value=".$data." name=\"check_list[]\" type=\"checkbox\"> </div>
                                        <div class=\"item-id\">".$data."</div>
                                        <div class=\"item-desc\">".$nome."</div>
                                        <div class=\"item-res\">".$nome_solic."</div>
                                        </div>";
                                }
                            }

                        }

                        // Não encontrou nenhum projeto

                        else{
                            echo "
                            <div class=\"legenda\">
                                <div class=\"leg-box\"><input type=\"checkbox\" disabled></div>
                                <div class=\"leg-id\"><b>DATA</b></div>
                                <div class=\"leg-desc\"><b>MUDANÇAS</b></div>
                                <div  class=\"leg-res\"><b>SOLICITANTE</b></div>
                            </div>
                            <div class=\"item\">
                            <div class=\"item-box\"> <input id=\"\" value=\"\" name=\"selecionado\" disabled type=\"checkbox\"> </div>
                            <div class=\"item-id\">---</div>
                            <div class=\"item-desc\"> não possuí MUDANÇAS solicitadas</div>
                            <div class=\"item-res\"></div>
                            </div>";
                        }
                      
                    ?>
                    <div class="botoes">
                     
            
                
                    </div>
                </form>
            </div>
            
        </div>
    </body>
</html>



