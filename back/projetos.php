<?php

    include "autenticacao.php";
    include "conexao_local.php";

    if(@$_POST['novo']){
        header("location: ../front/cad_projeto.php");
    }
    
    if(@$_POST['arquiva']){
        $aux=0;
        if(@$_POST['checklist']){
            foreach($_POST['check_list'] as $id){
                $query = "DELETE FROM projeto WHERE id_projeto = $id;";
                $resultado = mysqli_query($conecta, $query);
                if ($resultado == true )$aux++;
            }
            if ( $aux>0 ){
                header("location: ../front/menu.php");
            }
            else{
                echo '<script language=\"javascript\">alert(\'Erro ao tentar excluir\')</script>';
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../front/menu.php'>";
            }
        }

        else{
            $query = "DELETE FROM projeto WHERE id_projeto = '{$_POST['arquiva']}';";
            $resultado = mysqli_query($conecta, $query);

            if ( $resultado == true ){
                header("location: ../front/menu.php");
            }
            else{
                echo '<script language=\"javascript\">alert(\'Erro ao tentar excluir\')</script>';
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../front/menu.php'>";
            }
        }  
              
    }
    
?>