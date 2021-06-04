<?php

    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";
    $id=$_POST['equipamento'];
    $query = "SELECT * FROM equipamentos WHERE id_equipamento='$id'";
    $result = mysqli_query($conecta, $query);
    $row = mysqli_num_rows($result);
    if($row==1)
    {
        $linha=mysqli_fetch_array($result);
    }
    else
    {
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../front/equip/equipamentos.php?pagina=1'>";
    }
?>

<!DOCTYPE html>

<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <link rel="stylesheet" href="../../styles/equip/cad_equipamento.css">
        <link rel="stylesheet" href="../../styles/projetos/menu.css">
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
                    <li class="navitem"><a href="../controle/controle.php"><i class="fas fa-cogs"></i><span class="nav-text">Controle</span></a></li>
                    <li class="navitem"><a href="../results/resultados.php"><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
                </ul>
            </div>

            <div class="conteudo">

                <div  class="titulo">
                    <a href="escolha_equip.php"><p class="volt alt">&#8592;  Voltar</p></a>
                    <h1>Alterar Equipamento</h1>
                </div>

                <!--  Campos(Descrição, Marca, fabricante, tipo, modelo, tensao,consumo,classe)  -->
                <form class="form_equipamentos" method="post" action="../../back/equip/alt_equipamento.php?id_equip=<?php echo $id?>">
                    <div class="item2">
                        <div class="item-id2"><input autocomplete="off" value="<?php echo $linha['descricao'];?>" type='text' name='descricao'></div>
                    </div>

                    <div class="item3">
                        <div class="leg-id2"><b>Classe</b></div>
                        <div class="item-id2">
                            <select required type="text" name="classe">
                                <option value="A" <?php if($linha['classe'] == "A") echo "selected";?>>A</option>
                                <option value="B" <?php if($linha['classe'] == "B") echo "selected";?>>B</option>
                                <option value="C" <?php if($linha['classe'] == "C") echo "selected";?>>C</option>
                                <option value="D" <?php if($linha['classe'] == "D") echo "selected";?>>D</option>
                                <option value="E" <?php if($linha['classe'] == "E") echo "selected";?>>E</option>
                            </select>
                        </div>
                    </div>
                    <?php
                        echo "<div class=\"item3\">
                            <div class=\"item-id2\"><input required  autocomplete=\"off\" type=\"text\" value=".$linha['marca']." class=\"i2\" name=\"marca\"></div>
                            <div class=\"item-id2\"><input required autocomplete=\"off\" type=\"text\" value=".$linha['fabricante']." name=\"fabricante\"></div>
                        </div>";

                        echo "<div class=\"item3\">
                            <div class=\"item-id2\"><input required autocomplete=\"off\" class=\"i2\" value=".$linha['tipo']." type=\"text\" name=\"tipo\"></div>
                            <div class=\"item-id2\"><input required autocomplete=\"off\" value=".$linha['modelo']." type=\"text\" name=\"modelo\"></div>
                        </div>";
                        
                        echo "<div class=\"item3\">
                            <div class=\"item-id2\"><input required type=\"number\" class=\"i2\" value=".$linha['tensao']." oninput=\"this.value = Math.abs(this.value)\" min=\"0\" id=\"tensao\" name=\"tensao\"></div>
                            <div class=\"item-id2\"><input required type=\"number\" value=".$linha['consumo']." oninput=\"this.value = Math.abs(this.value)\" min=\"0\" name=\"consumo\" step=\"0.01\"></div>
                        </div>";
                    ?>
                    <br><div class="botoes">
                        <button type="submit" style="margin-left: -0px;" value="cadastrar" name="cadastrar" class="novo" style="cursor: pointer;margin-left:300px;">Alterar</button>
                    </div>
                </form>
            
            </div>

        </div>

        <script src="../../js/funcs_equipamentos.js"></script>

    </body>

</html>