<?php
    session_start();
    include "../conexao_local.php";

    $cnpj = mysqli_real_escape_string($conecta, $_POST['cnpj']);
    $senha = mysqli_real_escape_string($conecta, $_POST['senha']);

    $query = "SELECT * FROM empresa WHERE cnpj = '{$cnpj}' and senha = md5('{$senha}') and ativo = 's'";
    $result = mysqli_query($conecta, $query);
    $row = mysqli_num_rows($result);
    if($row == 1){

        $linha = mysqli_fetch_array($result);
        $_SESSION['cnpj'] = $cnpj;
        $_SESSION['id_empresa'] = $linha['id_empresa'];
        
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../front/projetos/menu.php?pagina=1'>";

    }
    else{
        header("location: ../../front/empresa/login.php?success=false");
    }
?>