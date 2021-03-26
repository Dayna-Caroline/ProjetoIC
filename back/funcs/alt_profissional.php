<?php
    include "../autenticacao.php";
    include "../conexao_local.php";
        //nao deixa alterar os campos de documentos

        $id=$_GET['id'];
        $nome=$_POST['nome'];
        $cep=$_POST['cep'];
        $endereco=$_POST['endereco'];
        $bairro=$_POST['bairro'];
        $num=$_POST['num'];        
        $complemento=$_POST['complemento'];
        $cidade=$_POST['cidade'];
        $uf=$_POST['uf'];
        $orgao=$_POST['orgao'];

        $sql = "SELECT * FROM profissional WHERE id_profissional='$id'";
        $resultado = mysqli_query($conecta, $sql);

        if ( mysqli_num_rows($resultado) > 0 )
        { 
            $sql2= "UPDATE profissional set nome='$nome',cep='$cep',endereco='$endereco',bairro='$bairro', numero='$num', complemento='$complemento', cidade='$cidade',uf='$uf', orgao='$orgao' WHERE id_profissional = $id ";
            
            if (mysqli_query($conecta, $sql2)) 
            {
                header("location: ../../front/funcs/alt_funcs.php"); 
            }
            else
            {
                header("location: ../../front/funcs/alt_funcs.php?success=2");
            }
        }
?>