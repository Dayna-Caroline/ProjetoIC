<?php
    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";

    if(isset($_GET['success']))
    {
        if($_GET['success'] == '1')
        {
            echo '<script language="javascript">';
            echo "alert('Erro no cadastro! Tente novamente...')";
            echo '</script>';
        }else if($_GET['success'] == '2')
        {
            echo '<script language="javascript">';
            echo "alert('Esse CPF ja foi cadastrado.')";
            echo '</script>';
        }else if($_GET['success'] == '7')
        {
            echo '<script language="javascript">';
            echo "alert('Antes de cadastrar um projeto, você precisa cadastrar um funcionário')";
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
        <link rel="stylesheet" href="../../styles/projetos/menu.css">
        <link rel="stylesheet" href="../../styles/funcs/cad_funcs.css">
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
                <a href="funcionarios.php?pagina=1"><p class="volt alt">&#8592;  Voltar</p></a>
                <form action="../../back/funcs/cad_profissional.php" method="post" class="form" onsubmit="return verifica()">
                    <h1>Novo funcionário</h1>
                    <div class="espaco"></div>
                    <div class="nome">
                        <input type="text" name="nome" id="nome" placeholder="Nome do funcionário" required autocomplete="off" autocomplete="off">
                    </div>
                
                    <div class="conj">
                        <input type="text"   name="rg" class="rg" id="rg" placeholder="RG" required autocomplete="off" >
                        <input type="text"  name="cpf" class="cpf form-control cpf-mask" id="cpf" placeholder="CPF" required autocomplete="off">
                    </div>

                    <div class="nome">
                        <input type="text" name="cep" id="cep" placeholder="CEP" required autocomplete="off">
                    </div>

                    <div class="conj">
                        <input type="text" class="uf" name="uf" id="uf" placeholder="UF" required autocomplete="off">
                        <input type="text" class="cidade" name="cidade" id="cidade" placeholder="Cidade" required autocomplete="off">
                        <input type="text" class="bairro" name="bairro" id="bairro" placeholder="Bairro" required autocomplete="off">
                    </div>

                    <div class="conj">
                        <input type="text" class="endereco"  name="endereco" id="endereco" placeholder="Rua" required autocomplete="off">
                        <input type="number" class="num"  name="num" id="num" placeholder="N°" required autocomplete="off" maxlength="5">
                    </div>
                
                    <div class="nome">
                        <input type="text" class="complemento"  name="complemento" id="complemento" placeholder="Complemento" autocomplete="off">
                    </div>
                    
                    <div class="nome">
                        <input type="text" name="registro" id="registro" placeholder="Registro" required autocomplete="off">
                    </div>

                    <div class="nome">
                        <input type="text" name="orgao" id="orgao" placeholder="Órgao (Ex: CREA, CRA...)" required autocomplete="off" autocomplete="off">
                    </div>

                    <input type="submit" class="botao" value="Cadastrar">
                </form>
        
                
            </div> 

        </div>
        
        <script src="../../node_modules/js-brasil/js-brasil.js"></script>
        <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
        <script type="text/javascript" src="js/jquery.maskedinput-1.3.min.js"></script>
        <script src="../../js/jquery-1.2.6.pack.js" type="text/javascript"></script>
        <script src="../../js/jquery.maskedinput-1.1.4.pack.js" type="text/javascript"></script>
        <script src="../../js/funcs_cad_profissional.js"></script>
    </body>

</html>