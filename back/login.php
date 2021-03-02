<?php
    include "conexao_local.php";
    session_start();
    $falha = "";
    

if (isset($_POST['btnLogar']))
{
    $cnpj = $_POST['cnpj'];
    $senha = $_POST['senha'];
    
    if(strlen($cnpj)==0)
    {
        $falha = "Insira seu CNPJ";
    }
    if(strlen($senha)==0)
    {
        $falha = "Insira sua senha";
    }
    $senha = md5($senha);
    $cnpj_query = pg_query("SELECT * FROM empresa WHERE cnpj = '$cnpj'");
    $dados_cnpj = pg_fetch_array($cnpj_query);
    $linhas_cnpj = pg_num_rows($verifica_email);
    if($linhas_cnpj == 0)
    {
        $falha = "CNPJ Inválido";
    }
    else
    {
        if($dados_cnpj['senha']==$senha)
        {
            $_SESSION['logado'] = true;
            $_SESSION['id'] = $dados_cnpj['id_empresa'];
            $_SESSION['nome']= $dados_cnpj['fantasia'];
            echo '<script language="javascript">';
            echo "alert('Login Feito com sucesso')";
            echo '</script>';
            header("Location: index.php");
        }
        else
        {
            $falha = "Email ou senha incorretos!";
        }
    }
    if(strlen($falha)>0)
    {
        echo '<script language="javascript">';
        echo "alert('Ocorreu um erro ".$falha."')";
        echo '</script>';
    }

}
    
?>