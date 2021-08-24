<?php
    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";
    $queryequip = "SELECT * FROM equipamentos WHERE empresa = '{$_SESSION['id_empresa']}'";
    $resultequip = mysqli_query($conecta, $queryequip);
    $rowequip = mysqli_num_rows($resultequip);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="../../styles/projetos/menu.css">
    <link rel="stylesheet" href="../../styles/consumo/consumo.css">
    <title>Smart Grid</title>
</head>
<body onclick="verifica()" onload="verifica()">
    <div class="tudo">
        <div id="aba" class="aba">
            <div class="logo">
                <a href="../../index.php"><img src="../../imgs/logo.png" alt="Logo da empresa" class="img-logo"></a>
                <h2>Smart Grids</h2>
            </div>
            <ul>
                <li class="navitem"><a href="../empresa/empresa.php"><i class="fas fa-city"></i><span class="nav-text">Empresa</span></a></li>
                <li class="navitem"><a href="../projetos/menu.php?pagina=1"><i class="fas fa-stream"></i><span class="nav-text">Projetos</span></a></li>
                <li class="navitem"><a href="../funcs/funcionarios.php?pagina=1"><i class="fas fa-users"></i><span class="nav-text">Funcionários</span></a></li>
                <li class="navitem"><a href="../equip/equipamentos.php"><i class="fas fa-battery-three-quarters"></i><span class="nav-text">Equipamentos</span></a></li>
                <li class="pag navitem"><a href="../controle/consumo.php"><i class="fas fa-cogs"></i><span class="nav-text">Consumo</span></a></li>
                <li class="navitem"><a href="../results/resultados.php"><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
            </ul>
        </div>
        <div id="conteudo" class="conteudo">
            <h1>Controle de Consumo</h1>
             <!-- MENSAGEM -->
             <?php
                
                if(@$_GET['a']==1)
                {
                    echo "<div class=\"mensagem\">
                        <p>Para cadastrar um consumo é necessário cadastrar ao menos um equipamento!</p>
                    </div>";
                }
            
            ?>
               <!-- ------------------------------- BUSCA ----------------------------- -->
                <form action="consumo.php?pagina=1" method="POST">
                    <div class="busca">
                        <b>Equipamento</b>
                        <select name='equipamento'>
                            <option value='todos'>Todos</option>;
                        <?php
                        for($i=0;$i<$rowequip;$i++){
                            $linhaequip = mysqli_fetch_array($resultequip);
                            echo "<option value=".$linhaequip['id_equipamento'].">".$linhaequip['descricao']."</option>";
                        }                                
                        ?>
                        </select>
                        <b>Mês</b>
                            <select name='mes'>
                            <option value=''>Mês</option>
                            <option value='01'>Janeiro</option>
                            <option value='02'>Fevereiro</option>
                            <option value='03'>Março</option>
                            <option value='04'>Abril</option>
                            <option value='05'>Maio</option>
                            <option value='06'>Junho</option>
                
                            <option value='07'>Julho</option>
                            <option value='08'>Agosto</option>
                            <option value='09'>Setembro</option>
                            <option value='10'>Outubro</option>
                            <option value='11'>Novembro</option>
                            <option value='12'>Dezembro</option></select>
                        <b>Ano</b>
                            <input type="text" class="ano" value="" name="ano" id="ano" autocomplete="off">
                            <button class="aplicar" type="submit">Aplicar Filtros</a>  
                   </div>  
                </form>
                <!-- ------------------------------ TABELA ----------------------------- -->
                <form class="equipamentos" action="../../back/consumo/consumo.php" method="POST">
                <?php 
                    
                    
                    
                    //Filtro de Equipamento
                    $query = "SELECT consumo.id_consumo, consumo.consumo, consumo.dia, consumo.equipamento,equipamentos.id_equipamento,equipamentos.descricao FROM consumo INNER JOIN equipamentos ON consumo.empresa = '{$_SESSION['id_empresa']}'  AND consumo.equipamento = equipamentos.id_equipamento ";
                    if(@$_POST['equipamento'])
                    {
                        $equip = $_POST['equipamento'];
                         
                        if($equip!='todos')
                            $query .= "AND consumo.equipamento = '$equip' ";
                        
                        
                         //JOIN equipamentos ON consumo.equipamento=equipamentos.id_equipamento AND consumo.empresa = '{$_SESSION['id_empresa']}' ORDER BY dia, consumo DESC;";      
                        
                    }
                    //Filtro de mês
                    if(@$_POST['mes'])
                    {
                        $mes = $_POST['mes'];
                        if($mes!=NULL)
                            $query .= "AND Month(consumo.dia)='$mes'";
                       
                    }
                    //Filtro de Ano
                    if(@$_POST['ano'])
                    {
                        $ano = $_POST['ano'];
                        if($ano!=NULL)
                            $query .= "AND Year(consumo.dia)='$ano'";
                    }
                    //Sem Filtros 
                    $query .="ORDER BY consumo.dia, consumo.consumo DESC";
                    
                    if($query==NULL)
                        $query = "SELECT consumo.id_consumo, consumo.consumo, consumo.dia, consumo.equipamento,equipamentos.id_equipamento,equipamentos.descricao FROM consumo INNER JOIN equipamentos ON consumo.equipamento=equipamentos.id_equipamento AND consumo.empresa = '{$_SESSION['id_empresa']}' ORDER BY dia, consumo DESC;";
                    
                    

                    $result = mysqli_query($conecta,$query);
                    $row = mysqli_num_rows($result);
                    
                    if($row != 0)
                    {
                        // Caso não haja filtro ou existam mais de 11 equipamentos cadastrados, exibe resultados em páginas

                        if( $row>8)
                        {

                            $numpag=ceil($row/8);
                            @$pagina=$_GET['pagina'];
                            if(!$pagina)
                                $pagina=1;

                            if( (($pagina-1)*8)+1 > $row )//URL com pagina existente
                            {
                                echo '<script language="javascript">';
                                echo "alert('Página não encontrada.')";
                                echo '</script>';
                                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../front/controle/consumo.php?pagina=1'>";
                            }

                            $bot=(($pagina-1)*8)+1;
                            $top=$pagina*8;

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
                                    echo "<div class=\"exibir-resultados\"><b>Exibindo consumos ".$bot." até ".$top."</b></div>";    
                                    echo "<a style=\""; if($pagina==1) {echo"visibility: hidden;";} echo "\" href=\"consumo.php?pagina=".($pagina-1)."\" class=\"next\">".($pagina-1)." <i style=\"color: #2096f7;\" class=\"fas fa-chevron-left\"></i></a>";
                                    echo "<p class=\"atual\">...</p>";
                                    echo "<a style=\""; if($pagina==$numpag) {echo"visibility: hidden;";} echo "\" href=\"consumo.php?pagina=".($pagina+1)."\" class=\"next\"><i style=\"margin-right:0px; color: #2096f7\" class=\"fas fa-chevron-right\"></i>&nbsp;".($pagina+1)."</a>";                      
                                echo "</div>";
                            }
                            
                            echo "
                            <div class=\"legenda\">
                                <div class=\"leg-box\"><input type=\"checkbox\" id=\"marcatodos\" onclick=\"marca(this)\"></div>
                                <div class=\"leg-id\"><b>DIA</b></div>
                                <div class=\"leg-desc\"><b>EQUIPAMENTO</b></div>
                                <div class=\"leg-consumo\"><b>CONSUMO(kWh)</b></div>
                            </div>";

                            // Exibe os resultados

                            for($i=1; $i<=$row ; $i++ )
                            {

                                $linha = mysqli_fetch_array($result);
                                $id = $linha['id_consumo'];
                                $dia = date("d/m/Y",strtotime($linha['dia']));
                                $descricao = $linha['descricao'];
                                $consumo = $linha['consumo'];

                            
                                if($i>=$bot&&$i<=$top)
                                {
                                    echo "
                                    
                                    <div class=\"item\">
                                    <div class=\"item-box\"> <input id=".$id." value=".$id." name=\"check_list[]\" type=\"checkbox\"> </div>
                                    <div class=\"item-id\">".$dia."</div>
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
                                <div class=\"leg-id\"><b>DIA</b></div>
                                <div class=\"leg-desc\"><b>EQUIPAMENTO</b></div>
                                <div class=\"leg-consumo\"><b>CONSUMO(kWh)</b></div>
                            </div>";

                            for($i=0; $i<$row ; $i++ ){

                                $linha = mysqli_fetch_array($result);
                                $id = $linha['id_consumo'];
                                $dia = date("d/m/Y",strtotime($linha['dia']));
                                $descricao = $linha['descricao'];
                                $consumo = $linha['consumo'];


                                echo "
                                    <div class=\"item\">
                                    <div class=\"item-box\"> <input id=".$id." value=".$id." name=\"check_list[]\" type=\"checkbox\"> </div>
                                    <div class=\"item-id\">".$dia."</div>
                                    <div class=\"item-desc\">".$descricao."</div>
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
                            <div class=\"leg-id\"><b>DIA</b></div>
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
                    <button value="cnovo" name="cnovo" class="novo" style="cursor: pointer;"><a href="cad_consumo.php">Novo Consumo</a></button>
                    <button type="submit" value="<?php echo @$id; ?>" name="cdelete" id="arquiva" style="cursor: pointer;" class="arq">Excluir Consumo</button>
                    </div>
                </form>
                
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script src="../../js/jquery-1.2.6.pack.js" type="text/javascript"></script>
    <script src="../../js/funcs_consumo.js"></script>
</body>
</html>