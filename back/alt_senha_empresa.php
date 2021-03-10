<?php
    include "autenticacao.php";
    include "conexao_local.php";
    $atual=$_POST['antiga'];
    $nova=$_POST['nova'];
    $confirma=$_POST['confirma'];
    $sql = "SELECT * FROM empresa WHERE cnpj = '{$_SESSION['cnpj']}' AND ativo = 's'";
    $resultado = mysqli_query($conecta, $sql);

    if ( mysqli_num_rows($resultado) > 0 )
    {        
        $linha = mysqli_fetch_assoc($resultado);
        $senha_original=$linha['senha'];
        
        if(md5($atual)==$senha_original)
        {
            if($nova == $confirma){
                $sql2=" update empresa set senha='md5($nova)' WHERE cnpj = '{$_SESSION['cnpj']}' AND ativo = 's'";
                if (mysqli_query($conecta, $sql2)) 
                {
                    header("location: ../front/conf_avan_empresa.php?success=4");            
                }else 
                {
                    header("location: ../front/conf_avan_empresa.php?success=1");
                }
            }else{
                header("location: ../front/conf_avan_empresa.php?success=3");
            }
        }
        else{
            header("location: ../front/conf_avan_empresa.php?success=2");
        }
    }else
    {
        header("location: ../front/conf_avan_empresa.php?success=1");
    }
?>