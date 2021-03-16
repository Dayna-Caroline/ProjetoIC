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

    $sql = "SELECT * FROM empresa WHERE cnpj = '$cnpj' AND ativo = 's'";
    $resultado = mysqli_query($conecta, $sql);
    if ( mysqli_num_rows($resultado) > 0 )
    {        
        header("location: ../front/cad_empresa.php?success=2");
    }else
    {
        $sql = "INSERT INTO empresa VALUES( null, '$razao', '$fantasia', '$cep','$endereco','$num','$bairro', '$complemento', '$cidade', '$uf', '$cnpj','$ie', '$cnae','s','$senha');";
        if (mysqli_query($conecta, $sql)) {
            $_SESSION['cnpj'] = $cnpj;
            $sql = "SELECT * FROM empresa WHERE cnpj = '$cnpj' AND ativo = 's'";
            $resultado = mysqli_query($conecta, $sql);
            if ( mysqli_num_rows($resultado) == 1)
            {        
                $linha = mysqli_fetch_array($resultado);
                $_SESSION['id_empresa'] = $linha['id_empresa'];
            }
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../front/menu.php?pagina=1'>";
        } else {
            header("location: ../front/cad_empresa.php?success=1");
        }
    }
    mysqli_close($conecta);
?>