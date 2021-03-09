<?php
    session_start();
    include "../back/conexao_local.php";
    $query = "SELECT * FROM empresa WHERE cnpj = '{$_SESSION['cnpj']}' AND ativo = 's'";
    $result = mysqli_query($conecta, $query);
    $row = mysqli_num_rows($result);
    if($row == 1){
        $linha = mysqli_fetch_array($result);
        $empresa = $linha['razao'];
        $fantasia = $linha['fantasia'];
        $cep = $linha['cep'];
        $uf = $linha['uf'];
        $cidade = $linha['cidade'];
        $bairro = $linha['bairro'];
        $rua = $linha['endereco'];
        $num = $linha['numero'];
        $complemento = $linha['complemento'];
        $cnpj = $linha['cnpj'];
        $cnae = $linha['cnae'];
        $ie = $linha['ie'];
        $senha = md5($linha['senha']);
    }
    else{
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="../styles/empresa.css">
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
                <li class="pag"><a href="empresa.php"><i class="fas fa-city"></i></i>Empresa</a></li>
                <li><a href=""><i class="fas fa-users"></i>Funcionários</a></li>
                <li><a href=""><i class="fas fa-battery-three-quarters"></i>Equipamentos</a></li>
                <li><a href=""><i class="fas fa-edit"></i>Requisitos</a></li>
                <li><a href=""><i class="fas fa-cogs"></i>Controle</a></li>
                <li><a href=""><i class="fas fa-chart-pie"></i>Resultados</a></li>
            </ul>
        </div>
        <div class="conteudo">
            <h1>Dados - <?php echo $empresa;?></h1>
            
            <div class="cadastro">
                <div class="razao">
                    <input type="text" name="razao" id="razao" placeholder="<?php echo $empresa;?>" required autocomplete="off" autocomplete="off" readonly>
                </div>
            
                <div class="fantasia">
                    <input type="text" name="fantasia" id="fantasia" placeholder="<?php echo $fantasia;?>" required autocomplete="off" readonly>
                </div>

                <div class="cep">
                    <input type="text" name="cep" id="cep" placeholder="<?php echo $cep;?>" required autocomplete="off" readonly>
                </div>

                <div class="conj">
                    <input type="text" class="uf" name="uf" id="uf" placeholder="<?php echo $uf;?>" required autocomplete="off" readonly>
                    <input type="text" class="cidade" name="cidade" id="cidade" placeholder="<?php echo $cidade;?>" required autocomplete="off" readonly>
                </div>

                <input type="text" class="bairro" name="bairro" id="bairro" placeholder="<?php echo $bairro;?>" required autocomplete="off" readonly>

                <div class="conj">
                    <input type="text" class="endereco"  name="endereco" id="endereco" placeholder="<?php echo $rua;?>" required autocomplete="off" readonly>
                    <input type="text" class="num"  name="num" id="num" placeholder="<?php echo $num;?>" required autocomplete="off" readonly>
                </div>
            
                <div class="conj">
                    <input type="text" class="complemento"  name="complemento" id="complemento" placeholder="<?php echo $complemento;?>" autocomplete="off" readonly>
                </div>
                
                <div class="cnpj">
                    <input type="text" name="cnpj" id="cnpj" placeholder="<?php echo $cnpj;?>" required autocomplete="off" readonly>
                </div>

                <div class="conj">
                    <input type="text"   name="cnae" class="cnae" id="cnae" placeholder="<?php echo $cnae;?>" required autocomplete="off" readonly>
                    <input type="text"  name="ie" class="ie" id="ie" placeholder="<?php echo $ie;?>" required autocomplete="off" readonly>
                </div>
        
                <div class="senha">
                    <input type="password" name="senha" id="senha" placeholder="<?php echo $senha;?>" required autocomplete="off" readonly>
                    <button type="button" onclick="mostrarSenha()" class="ver"><i class="fas fa-eye"></i></button>
                </div>
                
                <a href=""><button class="botao">Alterar dados</button></a> <br>
                <a href="desativa.php"><button class="botao">Desativar empresa</button></a> <br>
                <a href=""><button class="botao">Logout</button></a>
                
            </div>
        </div>
    </div>
</body>
</html>