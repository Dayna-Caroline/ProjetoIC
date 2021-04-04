<?php

    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";
    $id=$_POST['ealtera'];
    $query = "SELECT * FROM equipamentos WHERE id_equipamento='$id'";
    $result = mysqli_query($conecta, $query);
    $row = mysqli_num_rows($result);
    if($row==1)
    {
        $linha=mysqli_fetch_array($result);
    }
    else
    {
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../front/equip/equipamentos.php'>";
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
                    <li class="navitem"><a href="../mudancas/controle.php"><i class="fas fa-cogs"></i><span class="nav-text">Controle</span></a></li>
                    <li class="navitem"><a href="../results/resultados.php"><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
                </ul>
            </div>

            <div class="conteudo">

                <div  class="titulo">
                    <h1>Alteração Equipamento</h1>
                </div>

                <!--  Campos(Descrição, Marca, fabricante, tipo, modelo, tensao,consumo,classe)  -->
                <form class="form_equipamentos" method="post" action="../../back/equip/alt_equipamento.php">
                    <?php

                        echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>ID</b></div>
                            <div class=\"item-id2\"><input disabled autocomplete=\"off\" type=\"text\" value=".$id."name=\"id\"></div>
                        </div>";

                        echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>Descrição do equipamento</b></div>
                            <div class=\"item-id2\"><input required autocomplete=\"off\" type=\"text\" name=\"descricao\" value=".$linha['descricao']."></div>
                        </div>";

                        echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>Marca</b></div>
                            <div class=\"item-id2\"><input required type=\"text\" name=\"marca\" value=".$linha['marca']."></div>
                        </div>";

                        echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>Fabricante</b></div>
                            <div class=\"item-id2\"><input required autocomplete=\"off\" type=\"text\" name=\"fabricante\" value=".$linha['fabricante']."></div>
                        </div>";

                        echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>Tipo</b></div>
                            <div class=\"item-id2\"><input required autocomplete=\"off\" type=\"text\" name=\"tipo\" value=".$linha['tipo']."></div>
                        </div>";

                        echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>Modelo</b></div>
                            <div class=\"item-id2\"><input required autocomplete=\"off\" type=\"text\" name=\"modelo\" value=".$linha['modelo']."></div>
                        </div>";
                        
                        echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>Tensão(Volts)</b></div>
                            <div class=\"item-id2\"><input required type=\"number\" oninput=\"this.value = Math.abs(this.value)\" min=\"0\" name=\"tensao\"value=".$linha['tensao']."></div>
                        </div>";

                        echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>Consumo(kWh)</b></div>
                            <div class=\"item-id2\"><input required type=\"number\" oninput=\"this.value = Math.abs(this.value)\" min=\"0\" name=\"consumo\"value=".$linha['consumo']."></div>
                        </div>";

                        echo "<div class=\"item2\">
                        <div class=\"leg-id2\"><b>Classe</b></div>
                        <div class=\"item-id2\">
                        <select required type=\"text\" name=\"classe\"value=".$linha['classe'].">
                            <option value=\"A\">A</option>
                            <option value=\"B\">B</option>
                            <option value=\"C\">C</option>
                            <option value=\"D\">D</option>
                            <option value=\"E\">E</option>
                        </select>
                        </div>
                        </div>"
                    ?>
                    <br><div class="botoes">
                        <button type="submit" value="cadastrar" name="cadastrar" class="novo" style="cursor: pointer;margin-left:300px;">Concluír Cadastro</button>
                    </div>
                </form>
            
            </div>

        </div>

        <script src="../../js/funcs_equipamentos.js"></script>

    </body>

</html>