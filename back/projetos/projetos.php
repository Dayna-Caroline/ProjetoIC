<?php

    include "../autenticacao.php";
    include "../conexao_local.php";

    if(@$_POST['novo']){
        header("location: ../../front/projetos/cad_projeto.php");
    }

    if(@$_POST['cadastrar']){

        $responsavel=$_POST['profissional'];
        $descricao=$_POST['descricao'];
        $finalidade=$_POST['finalidade'];
        $orcamento=$_POST['orcamento'];
        $inicio=$_POST['inicio'];
        $aprovacao=$_POST['aprovacao'];
        $c_final=$_POST['c_final'];
        $fim=$_POST['fim'];
        $empresa=$_SESSION['id_empresa'];

        $sql = "INSERT INTO projeto VALUES( null, '$descricao', '$finalidade','$orcamento', '$responsavel', '$aprovacao', '$inicio', '$fim', '$c_final', '$empresa');";
        if (mysqli_query($conecta, $sql)) 
        { header("location: ../../front/projetos/menu.php?");} 
        
        else 
        {echo '<script language=\"javascript\">alert(\'Não foi possível finalizar o cadastro, tente novamente em algusn minutos!\')</script>'; header("location: ../../front/projetos/cad_projeto.php?"); }

        mysqli_close($conecta);

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