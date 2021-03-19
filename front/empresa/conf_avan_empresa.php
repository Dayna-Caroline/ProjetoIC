<?php
    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";
    if(isset($_GET['success']))
    {
        if($_GET['success'] == 1)
        {
            echo '<script language="javascript">';
            echo "alert('Erro no banco, tente novamente.')";
            echo '</script>';
        }else if($_GET['success'] == 2){
            echo '<script language="javascript">';
            echo "alert('Senha atual errada.')";
            echo '</script>';
        }else if($_GET['success'] == 3){
            echo '<script language="javascript">';
            echo "alert('Nova senha e confirma nova senha são diferentes.')";
            echo '</script>';
        }else if($_GET['success'] == 4){
            header("location: ../../front/empresa/altera_empresa.php?success=5");
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="../../styles/empresa/altera_empresa.css">
    <title>Smart grid</title>
</head>
<body>
<div class="tudo">
<div class="aba">
                <div class="logo">
                    <a href="../../front/projetos/menu.php"><img src="../../imgs/logo.png" alt="Logo da empresa" class="img-logo"></a>
                    <h2 class="nav-text">Smart Grids</h2>
                </div>
                <ul>
                    <li class="pag navitem"><a href="../empresa/empresa.php"><i class="fas fa-city"></i><span class="nav-text">Empresa</span></a></li>
                    <li class="navitem"><a href="../projetos/menu.php?pagina=1"><i class="fas fa-stream"></i><span class="nav-text">Projetos</span></a></li>
                    <li class="navitem"><a href="../funcs/funcionarios.php?pagina=1"><i class="fas fa-users"></i><span class="nav-text">Funcionários</span></a></li>
                    <li class="navitem"><a href="../equip/equipamentos.php"><i class="fas fa-battery-three-quarters"></i><span class="nav-text">Equipamentos</span></a></li>
                    <li class="navitem"><a href="../requisitos/requisitos.php"><i class="fas fa-edit"></i><span class="nav-text">Requisitos</span></a></li>
                    <li class="navitem"><a href="../controle/controle.php"><i class="fas fa-cogs"></i><span class="nav-text">Controle</span></a></li>
                    <li class="navitem"><a href="../results/resultados.php"><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
                </ul>
            </div>
            <div class="conteudo">
                <a href="altera_empresa.php"><p class="volt">&#8592;  Voltar</p></a>
                <form action="../../back/empresa/alt_senha_empresa.php" method="post" class="sen">
                    <h1>Alteração avançada</h1>
                    <div class="antiga">
                        <input type="password" name="antiga" class="input" placeholder="Senha atual" required>
                    </div>
                    <div class="nova">
                        <input type="password" name="nova" class="input" placeholder="Senha nova" required>
                    </div>
                    <div class="confirma">
                        <input type="password" name="confirma" class="input" placeholder="Confirme sua senha nova" required>
                    </div>

                    <br>
                    <input type="submit" value="Alterar senha" class="botao">
                </form>
            </div>
    </div>
</body>
</html>