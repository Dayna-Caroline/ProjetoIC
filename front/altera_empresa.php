<?php
    include "../back/autenticacao.php";
    include "../back/conexao_local.php";
    if(isset($_GET['success']))
    {
        if($_GET['success'] == 1)
        {
            echo '<script language="javascript">';
            echo "alert('Confirme sua senha para fazer a alteração.')";
            echo '</script>';
        }else if($_GET['success'] == 2){
            echo '<script language="javascript">';
            echo "alert('Dados alterados com sucesso.')";
            echo '</script>';
        }else if($_GET['success'] == 3){
            echo '<script language="javascript">';
            echo "alert('Erro na alteração, tente novamente.')";
            echo '</script>';
        }else if($_GET['success'] == 4){
            echo '<script language="javascript">';
            echo "alert('Senha incorreta, tente novamente.')";
            echo '</script>';
        }else if($_GET['success'] == 5){
            echo '<script language="javascript">';
            echo "alert('Senha alterada com sucesso.')";
            echo '</script>';
        }
    }
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
        <a href="empresa.php"><p class="volt alt">&#8592;  Voltar</p></a>
        <a href="conf_avan_empresa.php"><p class="ir">Configurações avançadas&#8594;</p></a>
        <form action="../back/alt_empresa.php" method="post" class="conteudo">
            <h1>Alteração - <?php echo $empresa;?></h1>
            
            <div class="cadastro">
                <div class="razao">
                    <input type="text" name="razao" id="razao" value="<?php echo $empresa;?>" required autocomplete="off" autocomplete="off">
                </div>
            
                <div class="fantasia">
                    <input type="text" name="fantasia" id="fantasia" value="<?php echo $fantasia;?>" required autocomplete="off">
                </div>

                <div class="cep">
                    <input type="text" name="cep" id="cep" value="<?php echo $cep;?>" required autocomplete="off">
                </div>

                <div class="conj">
                    <input type="text" class="uf" name="uf" id="uf" value="<?php echo $uf;?>" required autocomplete="off">
                    <input type="text" class="cidade" name="cidade" id="cidade" value="<?php echo $cidade;?>" required autocomplete="off">
                </div>

                <input type="text" class="bairro" name="bairro" id="bairro" value="<?php echo $bairro;?>" required autocomplete="off">

                <div class="conj">
                    <input type="text" class="endereco"  name="endereco" id="endereco" value="<?php echo $rua;?>" required autocomplete="off">
                    <input type="text" class="num"  name="num" id="num" value="<?php echo $num;?>" required autocomplete="off">
                </div>
            
                <div class="conj">
                    <input type="text" class="complemento"  name="complemento" id="complemento" value="<?php echo $complemento;?>" autocomplete="off">
                </div>

                <div class="div">
                    <input type="password" name="senha" id="senha" placeholder="Confirme sua senha para alteração" required> 
                </div>

                <br>
                <input type="submit" value="Alterar dados" class="botao">
            </div>
        </form>
    </div>
</body>
</html>