<?php
    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";

    if(isset($_GET['success']))
    {
        if($_GET['success'] == '2')
        {
            echo '<script language="javascript">';
            echo "alert('Erro ao realizar a alteração, tente novamente.')";
            echo '</script>';
        }
    }

    $id = $_POST['profissional'];
    $query = "SELECT * FROM profissional WHERE id_profissional=$id";
    $result = mysqli_query($conecta, $query);
    $row = mysqli_num_rows($result);
    if($row==1){
        $linha=mysqli_fetch_array($result);
        $comp = $linha['complemento'];

        if($comp == null){
            $comp = "Sem complemento";
        }
    }else{
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../front/funcs/escolha_func.php'>";
    }
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
                    <li class="navitem"><a href="../controle/consumo.php"><i class="fas fa-cogs"></i><span class="nav-text">Consumo</span></a></li>
                    <li class="navitem"><a href="../results/resultados.php"><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
                </ul>
            </div>

            <div class="conteudo">
                <a href="escolha_func.php"><p class="volt alt">&#8592;  Voltar</p></a>
                <form action="../../back/funcs/alt_profissional.php?id=<?php echo $id;?>" method="post" class="form">
                    <h1>Alterar funcionário</h1>
                    
                    <div class="nome">
                        <input type="text" name="nome" id="nome" value="<?php echo $linha['nome'];?>" required autocomplete="off" autocomplete="off">
                    </div>

                    <div class="nome">
                        <input type="text" name="cep" id="cep" value="<?php echo $linha['cep'];?>" required autocomplete="off">
                    </div>

                    <div class="conj">
                        <input type="text" class="uf" name="uf" id="uf" value="<?php echo $linha['uf'];?>" required autocomplete="off">
                        <input type="text" class="cidade" name="cidade" id="cidade" value="<?php echo $linha['cidade'];?>" required autocomplete="off">
                        <input type="text" class="bairro" name="bairro" id="bairro" value="<?php echo $linha['bairro'];?>" required autocomplete="off">
                    </div>

                    <div class="conj">
                        <input type="text" class="endereco"  name="endereco" id="endereco" value="<?php echo $linha['endereco'];?>" required autocomplete="off">
                        <input type="number" class="num" maxlength="5" name="num" id="num" value="<?php echo $linha['numero'];?>" required autocomplete="off">
                    </div>
                
                    <div class="nome">
                        <input type="text" class="complemento"  name="complemento" id="complemento" value="<?php echo $comp;?>" autocomplete="off">
                    </div>

                    <div class="nome">
                        <input type="text" name="orgao" id="orgao" value="<?php echo $linha['orgao'];?>" required autocomplete="off" autocomplete="off">
                    </div>

                    <input type="submit" class="botao" value="Alterar">
                </form>
        
                
            </div>

        </div>

        <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
        <script src="../../js/jquery-1.2.6.pack.js" type="text/javascript"></script>
        <script src="../../js/jquery.maskedinput-1.1.4.pack.js" type="text/javascript"></script>
        <script src="../../js/funcs_cad_profissional.js"></script>
    </body>

</html>