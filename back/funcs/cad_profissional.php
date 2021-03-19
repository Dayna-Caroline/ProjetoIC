<?php
    //cadastro de funcionarios 
    include "../conexao_local.php";
    session_start();
    

    $nome=$_POST['nome'];
    $cpf=$_POST['cpf'];
    $rg=$_POST['rg'];
    $cep=$_POST['cep'];
    $endereco=$_POST['endereco'];
    $bairro=$_POST['bairro'];
    $num=$_POST['num'];        
    $complemento=$_POST['complemento'];
    $cidade=$_POST['cidade'];
    $uf=$_POST['uf'];
    $registro=$_POST['registro'];
    $orgao=$_POST['orgao'];
    $empresa=$_SESSION['id_empresa'];

    $sql = "SELECT * FROM profissional WHERE cpf = '$cpf' ";
    $resultado = mysqli_query($conecta, $sql);
    if ( mysqli_num_rows($resultado) > 0 )
    {        
       echo("Profissional já cadastrado!");
      // header("location: ../front/empresa.php?success=1");
    }else
    {
        $sql = "INSERT INTO profissional VALUES( null, '$nome', '$cpf', '$rg','$cep','$endereco','$num','$bairro', '$complemento', '$cidade', '$uf', '$registro','$orgao', '$empresa');";
        if (mysqli_query($conecta, $sql)) {
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../front/funcs/funcionarios.php'>";
        } else {
            echo("Nao foi possivel cadastrar o profissional!");
            //header("location: ../front/empresa.php?success=1");
        }
    }
    mysqli_close($conecta);

?>