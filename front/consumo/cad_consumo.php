<?php
    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";
    
    $query = "SELECT * FROM equipamentos WHERE empresa = '{$_SESSION['id_empresa']}'";
    $result = mysqli_query($conecta, $query);
    $row = mysqli_num_rows($result);

?>
<!DOCTYPE html>

<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <link rel="stylesheet" href="../../styles/projetos/menu.css">
        <link rel="stylesheet" href="../../styles/equip/cad_equipamento.css">
        <title>Smart Grid</title>
    </head>

    <body>

        <div class="tudo">

            <!-- NAVBAR -->
            
            <div class="aba">
                <div class="logo">
                    <a href="../../front/projetos/menu.php"><img src="../../imgs/logo.png" alt="Logo da empresa" class="img-logo"></a>
                    <h2 class="nav-text">Smart Grids</h2>
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

                <div  class="titulo">
                    <a href="consumo.php?pagina=1"><p class="volt alt">&#8592;  Voltar</p></a>
                    <h1>Cadastrar Consumo</h1>
                </div>

                <!--  Campos(Descrição, Marca, fabricante, tipo, modelo, tensao,consumo,classe)  -->
                <form class="form_consumo" method="post" action="../../back/consumo/cad_consumo.php" onsubmit="return verifica2()">
                    <?php
                        echo"<div class=\"item3\">
                        <div class=\"leg-id2\"><b>Equipamento</b></div>
                        <div class=\"item-id2\">
                        <select name=\"equipamento\" style=\"width:360px;\" required> ";

                        for($i=0;$i<$row;$i++){
                            $linha = mysqli_fetch_array($result);
                            echo "<option value=".$linha['id_equipamento'].">".$linha['descricao']."</option>";
                        }                             
                        echo "
                        </select>
                        </div>
                        </div>";
                        
                        echo "
                        <div class=\"item3\">
                        <div class=\"leg-id2\"><b>Inicio</b></div>
                        <div class=\"item-id2\"><input type=\"time\" style=\"width:110px;\" name=\"horainicial\" required></div>
                        <div class=\"leg-id2\"><b>Fim</b></div>
                        <div class=\"item-id2\"><input type=\"time\" style=\"width:110px;\" name=\"horafinal\" required></div>
                        </div>";
                        
                        echo "<div class=\"item3\">
                            <div class=\"leg-id2 ab\"><b>Data</b></div>
                            <div class=\"item-id2 ab\"><input style=\"width:180px;\" required autocomplete='off' name=\"data\" type=\"date\"></div>
                        
                            <div class=\"item-id2\"><input required type=\"number\" style=\"margin-left:95px; width:180px;\"  placeholder=\"Consumo(kWh)\" oninput=\"this.value = Math.abs(this.value)\" min=\"0\" name=\"consumo\" step=\"0.01\"></div>
                        </div>";
                    ?>
                    <br><div class="botoes">
                        <button type="submit" style="margin-left: 350px;" value="cadastrar" name="cadastrar" class="novo" style="cursor: pointer;margin-left:300px;">Cadastrar</button>
                    </div>
                </form>
            
            </div>

        </div>
        <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
        <script src="../../js/jquery-1.2.6.pack.js" type="text/javascript"></script>
        <script src="../../js/funcs_consumo.js"></script>

    </body>

</html>