<?php

    include "conexao_local.php";
        session_start();
        //$cnpj=$_SESSION['cnpj'];
        $id_empresa=1;

        // $sql="SELECT * FROM empresa WHERE cnpj= '$cnpj';";
         $sql="SELECT * FROM empresa WHERE id_empresa = '$id_empresa';";
          $resultado = mysqli_query($conecta, $sql);
        
         if ( mysqli_num_rows($resultado) > 0 )
         {        
            
             $linha = mysqli_fetch_assoc($resultado);
             $senha_original=$linha['senha'];
         }

        else
         {
            
             
              echo "<script type='text/javascript' language='javascript'> alert('Empresa não encontrada!!'); </script>";
               echo"<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cad.php'>";
            exit;
    

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
       if (mysqli_query($conecta, $sql2)) 
       {
           
                echo "<script type='text/javascript'>alert('Atualização dos dados feita com sucesso!')</script>";
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;";
   
       }
       
       else 
       {
            echo "Error updating record: " . mysqli_error($conecta);
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
    $sql3=" update empresa set razao='$razao', fantasia='$fantasia', cep='$cep', endereco='$endereco', bairro='$bairro', numero='$num', complemento='$complemento', cidade='$cidade', uf='$uf', senha='$senha' where id_empresa='$id_empresa'; ";
    if (mysqli_query($conecta, $sql3)) 
       {
           
                echo "<script type='text/javascript'>alert('Atualização dos dados feita com sucesso!')</script>";
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;";
   
       }
       
       else 
       {
            echo "Error updating record: " . mysqli_error($conecta);
        }
            

    }

   





?>