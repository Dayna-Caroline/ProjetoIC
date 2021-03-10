<?php
    include "autenticacao.php";
    include "conexao_local.php";
    //$cnpj=$_SESSION['cnpj'];
    // $sql="SELECT * FROM empresa WHERE cnpj= '$cnpj';";
    $nova_senha=$_POST['senha'];
    $razao=$_POST['razao'];
    $fantasia=$_POST['fantasia'];
    $cep=$_POST['cep'];
    $endereco=$_POST['endereco'];
    $bairro=$_POST['bairro'];
    $num=$_POST['num'];
    $complemento=$_POST['complemento'];
    $cidade=$_POST['cidade'];
    $uf=$_POST['uf'];
    $sql = "SELECT * FROM empresa WHERE cnpj = '{$_SESSION['cnpj']}' AND ativo = 's'";
    $resultado = mysqli_query($conecta, $sql);

    if ( mysqli_num_rows($resultado) > 0 )
    {        
        $linha = mysqli_fetch_assoc($resultado);
        $senha_original=$linha['senha'];
        
        if(md5($nova_senha)==$senha_original)
        {
            $sql2=" update empresa set razao='$razao', fantasia='$fantasia', cep='$cep', endereco='$endereco', bairro='$bairro', numero='$num', complemento='$complemento', cidade='$cidade', uf='$uf' WHERE cnpj = '{$_SESSION['cnpj']}' AND ativo = 's'";
            if (mysqli_query($conecta, $sql2)) 
            {
                header("location: ../front/altera_empresa.php?success=2");            
            }else 
            {
                header("location: ../front/altera_empresa.php?success=3");
            }
        }
        else{
            header("location: ../front/altera_empresa.php?success=4");
        }
    }else
    {
        header("location: ../front/altera_empresa.php?success=3");
    }
?>