<?php 
    include "conexao_local.php";
    session_start();
    $razao=$_POST['razao'];
    $fantasia=$_POST['fantasia'];
    $cep=$_POST['cep'];
    $endereco=$_POST['endereco'];
    $bairro=$_POST['bairro'];
    $num=$_POST['num'];        
    $complemento=$_POST['complemento'];

    $cidade=$_POST['cidade'];
    $uf=$_POST['uf'];
    $cnpj=$_POST['cnpj'];
    $ie=$_POST['ie'];
    $cnae=$_POST['cnae'];
    $senha=$_POST['senha'];
    $senha=md5($senha);

    $sql = "INSERT INTO empresa VALUES( null, '$razao', '$fantasia', '$cep','$endereco','$num','$bairro', '$complemento', '$cidade', '$uf', '$cnpj','$ie', '$cnae','s','$senha');";
    if (mysqli_query($conecta, $sql)) {
        $_SESSION['cnpj'] = $cnpj;
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../front/menu.php'>";
    } else {
        header("location: ../front/cad_empresa.php?success=false");
    }
    mysqli_close($conecta);
?>