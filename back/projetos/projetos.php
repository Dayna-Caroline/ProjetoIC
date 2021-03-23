<?php

    include "../autenticacao.php";
    include "../conexao_local.php";

    if(@$_POST['novo']){
        header("location: ../../front/projetos/cad_projeto.php");
    }

    if(@$_POST['fnovo']){
        header("location: ../../front/funcs/cad_funcs.php");
    }

    if(@$_POST['req']){
        $id=md5($_POST['req']);
        header("location: ../../front/requisitos/requisitos.php?proj=".$id."&pagina=1");
    }

    if(@$_POST['conclui']){
        echo 'a';
    }

    if(@$_POST['arquiva']){
        $aux=0;

        if(@$_POST['check_list']){

            echo "cu de pombo";
            foreach(@$_POST['check_list'] as $id){
                $query = "DELETE FROM projeto WHERE id_projeto = $id;";
                $resultado = mysqli_query($conecta, $query);
                if ($resultado == true )$aux++;
            }
            if ( $aux>0 ){
                header("location: ../../front/projetos/menu.php");
            }
            else{
                echo '<script language=\"javascript\">alert(\'Erro ao tentar excluir\')</script>';
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../front/projetos/menu.php'>";
            }
        }

        else{
            $id=@$_POST['arquiva'];
            $query = "DELETE FROM projeto WHERE id_projeto = $id;";
            $resultado = mysqli_query($conecta, $query);

            if ( $resultado == true ){
                header("location: ../../front/projetos/menu.php");
            }
            else{
                echo '<script language=\"javascript\">alert(\'Erro ao tentar excluir\')</script>';
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../front/projetos/menu.php'>";
            }
        }  
              
    }

    if(@$_POST['delete_funcs']){
        $aux=0;

        if(@$_POST['check_list']){
            foreach(@$_POST['check_list'] as $id){
                $query = "DELETE FROM profissional WHERE id_profisional = $id;";
                $resultado = mysqli_query($conecta, $query);
                if ($resultado == true )$aux++;
            }
            if ( $aux>0 ){
                header("location: ../../front/funcs/funcionarios.php?pagina=1");
            }
            else{
                header("location: ../../front/funcs/funcionarios.php?pagina=1&sucess=1");
            }
        }

        else{
            $id=@$_POST['delete_funcs'];
            $query = "DELETE FROM profissional WHERE id_profisional = $id;";
            $resultado = mysqli_query($conecta, $query);

            if ( $resultado == true ){
                header("location: ../../front/funcs/funcionarios.php?pagina=1");
            }
            else{
                header("location: ../../front/funcs/funcionarios.php?pagina=1&sucess=1");
            }
        }  
              
    }
?>