<?php
    session_start();
    include "conexao_local.php";

    $cnpj = mysqli_real_escape_string($conecta, $_POST['cnpj']);
    $senha = mysqli_real_escape_string($conecta, $_POST['senha']);

    $query = "SELECT * FROM empresa WHERE cnpj = '{$cnpj}' and senha = md5('{$senha}') and ativo = 's'";
    $result = mysqli_query($conecta, $query);
    $row = mysqli_num_rows($result);
    if($row == 1){
        $_SESSION['cnpj'] = $cnpj;
    }
    else{
        echo "Cnpj ou senha incorretos.";
    }
?>