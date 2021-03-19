<?php
    include "../autenticacao.php";
    include "../conexao_local.php";
            
        //nao deixa alterar os campos de documentos 
        $cpf=$_POST['cpf'];
        $nome=$_POST['nome'];
        $cep=$_POST['cep'];
        $endereco=$_POST['endereco'];
        $bairro=$_POST['bairro'];
        $num=$_POST['num'];        
        $complemento=$_POST['complemento'];
        $cidade=$_POST['cidade'];
        $uf=$_POST['uf'];
        $orgao=$_POST['orgao'];

        $sql = "SELECT * FROM profissional WHERE cnpf = '{$_SESSION['cpf']}'";
        $resultado = mysqli_query($conecta, $sql);

    if ( mysqli_num_rows($resultado) > 0 )
        { 
        $sql2=" update profissional set nome='$nome',cep='$cep',endereco='$endereco',bairro='$bairro', numero='$num', complemento='$complemento', cidade='$cidade',uf='$uf', orgao='$orgao' WHERE cpf = $cpf ";
        
        if (mysqli_query($conecta, $sql2)) 
        {
            header("location: ../../front/funcs/altera_profisisonal.php?success=2"); 
        }
        else
        {
            header("location: ../../front/funcs/altera_profissional.php?success=3");
        }
        }
?>