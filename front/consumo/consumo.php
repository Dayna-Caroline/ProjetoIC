<?php
    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";
   

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="../../styles/consumo/consumo.css">
    <title>Smart Grid</title>
</head>
<body onclick="verifica()" onload="verifica()">
    <div class="tudo">
        <div class="aba">
            <div class="logo">
                <a href="../../index.php"><img src="../../imgs/logo.png" alt="Logo da empresa" class="img-logo"></a>
                <h2>Smart Grids</h2>
            </div>
            <ul>
                <li class="navitem"><a href="../empresa/empresa.php"><i class="fas fa-city"></i><span class="nav-text">Empresa</span></a></li>
                <li class="navitem"><a href="../projetos/menu.php?pagina=1"><i class="fas fa-stream"></i><span class="nav-text">Projetos</span></a></li>
                <li class="navitem"><a href="../funcs/funcionarios.php?pagina=1"><i class="fas fa-users"></i><span class="nav-text">Funcionários</span></a></li>
                <li class="pag navitem"><a href="../equip/equipamentos.php"><i class="fas fa-battery-three-quarters"></i><span class="nav-text">Equipamentos</span></a></li>
                <li class="navitem"><a href="../consumo/consumo.php"><i class="fas fa-cogs"></i><span class="nav-text">Controle</span></a></li>
                <li class="navitem"><a href="../results/resultados.php"><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
            </ul>
        </div>
        <div class="conteudo">
            <h1>Controle Consumo</h1>
               <!-- ------------------------------- BUSCA ----------------------------- -->
                <form class="busca" action="consumo.php?pagina=1" method="POST">
                    <div class="filtros">
                    <b>Equipamento</b>
                    <select name='equipamento'>
                    <option value='todos'>Todos</option>; -->
                    <?php
                    for($i=0;$i<$row;$i++){
                        $linha = mysqli_fetch_array($result);
                        echo "<option value=".$linha['id_equipamento'].">".$linha['descricao']."</option>";
                    }                                
                    echo"</select>";
                    ?>
                    <b>Mês</b>
                        <select name='mes'>
                        <option name='mes' value=''>Mês</option>
                        <option name='mes' value='01'>Janeiro</option>
                        <option name='mes' value='02'>Fevereiro</option>
                        <option name='mes' value='03'>Março</option>
                        <option name='mes' value='04'>Abril</option>
                        <option name='mes' value='05'>Maio</option>
                        <option name='mes' value='06'>Junho</option>
                        <option name='mes' value='07'>Julho</option>
                        <option name='mes' value='08'>Agosto</option>
                        <option name='mes' value='09'>Setembro</option>
                        <option name='mes' value='10'>Outubro</option>
                        <option name='mes' value='11'>Novembro</option>
                        <option name='mes' value='12'>Dezembro</option></select>;
                    <b>Ano</b>
                        <input type="text" class="ano" value="" name="ano" id="ano" autocomplete="off">
                        <button type="submit">Aplicar Filtros</a>  
                   </div>  
                </form>
                <!-- ------------------------------ TABELA ----------------------------- -->
                <form action="../../back/consumo/consumo.php" method="POST">
                <?php 
                    if(@$_POST['mes'])
                    {
                        $mes = $_POST['mes'];
                        if($mes!=NULL)
                            $query = "SELECT id_consumo, descricao, consumo, dia FROM consumo WHERE empresa = '{$_SESSION['id_empresa']}' AND Month(dia)='$mes' ORDER BY consumo DESC ;";
                    
                    }
                    if(@$_POST['equipamento'])
                    {
                        $equip = $_POST['equipamento'];
                        if($mes!='todos')
                            $query = "SELECT id_consumo, descricao, consumo, dia FROM consumo WHERE empresa = '{$_SESSION['id_empresa']}' AND id_equipamento='$equipamento' ORDER BY consumo DESC;";
                        else
                            $query = "SELECT id_consumo, descricao, consumo, dia FROM consumo WHERE empresa = '{$_SESSION['id_empresa']}' ORDER BY consumo DESC;";
                    }
                    else if(@$_POST['ano'])
                    {
                        $ano = $_POST['ano'];
                        if($mes!=NULL)
                            $query = "SELECT id_consumo, descricao, consumo, dia FROM consumo WHERE empresa = '{$_SESSION['id_empresa']}' AND Month(dia)='$mes' ORDER BY consumo DESC ;";

                    }
                    //Sem Filtros 
                    else
                    {
                        $query = "SELECT id_consumo, descricao,consumo dia FROM consumo WHERE empresa = '{$_SESSION['id_empresa']}' ORDER BY consumo DESC ;";
                    }
                        
                    
                    

                    $result = mysqli_query($conecta,$query);
                    $row = mysqli_num_rows($result);
                    
                    if($row != 0)
                    {
                        // Caso não haja filtro ou existam mais de 11 projetos cadastrados, exibe resultados em páginas

                        if( $row>10)
                        {

                            $numpag=ceil($row/10);
                            $pagina=$_GET['pagina'];

                            if( (($pagina-1)*10)+1 > $row )//URL com pagina existente
                            {
                                echo '<script language="javascript">';
                                echo "alert('Página não encontrada.')";
                                echo '</script>';
                                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../front/consumo/consumo.php?pagina=1'>";
                            }

                            $bot=(($pagina-1)*10)+1;
                            $top=$pagina*10;

                            // verifica a pagina atual
                            
                            if($top>$row){
                                echo "<div class=\"botoes\">";
                                    
                                    echo "<div class=\"exibir-resultados\"><b>Exibindo Consumos ".$bot." até ".$row."</b></div>"; 
                                    echo "<a style=\""; if($pagina==1) {echo"visibility: hidden;";} echo "\" href=\"consumo.php?pagina=".($pagina-1)."\" class=\"next\">".($pagina-1)." <i style=\"color: #2096f7;\" class=\"fas fa-chevron-left\"></i></a>";
                                    echo "<p class=\"atual\">...</p>";
                                    echo "<a style=\""; if($pagina==$numpag) {echo"visibility: hidden;";} echo "\" href=\"consumo.php?pagina=".($pagina+1)."\" class=\"next\"><i style=\"margin-right:0px; color: #2096f7\" class=\"fas fa-chevron-right\"></i>&nbsp;".($pagina+1)."</a>";
                                echo "</div>";
                            }

                            else{
                                echo "<div class=\"botoes\">";
                                
                                    echo "class=\"exibir-resultados\"><b>Exibindo consumos ".$bot." até ".$top."</b></div>";    
                                    echo "<a style=\""; if($pagina==1) {echo"visibility: hidden;";} echo "\" href=\"consumo.php?pagina=".($pagina-1)."\" class=\"next\">".($pagina-1)." <i style=\"color: #2096f7;\" class=\"fas fa-chevron-left\"></i></a>";
                                    echo "<p class=\"atual\">...</p>";
                                    echo "<a style=\""; if($pagina==$numpag) {echo"visibility: hidden;";} echo "\" href=\"consumo.php?pagina=".($pagina+1)."\" class=\"next\"><i style=\"margin-right:0px; color: #2096f7\" class=\"fas fa-chevron-right\"></i>&nbsp;".($pagina+1)."</a>";                      
                                echo "</div>";
                            }
                            
                            echo "
                            <div class=\"legenda\">
                                <div class=\"leg-box\"><input type=\"checkbox\" id=\"marcatodos\" onclick=\"marca(this)\"></div>
                                <div class=\"leg-id\"><b>ID</b></div>
                                <div class=\"leg-desc\"><b>EQUIPAMENTO</b></div>
                                <div class=\"leg-consumo\"><b>CONSUMO(kWh)</b></div>
                            </div>";

                            // Exibe os resultados

                            for($i=1; $i<=$row ; $i++ )
                            {

                                $linha = mysqli_fetch_array($result);
                                $id = $linha['id_equipamento'];
                                $descricao = $linha['descricao'];
                                $consumo = $linha['consumo'];

                            
                                if($i>=$bot&&$i<=$top)
                                {
                                    echo "
                                    
                                    <div class=\"item\">
                                    <div class=\"item-box\"> <input id=".$id." value=".$id." name=\"check_list[]\" type=\"checkbox\"> </div>
                                    <div class=\"item-id\">".$id."</div>
                                    <div class=\"item-desc\">".$descricao."</div>
                                    <div class=\"item-consumo\">".$consumo."</div>
                                    </div>";
                                }                                        
                        
                            }

                        }

                        // Exibe resultados em lista

                        else{


                            echo "
                            <div class=\"legenda\">
                                <div class=\"leg-box\"><input type=\"checkbox\" id=\"marcatodos\" onclick=\"marca(this)\"> </div>
                                <div class=\"leg-id\"><b>ID</b></div>
                                <div class=\"leg-desc\"><b>EQUIPAMENTO</b></div>
                                <div class=\"leg-consumo\"><b>CONSUMO(kWh)</b></div>
                            </div>";

                            for($i=0; $i<$row ; $i++ ){

                                $linha = mysqli_fetch_array($result);
                                $id = $linha['id_consumo'];
                                $dia = $linha['dia'];
                                $consumo = $linha['consumo'];

                                echo "
                                    <div class=\"item\">
                                    <div class=\"item-box\"> <input id=".$id." value=".$id." name=\"check_list[]\" type=\"checkbox\"> </div>
                                    <div class=\"item-id\">".$id."</div>
                                    <div class=\"item-desc\">".$dia."</div>
                                    <div class=\"item-consumo\">".$consumo."</div>
                                    </div>";
                            }
                        }

                    }

                    // Não encontrou nenhum projeto

                    else{
                        echo "
                        <div class=\"titulo\">
                            <b></b>
                        </div>
                        <div class=\"legenda\">
                            <div class=\"leg-box\"><input type=\"checkbox\" disabled></div>
                            <div class=\"leg-id\"><b>ID</b></div>
                            <div class=\"leg-desc\"><b>EQUIPAMENTO</b></div>
                            <div class=\"leg-consumo\"><b>CONSUMO(kWh)</b></div>
                        </div>
                        <div class=\"item\">
                        <div class=\"item-box\"> <input id=\"\" value=\"\" name=\"selecionado\" disabled type=\"checkbox\"> </div>
                        <div class=\"item-id\">---</div>
                        <div class=\"item-desc\">Nenhum Consumo Cadastrado</div>
                        <div class=\"item-consumo\">--</div>
                        </div>";
                    }
                ?>
                
                    <div class="botoes">
                    <a href="cad_consumo.php"><button value="cnovo" name="cnovo" class="novo consumo" style="cursor: pointer;">Novo Consumo</button></a>
                    <button type="submit" value="<?php echo $id; ?>" name="cdelete" style="cursor: pointer;" class="arq">Excluir Consumo</button>
                    </div>
                </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script src="../../js/jquery-1.2.6.pack.js" type="text/javascript"></script>
    <script src="../../js/funcs_equipamentos.js"></script>
</body>
</html>