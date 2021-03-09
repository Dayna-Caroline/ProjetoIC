<?php
    if(isset($_GET['success']))
    {
        if($_GET['success'] == 'false')
        {
            echo '<script language="javascript">';
            echo "alert(' Erro no cadastro! Tente novamente...')";
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
    <link rel="stylesheet" href="../styles/cad_empresa.css">
    <title>Smart grid</title>
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
                        <li><a href="./login.php">Fazer login &#8594;</a></li>
                    </ul>
                </div>
            </div>

        <h1>Cadastre sua empresa</h1>
        <hr size=5>
        
        <form class="cadastro"  action="../back/cad_empresa.php" method="post" onsubmit="return verifica_senha()">
            <div class="razao">
                <input type="text" name="razao" id="razao" placeholder="Razão social" required autocomplete="off" autocomplete="off">
            </div>
        
            <div class="fantasia">
                <input type="text" name="fantasia" id="fantasia" placeholder="Nome Fantasia" required autocomplete="off">
            </div>

            <div class="cep">
                <input type="text" name="cep" id="cep" placeholder="CEP" required autocomplete="off">
            </div>

            <div class="conj">
                <input type="text" class="uf" name="uf" id="uf" placeholder="UF" required autocomplete="off">
                <input type="text" class="cidade" name="cidade" id="cidade" placeholder="Cidade" required autocomplete="off">
                <input type="text" class="bairro" name="bairro" id="bairro" placeholder="Bairro" required autocomplete="off">
            </div>

            <div class="conj">
                <input type="text" class="endereco"  name="endereco" id="endereco" placeholder="Rua" required autocomplete="off">
                <input type="text" class="num"  name="num" id="num" placeholder="N°" required autocomplete="off">
            </div>
        
            <div class="conj">
                <input type="text" class="complemento"  name="complemento" id="complemento" placeholder="Complemento" autocomplete="off">
            </div>
            
            <div class="cnpj">
                <input type="text" name="cnpj" id="cnpj" placeholder="CNPJ" required autocomplete="off">
            </div>

            <div class="conj">
                <input type="text"   name="cnae" class="cnae" id="cnae" placeholder="CNAE" required autocomplete="off">
                <input type="text"  name="ie" class="ie" id="ie" placeholder="IE" required autocomplete="off">
            </div>
    
            <div class="senha">
                <input type="password" name="senha" id="senha" placeholder="Senha" required autocomplete="off">
                <button type="button" onclick="mostrarSenha()" class="ver"><i class="fas fa-eye"></i></button>
            </div>

            <div class="senha">
                <input type="password" name="senha2" id="senha2" placeholder="Confirme sua senha" required autocomplete="off">
                <button type="button" onclick="mostrarSenha2()" class="ver"><i class="fas fa-eye"></i></button>
            </div>
            
            <input type="submit" class="botao" value="Cadastrar">
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script src="../js/jquery-1.2.6.pack.js" type="text/javascript"></script>
    <script src="../js/jquery.maskedinput-1.1.4.pack.js" type="text/javascript"></script>
    <script src="../js/funcs_cad_empresa.js"></script>
</body>
</html>