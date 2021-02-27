<?php 
    include "conexao_local.php";
    $razao=$_POST['razao'];
    $fantasia=$_POST['fantasia'];
    $cep=$_POST['cep'];
    $endereco=$_POST['endereco'];
    $bairro=$_POST['bairro'];
    $num=$_POST['num'];
    
    /*if($_POST['complemento']==" ")
    {
        $complemento=null;
    }
    else 
        $complemento=$_POST['complemento'];*/
        
    $complemento=$_POST['complemento'];

    $cidade=$_POST['cidade'];
    $uf=$_POST['uf'];
    $cnpj=$_POST['cnpj'];
    $ie=$_POST['ie'];
    $cnae=$_POST['cnae'];
    $senha=$_POST['senha'];
    $senha=md5($senha);

    $sql = "INSERT INTO empresa VALUES( nextval('id_empresa'), '$razao', '$fantasia', '$cep','$endereco','$num','$bairro', '$complemento', '$cidade', '$uf', '$cnpj','$ie', '$cnae','s','$senha');";
    $resultado=pg_query($conecta,$sql);
    $linhas=pg_affected_rows($resultado);
    if($linhas > 0)
    {
        echo '<script language="javascript">';
        echo "alert('Funfou o cad')";
        echo '</script>';
        pg_close($conecta);
    }
    else{
        echo '<script language="javascript">';
        echo "alert('Deu ruim no cad')";
        echo '</script>';
        pg_close($conecta);
    }
?>