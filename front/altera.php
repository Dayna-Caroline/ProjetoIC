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
                        <li><a href="./index.php">Voltar &#8594;</a></li>
                    </ul>
                </div>
            </div>

        <h1>Minha empresa </h1>
        <hr size=5>

        <?php
         include "../back/conexao_local.php";
            //session_start();
            //$id_empresa=$_SESSION['id'];
            $id_empresa=1;
           
        
         $sql="SELECT * FROM empresa WHERE id_empresa = '$id_empresa';";
          $resultado = mysqli_query($conecta, $sql);
        
         if ( mysqli_num_rows($resultado) > 0 )
         {        
            
             $linha = mysqli_fetch_assoc($resultado);
         }

        else
         {
            
             
              echo "<script type='text/javascript' language='javascript'> alert('Empresa não encontrada!!'); </script>";
               echo"<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cad.php'>";
            exit;
    

         }
         mysqli_close($conecta);
         ?>
        
        <form class="cadastro"  action="../back/alt_empresa.php" method="post" onsubmit="return verifica_senha()">
            <div class="razao">
                <input type="text" name="razao" id="razao" placeholder="Razão social" required autocomplete="off" autocomplete="off" value = "<?php echo $linha['razao'] ?>">
            </div>
        
            <div class="fantasia">
                <input type="text" name="fantasia" id="fantasia" placeholder="Nome Fantasia" required autocomplete="off" value = "<?php echo $linha['fantasia'] ?>">
            </div>

            <div class="cep">
                <input type="text" name="cep" id="cep" placeholder="CEP" required autocomplete="off" value = "<?php echo $linha['cep'] ?>">
            </div>

            <div class="conj">
                <input type="text" class="uf" name="uf" id="uf" placeholder="UF" required autocomplete="off" value = "<?php echo $linha['uf'] ?>">
                <input type="text" class="cidade" name="cidade" id="cidade" placeholder="Cidade" required autocomplete="off" value = "<?php echo $linha['cidade'] ?>">
                <input type="text" class="bairro" name="bairro" id="bairro" placeholder="Bairro" required autocomplete="off" value = "<?php echo $linha['bairro'] ?>">
            </div>

            <div class="conj">
                <input type="text" class="endereco"  name="endereco" id="endereco" placeholder="Rua" required autocomplete="off " value = "<?php echo $linha['endereco'] ?>">
                <input type="text" class="num"  name="num" id="num" placeholder="N°" required autocomplete="off" value = "<?php echo $linha['numero'] ?>">
            </div>
        
            <div class="conj">
                <input type="text" class="complemento"  name="complemento" id="complemento" placeholder="Complemento" autocomplete="off" value = "<?php echo $linha['complemento'] ?>">
            </div>
            
            <div class="cnpj">
                <input type="text" name="cnpj" id="cnpj" placeholder="CNPJ" required autocomplete="off" value = "<?php echo $linha['cnpj'] ?>" readonly="readonly">
            </div>

            <div class="conj">
                <input type="text"   name="cnae" class="cnae" id="cnae" placeholder="CNAE" required autocomplete="off" value = "<?php echo $linha['cnae'] ?>" readonly="readonly">
                <input type="text"  name="ie" class="ie" id="ie" placeholder="IE" required autocomplete="off" value = "<?php echo $linha['ie'] ?>" readonly="readonly">
            </div>
    
            <div class="senha">
                <input type="password" name="senha" id="senha" placeholder="Senha" required autocomplete="off" value = "<?php echo $linha['senha'] ?>" >
                <button type="button" onclick="mostrarSenha()" class="ver"><i class="fas fa-eye"></i></button>
            </div>

            <div class="senha">
                <input type="password" name="senha2" id="senha2" placeholder="Confirme sua senha" required autocomplete="off" value = "<?php echo $linha['senha'] ?>">
                <button type="button" onclick="mostrarSenha2()" class="ver"><i class="fas fa-eye"></i></button>
            </div>
            
            <input type="submit" class="botao" value="Alterar">
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script src="../js/jquery-1.2.6.pack.js" type="text/javascript"></script>
    <script src="../js/jquery.maskedinput-1.1.4.pack.js" type="text/javascript"></script>
    <script src="../js/funcs_cad_empresa.js"></script>
</body>
</html>