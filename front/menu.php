<?php
    include "../back/autenticacao.php";
    include "../back/conexao_local.php";
    if(!$_GET['pagina']||$_GET['pagina']=="0")
    {
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../front/menu.php?pagina=1'>";
    }
?>

<!DOCTYPE html>

<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <link rel="stylesheet" href="../styles/menu.css">
        <title>Smart Grid</title>
    </head>

    <body>

        <div class="tudo">

            <div class="aba">

                <div class="logo">
                    <a href="../index.php"><img src="../imgs/logo.png" alt="Logo da empresa" class="img-logo"></a>
                    <h2>Smart Grids</h2>
                </div>

                <ul>
                    <li><a href="empresa.php"><i class="fas fa-city"></i></i>Empresa</a></li>
                    <li><a href="menu.php?pagina=1"><i class="fas fa-stream"></i></i>Projetos</a></li>
                    <li><a href=""><i class="fas fa-users"></i>Funcionários</a></li>
                    <li><a href=""><i class="fas fa-battery-three-quarters"></i>Equipamentos</a></li>
                    <li><a href="requisitos.php"><i class="fas fa-edit"></i>Requisitos</a></li>
                    <li><a href=""><i class="fas fa-cogs"></i>Controle</a></li>
                    <li><a href=""><i class="fas fa-chart-pie"></i>Resultados</a></li>
                </ul>

            </div>

            <div class="conteudo">

                <h1>Meus Projetos</h1>

                <form class="projetos" action="../back/projetos.php" method="get">

                    <?php

                        $query = "SELECT id_projeto, descricao, responsavel FROM projeto WHERE empresa = '{$_SESSION['id_empresa']}' AND ativo = 's'";
                        $result = mysqli_query($conecta, $query);
                        $row = mysqli_num_rows($result);

                        if($row != 0)
                        {

                            if($row>10)
                            {

                                $numpag=($row%10)+1;
                                $pagina=$_GET['pagina'];

                                if( (($pagina-1)*10)+1 > $row )
                                {
                                    echo '<script language="javascript">';
                                    echo "alert('Página não encontrada.')";
                                    echo '</script>';
                                    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../front/menu.php?pagina=1'>";
                                }

                                $bot=(($pagina-1)*10)+1;
                                $top=$pagina*10;
                                
                                if($top>$row){

                                    echo "<div class=\"botoes\">
                                        <div style=\"margin-top:15px; margin-left:220px;  margin-right:20px;\"><b>Exibindo resultados ".$bot." até ".$row.".</b></div>
                                    "; 
                                    
                                        if($pagina!=1)
                                        {
                                            echo "<a href=\"menu.php?pagina=".($pagina-1)."\" class=\"next\">".($pagina-1)." <i style=\"color: #2096f7\"class=\"fas fa-chevron-left\"></i></a>";
                                        }
                                        echo "<p class=\"atual\">...</p>";
                                        if($pagina!=$numpag)
                                        {
                                            echo "<a href=\"menu.php?pagina=".($pagina+1)."\" class=\"next\"><i style=\"margin-right:0px; color: #2096f7\" class=\"fas fa-chevron-right\"></i>&nbsp;".($pagina+1)."</a>";
                                        }
                                    
                                    echo "</div>";

                                }

                                else{

                                    echo "<div class=\"botoes\">
                                        <div style=\"margin-top:15px; margin-left:220px;  margin-right:20px;\"><b>Exibindo resultados ".$bot." até ".$top.".</b></div>
                                    "; 
                                    
                                        if($pagina!=1)
                                        {
                                            echo "<a href=\"menu.php?pagina=".($pagina-1)."\" class=\"next\">".($pagina-1)." <i style=\"color: #2096f7\"class=\"fas fa-chevron-left\"></i></a>";
                                        }
                                        echo "<p class=\"atual\">...</p>";
                                        if($pagina!=$numpag)
                                        {
                                            echo "<a href=\"menu.php?pagina=".($pagina+1)."\" class=\"next\"><i style=\"margin-right:0px; color: #2096f7\" class=\"fas fa-chevron-right\"></i>&nbsp;".($pagina+1)."</a>";
                                        }
                                    
                                    echo "</div>";
                                }
                                
                                
                                echo "<div class=\"legenda\">
                                    <div class=\"leg-box\"><input type=\"checkbox\" disabled></div>
                                    <div class=\"leg-id\"><b>ID</b></div>
                                    <div class=\"leg-desc\"><b>DESCRIÇÃO</b></div>
                                    <div class=\"leg-res\"><b>RESPONSÁVEL</b></div>
                                </div>";
                                
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
                                        <div class=\"item-box\"> <input id=".$id." value=".$id." name=\"selecionado\" type=\"checkbox\"> </div>
                                        <div class=\"item-id\">".$id."</div>
                                        <div class=\"item-desc\">".$descricao."</div>
                                        <div class=\"item-res\">".$responsavel."</div>
                                        </div>";

                                    }                                        
                            
                                }

                            }

                            else{

                                echo "
                                
                                    <div class=\"legenda\">
                                        <div class=\"leg-box\"><input type=\"checkbox\" disabled></div>
                                        <div class=\"leg-id\"><b>ID</b></div>
                                        <div class=\"leg-desc\"><b>DESCRIÇÃO</b></div>
                                        <div class=\"leg-res\"><b>RESPONSÁVEL</b></div>
                                    </div>
                                
                                ";

                                for($i=0; $i<$row ; $i++ ){

                                    $linha = mysqli_fetch_array($result);

                                    $id = $linha['id_projeto'];
                                    $descricao = $linha['descricao'];
                                    $responsavel = $linha['responsavel'];

                                    echo "
                                    
                                    <div class=\"item\">
                                        <div class=\"item-box\"> <input id=".$id." value=".$id." name=\"selecionado\" type=\"checkbox\"> </div>
                                        <div class=\"item-id\">".$id."</div>
                                        <div class=\"item-desc\">".$descricao."</div>
                                        <div class=\"item-res\">".$responsavel."</div>
                                    </div>
                                    
                                    ";

                                }
                            }
                        }

                        else{

                            echo "

                            <div class=\"legenda\">
                                <div class=\"leg-box\"><input type=\"checkbox\" disabled></div>
                                <div class=\"leg-id\"><b>ID</b></div>
                                <div class=\"leg-desc\"><b>DESCRIÇÃO</b></div>
                                <div class=\"leg-res\"><b>RESPONSÁVEL</b></div>
                            </div>

                            <div class=\"item\">
                            <div class=\"item-box\"> <input id=\"\" value=\"\" name=\"selecionado\" disabled type=\"checkbox\"> </div>
                            <div class=\"item-id\">---</div>
                            <div class=\"item-desc\">Sua empresa não possuí projetos cadastrados</div>
                            <div class=\"item-res\">---</div>
                            </div>";
                        }

                    ?>

                    <div class="botoes">

                        <button type="submit" value="novo" class="novo" style="cursor: pointer;">Novo Projeto</button>
                        <button type="submit" value="conclui" class="conclui" style="cursor: pointer;">Arquivar Selecionados</button>
                        <button type="submit" value="arquivar" class="arq" style="cursor: pointer;">Excluir Selecionados</button>

                    </div>

                </form>
            
            </div>

        </div>

    </body>

</html>