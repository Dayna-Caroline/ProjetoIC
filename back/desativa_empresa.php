<?php
    include "autenticacao.php";
    include "conexao_local.php";
    $senha=$_POST['senha'];
    $sql = "SELECT * FROM empresa WHERE cnpj = '{$_SESSION['cnpj']}' AND ativo = 's'";
    $resultado = mysqli_query($conecta, $sql);

    if ( mysqli_num_rows($resultado) > 0 )
    {        
        $linha = mysqli_fetch_array($resultado);
        $senha_original=$linha['senha'];
        
        if(md5($senha)==$senha_original)
        {
            $salva = md5($senha);
            $sql2="update empresa set ativo='n' WHERE cnpj = '{$_SESSION['cnpj']}' AND senha = '$salva'";
            if (mysqli_query($conecta, $sql2)) 
            {
                session_destroy();
                header("Location: ../index.php");           
            }else 
            {
                header("location: ../front/desativa.php?success=3");
            }
        }
        else{
            header("location: ../front/desativa.php?success=2");
        }
    }else
    {
        header("location: ../front/desativa.php?success=1");
    }
?>