<?php
    if(isset($_GET['success']))
    {
        if($_GET['success'] == 'false')
        {
            echo '<script language="javascript">';
            echo "alert('CNPJ ou senha incorretos! Tente novamente...')";
            echo '</script>';
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
        <link rel="stylesheet" href="../styles/login.css">
        <title>Login</title>
    </head>

    <body>

        <div class="tudo">

            <div class="cabecalho">
                <div class="logo">
                    <a href="../index.php"><img src="../imgs/logo.png" alt="Logo da empresa" class="img-logo"></a>
                    <h2>Smart Grids</h2>
                </div>
                <div class="pags">
                    <ul>
                        <li><a href="./cad.php">Criar Conta &#8594;</a></li>
                    </ul>
                </div>
            </div>

            <h1>Insira seus dados</h1>
            <hr size=4>

            <form class="form" action="../back/login.php" method="POST">
                <div class="cnpj">
                    <input type="CNPJ" name="cnpj" id="cnpj" autocomplete="off" placeholder="CNPJ" value="" required>
                </div>

                <div class="senha">
                    <input type="password" name="senha" id="senha" placeholder="Senha" autocomplete="off" required>
                    <button type="button" onclick="mostrarSenha()" class="ver"><i class="fas fa-eye"></i></button>
                </div>
                <input type="submit" name="btnLogar" class="botao" value="Login">
            </form>

        </div>

        <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
        <script src="../js/jquery-1.2.6.pack.js" type="text/javascript"></script>
        <script src="../js/jquery.maskedinput-1.1.4.pack.js" type="text/javascript"></script>
        <script src="../js/funcs_login.js"></script>

    </body>

</html>