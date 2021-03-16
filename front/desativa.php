<?php
    include "../back/autenticacao.php";
    include "../back/conexao_local.php";
    if(isset($_GET['success']))
    {
        if($_GET['success'] == 1)
        {
            echo '<script language="javascript">';
            echo "alert('Erro ao acessar o banco de dados.')";
            echo '</script>';
        }else if($_GET['success'] == 2){
            echo '<script language="javascript">';
            echo "alert('Senha incorreta, tente novamente.')";
            echo '</script>';
        }else if($_GET['success'] == 3){
            echo '<script language="javascript">';
            echo "alert('Erro na desativação, tente novamente.')";
            echo '</script>';
        }
    }

    $query = "SELECT * FROM empresa WHERE cnpj = '{$_SESSION['cnpj']}' AND ativo = 's'";
    $result = mysqli_query($conecta, $query);
    $row = mysqli_num_rows($result);

    if($row == 1){
        $linha = mysqli_fetch_array($result);
        $empresa = $linha['razao'];
    }else{
        echo '<script language="javascript">';
        echo "alert('Erro ao acessar o banco de dados.')";
        echo '</script>';
    }
?>

<!DOCTYPE html>

<html lang="pt-br">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <link rel="stylesheet" href="../styles/altera_empresa.css">
        <title>Smart grid</title>

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
                    <li><a href="funcionarios.php?pagina=1"><i class="fas fa-users"></i>Funcionários</a></li>
                    <li><a href=""><i class="fas fa-battery-three-quarters"></i>Equipamentos</a></li>
                    <li><a href="requisitos.php"><i class="fas fa-edit"></i>Requisitos</a></li>
                    <li><a href=""><i class="fas fa-cogs"></i>Controle</a></li>
                    <li><a href=""><i class="fas fa-chart-pie"></i>Resultados</a></li>
                </ul>

            </div>

            <a href="empresa.php"><p class="volt">&#8592;  Voltar</p></a>

            <div class="cont">

                <h1>Desativar meu cadastro - <?php echo $empresa;?></h1>
                <p style="color: red;"><b>Deseja desativar o cadastro da sua empresa no nosso sistema?</b></p><br>
                <p><b>Esta não é uma exclusão permanente e pode ser revertida posteriormente.</b></p><br><br>


                <form class="cadastro" action="../back/desativa_empresa.php" method="post">
                    <input type="password" name="senha" placeholder="Confirme sua senha"> <br>    
                    <button type="submit" class="confirm">Desativar empresa</button><br>
                </form>

            </div>

        </div>

        <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
        <script src="../js/jquery-1.2.6.pack.js" type="text/javascript"></script>
        <script src="../js/jquery.maskedinput-1.1.4.pack.js" type="text/javascript"></script>
        <script src="../js/funcs_cad_empresa.js"></script>

    </body>

</html>