<?php

    include "../autenticacao.php";
    include "../conexao_local.php";
    include "valida_projeto.php";

    // REDIRECIONA PRA PAGINA DO NOVO PROJETO

    if(@$_POST['novo']){
        header("location: ../../front/projetos/cad_projeto.php");
    }

    // SALVAR ALTERAÇÕES NO PROJETO

    if(@$_POST['salvar']){

        $id=$_POST['salvar'];

        $auxid=md5($_POST['salvar']);

        $responsavel=$_POST['profissional'];
        $descricao=$_POST['descricao'];
        $finalidade=$_POST['finalidade'];
        $orcamento=$_POST['orcamento'];
        $inicio=$_POST['inicio'];
        $aprovacao=$_POST['aprovacao'];
        $c_final=$_POST['c_final'];
        $previa=$_POST['previa'];

        $sql = "UPDATE projeto SET descricao = '$descricao', finalidade = '$finalidade', orcamento = '$orcamento', responsavel = '$responsavel', aprovacao = '$aprovacao', inicio = '$inicio', previa = '$previa', c_final = '$c_final' WHERE id_projeto = $id;";
        
        if (mysqli_query($conecta, $sql)) 
        { header("location: ../../front/projetos/projeto.php?id=".$auxid."");} 
        
        else 
        {
            echo '<script language=\"javascript\">alert(\'Não foi possível alterar os dados do projeto!\')</script>'; 
            header("location: ../../front/projetos/projeto.php?id=".$auxid."");
        } 

        mysqli_close($conecta);

    }

    // CANCELAR ALTERAÇÕES NO PROJETO

    if(@$_POST['cancelar']){
        $auxid=md5($_POST['cancelar']);
        { header("location: ../../front/projetos/projeto.php?id=".$auxid."");} 
    }

    // CADASTRAR NOVO PROJETO

    if(@$_POST['cadastrar']){

        $responsavel=$_POST['profissional'];
        $descricao=$_POST['descricao'];
        $finalidade=$_POST['finalidade'];
        $orcamento=$_POST['orcamento'];
        $inicio=$_POST['inicio'];
        $aprovacao=$_POST['aprovacao'];
        $c_final=$_POST['c_final'];
        $fim="0000-00-00";
        $previa=$_POST['previa'];
        $empresa=$_SESSION['id_empresa'];

        $sql = "INSERT INTO projeto VALUES( null, '$descricao', '$finalidade','$orcamento', '$responsavel', '$aprovacao', '$inicio', '$previa', '$fim', '$c_final', '$empresa');";
                
        if (mysqli_query($conecta, $sql)) 
        { header("location: ../../front/projetos/menu.php?");} 
        
        else 
        {
            echo '<script language=\"javascript\">alert(\'Não foi possível finalizar o cadastro, tente novamente em alguns minutos!\')</script>'; 
            header("location: ../../front/projetos/cad_projeto.php?");
        }

        mysqli_close($conecta);

    }

    // REDIRECIONA PRA PAGINA DE CADASTRO DE FUNCIONARIOS

    if(@$_POST['fnovo']){
        header("location: ../../front/funcs/cad_funcs.php");
    }

    // ALTERA FUNCIONÁRIOS
    if(@$_POST['faltera']){
        $query = "SELECT * FROM profissional WHERE empresa = '{$_SESSION['id_empresa']}' AND ativo='s'";
        $result = mysqli_query($conecta, $query);
        $row = mysqli_num_rows($result);
        if($row==0){
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../front/funcs/funcionarios.php?pagina=1'>";
        }else{
            header("location: ../../front/funcs/escolha_func.php");
        }
    }

    // REDIRECIONA PRA PAGINA DE REQUISITOS

    if(@$_POST['req']){
        $id=md5($_POST['req']);
        header("location: ../../front/requisitos/requisitos.php?proj=".$id."&pagina=1");
    }

    // MARCA OS PROJETOS COMO TERMINADOS

    if(@$_POST['conclui']){

        $id=$_POST['conclui'];
        $idaux=md5($id);
        $fim=date("Y-m-d");

        $query = "UPDATE projeto SET fim = '$fim' WHERE md5(id_projeto) = '$idaux';";

        $resultado2 = mysqli_query($conecta, $query);

        if ( $resultado2 == true ){
            header("location: ../../front/projetos/menu.php");
        }

        else{
            echo '<script language=\"javascript\">alert(\'Não foi possível excluir o projeto!\')</script>';
            header("location: ../../front/projetos/projeto.php?id=".$idaux."");
        }

    }

    // APAGA OS PROJETOS

    if(@$_POST['arquiva']){

        if(@$_POST['check_list']){

            foreach(@$_POST['check_list'] as $id){

                $idaux=md5($id);

                $query = "DELETE FROM requisitos WHERE md5(projeto) = '$idaux';";
                $resultado = mysqli_query($conecta, $query);

                $query = "DELETE FROM projeto WHERE md5(id_projeto) = '$idaux';";

                $resultado2 = mysqli_query($conecta, $query);
                if ($resultado2 == true )$aux++;

            }

            if ( $aux>0 ){
                header("location: ../../front/projetos/menu.php");
            }

            else{
                echo '<script language=\"javascript\">alert(\'Não foi possível excluir os projetos!\')</script>';
                header("location: ../../front/projetos/menu.php");
            }

        }

        else{

            $idaux=md5($_POST['arquiva']);

            $query = "DELETE FROM requisitos WHERE md5(projeto) = '$idaux';";
            $resultado = mysqli_query($conecta, $query);

            $query = "DELETE FROM projeto WHERE md5(id_projeto) = '$idaux';";
            $resultado2 = mysqli_query($conecta, $query);

            if ( $resultado2 == true ){
                header("location: ../../front/projetos/menu.php");
            }

            else{
                echo '<script language=\"javascript\">alert(\'Não foi possível excluir o projeto!\')</script>';
                header("location: ../../front/projetos/projeto.php?id=".$idaux."");
            }

        }  
              
    }

    // APAGA OS FUNCIONARIOS 

    if(@$_POST['fdelete']){
        if(@$_POST['check_list']){
            foreach(@$_POST['check_list'] as $id){

                $idaux=md5($id);

                $query = "UPDATE profissional set ativo='n' WHERE md5(id_profissional) = '$idaux';";
                $resultado = mysqli_query($conecta, $query);

                if ($resultado == true )$aux++;
            }

            if ( $aux>0 ){
                header("location: ../../front/funcs/funcionarios.php?pagina=1");
            }

            else{
                echo '<script language=\"javascript\">alert(\'Não foi possível excluir os funcionários!\')</script>';
                header("location: ../../front/funcs/funcionarios.php?pagina=1");
            }

        }

        else{

            $idaux=md5($_POST['fdelete']);

            $query = "UPDATE profissional set ativo='n' WHERE md5(projeto) = '$idaux';";
            $resultado = mysqli_query($conecta, $query);

            if ( $resultado == true ){
                header("location: ../../front/funcs/funcionarios.php?pagina=1");
            }

            else{
                echo '<script language=\"javascript\">alert(\'Não foi possível excluir o funcionário\')</script>';
                header("location: ../../front/funcs/funcionarios.php?pagina=1");
            }

        }  
              
    }

    if(@$_POST['freativa']){
        if(@$_POST['check_list']){
            foreach(@$_POST['check_list'] as $id){

                $idaux=md5($id);

                $query = "UPDATE profissional set ativo='s' WHERE md5(id_profissional) = '$idaux';";
                $resultado = mysqli_query($conecta, $query);

                if ($resultado == true )$aux++;
            }

            if ( $aux>0 ){
                header("location: ../../front/funcs/funcionarios.php?pagina=1");
            }

            else{
                echo '<script language=\"javascript\">alert(\'Não foi possível excluir os funcionários!\')</script>';
                header("location: ../../front/funcs/desativados.php?pagina=1");
            }

        }

        else{

            $idaux=md5($_POST['fdelete']);

            $query = "UPDATE profissional set ativo='s' WHERE md5(projeto) = '$idaux';";
            $resultado = mysqli_query($conecta, $query);

            if ( $resultado == true ){
                header("location: ../../front/funcs/funcionarios.php?pagina=1");
            }

            else{
                echo '<script language=\"javascript\">alert(\'Não foi possível excluir o funcionário\')</script>';
                header("location: ../../front/funcs/desativados.php?pagina=1");
            }

        }  
              
    }

?>