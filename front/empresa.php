<?php
    include "../back/autenticacao.php";
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
        if($complemento == null){
            $complemento = "Sem complemento";
        }
        $cnpj = $linha['cnpj'];
        $cnae = $linha['cnae'];
        $ie = $linha['ie'];
    }
    else{
        echo '<script language="javascript">';
        echo "alert('Erro na conexão com o banco de dados.')";
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
                <li><a href="empresa.php"><i class="fas fa-city"></i></i><span class="nav-text">Empresa</span></a></li>
                <li class="pag"><a href="menu.php?pagina=1"><i class="fas fa-stream"></i></i><span class="nav-text">Projetos</span></a></li>
                <li><a href="funcionarios.php?pagina=1"><i class="fas fa-users"></i><span class="nav-text">Funcionários</span></a></li>
                <li><a href=""><i class="fas fa-battery-three-quarters"></i><span class="nav-text">Equipamentos</span></a></li>
                <li><a href="requisitos.php"><i class="fas fa-edit"></i><span class="nav-text">Requisitos</span></a></li>
                <li><a href=""><i class="fas fa-cogs"></i><span class="nav-text">Controle</span></a></li>
                <li><a href=""><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
            </ul>
        </div>

        <div class="conteudo">
            <h1>Dados - <?php echo $empresa;?></h1>
            <div class="dados">
                <div class="razao">
                    <span>Empresa:</span>
                    <a class="input"><?php echo $empresa;?></a>
                </div>
            
                <div class="fantasia">
                    <span>Usuário:</span>
                    <a class="input"><?php echo $fantasia;?></a>
                </div>

                <div class="cep">
                    <span>CEP:</span>
                    <a class="input"><?php echo $cep;?></a>
                </div>

                <div class="conj">
                    <span>UF:</span>
                    <a class="input uf"><?php echo $uf;?></a>
                    <span>Cidade:</span>
                    <a class="input cidade"><?php echo $cidade;?></a>
                </div>

                <div class="bairro">
                    <span>Bairro:</span>
                    <a class="input bairro"><?php echo $bairro;?></a>
                </div>

                <div class="conj">
                    <span>Endereço:</span>
                    <a class="input endereco"><?php echo $rua;?></a>
                    <span>N°:</span>
                    <a class="input num"><?php echo $num;?></a>
                </div>
            
                <div class="conj">
                    <span>Complemtento:</span>
                    <a class="input complemento"><?php echo $complemento;?></a>
                </div>
                
                <div class="cnpj">
                    <span>CNPJ:</span>
                    <a class="input"><?php echo $cnpj;?></a>
                </div>

                <div class="conj">
                    <span>CNAE:</span>
                    <a class="input cnae"><?php echo $cnae;?></a>
                    <span>IE:</span>
                    <a class="input ie"><?php echo $ie;?></a>
                </div>
            </div>
            
            <br>
            <a href="altera_empresa.php"><button class="botao">Alterar dados</button></a> <br>
            <a href="desativa.php"><button class="botao">Desativar empresa</button></a> <br>
            <a href="../back/logout.php"><button class="botao">Logout</button></a>
        </div>
    </div>
</body>
</html>