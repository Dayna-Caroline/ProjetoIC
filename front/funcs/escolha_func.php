<?php
    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";
    
    $query = "SELECT * FROM profissional WHERE empresa = '{$_SESSION['id_empresa']}' AND ativo='s'";
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
        <link rel="stylesheet" href="../../styles/funcs/cad_funcs.css">
        <link rel="stylesheet" href="../../styles/projetos/menu.css">
        <title>Smart Grid</title>
    </head>

    <body>
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
                    <li class="navitem"><a href="../controle/controle.php"><i class="fas fa-cogs"></i><span class="nav-text">Controle</span></a></li>
                    <li class="navitem"><a href="../results/resultados.php"><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
                </ul>
            </div> 

            <div class="conteudo">
                <a href="funcionarios.php?pagina=1"><p class="volt alt">&#8592;  Voltar</p></a>

                <br><br><br><br>
                <h1 style="margin-top: 50px;">Escolha o funcionário</h1>

                <form action="alt_funcs.php" class="item-id2" method="POST">
                    <select name="profissional" style="cursor: pointer" required id="profissional">  
                        <?php
                            for($i=0;$i<$row;$i++){
                                $linha = mysqli_fetch_array($result);
                                echo "<option name='select' value=".$linha['id_profissional'].">".$linha['nome']."</option>";
                            }
                        ?>
                    </select>
                    <button type="submit" class="btnAlt">Alterar</button>
                </form>

            </div>

        </div>
    </body>

</html>