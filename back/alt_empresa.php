<?php

include "../back/conexao_local.php";
            //session_start();
            //$id_empresa=$_SESSION['id'];
            $id_empresa=9;

        $sql="SELECT * FROM empresa WHERE id_empresa = '$id_empresa';";
        $resultado=pg_query($conecta,$sql);
        $qtde=pg_num_rows($resultado);
        if ( $qtde == 0 )
        {        
            echo "<script type='text/javascript' language='javascript'> alert('Você ainda não possui um cadastro!'); </script>";
               
            
        }
        if($qtde > 0)
        {
           $linha = pg_fetch_array($resultado);
          $senha_original=$linha['senha'];
        }

    $razao=$_POST['razao'];
    $fantasia=$_POST['fantasia'];
    $cep=$_POST['cep'];
    $endereco=$_POST['endereco'];
    $bairro=$_POST['bairro'];
    $num=$_POST['num'];
    $complemento=$_POST['complemento'];
    $cidade=$_POST['cidade'];
    $uf=$_POST['uf'];
    
    $nova_senha=$_POST['senha'];
    $confirma_senha=$_POST['senha2'];
   // $senha=md5($senha);

   if($nova_senha==$senha_original)//nao alterou a senha
   {
       $sql2=" update empresa set razao='$razao', fantasia='$fantasia', cep='$cep', endereco='$endereco', bairro='$bairro', numero='$num', complemento='$complemento', cidade='$cidade', uf='$uf' where id_empresa='$id_empresa'; ";
       $resultado2 = pg_query($conecta, $sql2);
       $linhas2 = pg_affected_rows($resultado2);
       if($linhas2>0)
       {
           
          
                echo "<script type='text/javascript'>alert('Atualização dos dados feita com sucesso!')</script>";
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;";
   
       }
   }

   if($nova_senha!=$confirma_senha)
   {
    echo "<script type='text/javascript'>alert('As senhas são diferentes, por favor redigite!')</script>";
    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=altera.php'>"; //vai para alteração de dados de novo
   }

   else
   {
    $senha = md5($confirma_senha);
    $sql2=" update empresa set razao='$razao', fantasia='$fantasia', cep='$cep', endereco='$endereco', bairro='$bairro', numero='$num', complemento='$complemento', cidade='$cidade', uf='$uf', senha='$senha' where id_empresa='$id_empresa'; ";
    $resultado2 = pg_query($conecta, $sql2);
    $linhas2 = pg_affected_rows($resultado2);
    if($linhas2>0)
    {
        
       
             echo "<script type='text/javascript'>alert('Atualização dos dados feita com sucesso!')</script>";
             echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=altera.php'>";

    }

   }





?>