<?php

    include "../autenticacao.php";
    include "../conexao_local.php";
    include "valida_projeto.php";

    // sucesso = 1: operação bem sucedida; sucesso = 2: erro na alteração; sucesso = 3: erro de preenchimento dos campos;
    // sucesso = 4: erro na conclusão; sucesso = 5: erro na exclusão;

    // REDIRECIONA PRA PAGINA DO NOVO PROJETO

    if(@$_POST['novo']){
        header("location: ../../front/projetos/cad_projeto.php"); die();
    }

    // SALVAR ALTERAÇÕES NO PROJETO

    if(@$_POST['salvar']){

        $id=$_POST['salvar'];

        $auxid=md5($_POST['salvar']);

        verifica_erro_alt($_POST['responsavel'],$_POST['descricao'],$_POST['finalidade'],$_POST['orcamento'],$_POST['inicio'],$_POST['aprovacao'],$_POST['c_final'],$_POST['previa'],$auxid);
        
        $responsavel=$_POST['responsavel'];
        $descricao=$_POST['descricao']; 
        $finalidade=$_POST['finalidade'];
        $orcamento=$_POST['orcamento'];
        $inicio=$_POST['inicio'];
        $aprovacao=$_POST['aprovacao'];
        $c_final=$_POST['c_final'];
        $previa=$_POST['previa'];

        $sql = "UPDATE projeto SET concluido = 's', descricao = '$descricao', finalidade = '$finalidade', orcamento = '$orcamento', responsavel = '$responsavel', aprovacao = '$aprovacao', inicio = '$inicio', previa = '$previa', c_final = '$c_final' WHERE id_projeto = $id;";
        
        if (mysqli_query($conecta, $sql)) 
        {   
            header("location: ../../front/projetos/projeto.php?id=".$auxid."&sucesso=1"); die();
        } 
        
        else 
        {
            header("location: ../../front/projetos/projeto.php?id=".$auxid."&sucesso=2"); die();
        } 

        mysqli_close($conecta);

    }

    // CANCELAR ALTERAÇÕES NO PROJETO

    if(@$_POST['cancelar']){
        $auxid=md5($_POST['cancelar']);
        { header("location: ../../front/projetos/projeto.php?id=".$auxid."");} die(); 
    }

    // CADASTRAR NOVO PROJETO

    if(@$_POST['cadastrar']){

        verifica_erro_cad($_POST['responsavel'],$_POST['descricao'],$_POST['finalidade'],$_POST['orcamento'],$_POST['inicio'],$_POST['aprovacao'],$_POST['previa']);

        $responsavel=$_POST['responsavel'];
        $descricao=$_POST['descricao'];
        $finalidade=$_POST['finalidade'];
        $orcamento=$_POST['orcamento'];
        $inicio=$_POST['inicio'];
        $aprovacao=$_POST['aprovacao'];
        $c_final="0";
        $fim="0000-00-00";
        $previa=$_POST['previa'];
        $empresa=$_SESSION['id_empresa'];
        $ativo="s";
        $concluido="n";

        $sql = "INSERT INTO projeto VALUES( null, '$descricao', '$finalidade','$orcamento', '$responsavel', '$aprovacao', '$inicio', '$previa', '$fim', '$c_final', '$empresa', '$ativo', '$concluido');";
                
        if (mysqli_query($conecta, $sql)) 
        { header("location: ../../front/projetos/menu.php?sucesso=1&pagina=1"); die(); }
        
        else 
        { header("location: ../../front/projetos/cad_projeto.php?sucesso=2"); die(); }

        mysqli_close($conecta);

    }

    // REDIRECIONA PRA PAGINA DE REQUISITOS

    if(@$_POST['req']){
        $id=md5($_POST['req']);
        header("location: ../../front/requisitos/requisitos.php?proj=".$id."&pagina=1"); die();
    }

    // MARCA OS PROJETOS COMO CONCLUIDOS

    if(@$_POST['conclui']){

        $id=$_POST['conclui'];
        $idaux=md5($id);
        $fim=date("Y-m-d");

        $query = "UPDATE projeto SET fim = '$fim', concluido = 's' WHERE md5(id_projeto) = '$idaux';";

        $resultado = mysqli_query($conecta, $query);

        if ( $resultado == true ){
            header("location: ../../front/projetos/projeto.php?id=".$idaux."&sucesso=1"); die();
        }

        else{
            header("location: ../../front/projetos/projeto.php?id=".$idaux."&sucesso=4"); die();
        }

    }

    // APAGA OS PROJETOS

    if(@$_POST['arquiva']){

        if(@$_POST['check_list']){

            foreach(@$_POST['check_list'] as $id){

                $idaux=md5($id);
                $query = "UPDATE projeto SET ativo = 'n' WHERE md5(id_projeto) = '$idaux';";
                $resultado2 = mysqli_query($conecta, $query);
                if ($resultado2 == true )$aux++;

            }

            if ( $aux>0 ){
                header("location: ../../front/projetos/menu.php?sucesso=1&pagina=1"); die();
            }

            else{
                header("location: ../../front/projetos/menu.php?sucesso=5&pagina=5"); die();
            }

        }

        else{

            $idaux=md5($id);
                $query = "UPDATE projeto SET ativo = 'n' WHERE md5(id_projeto) = '$idaux';";
                $resultado2 = mysqli_query($conecta, $query);

            if ( $resultado2 == true ){
                header("location: ../../front/projetos/menu.php?sucesso=1&pagina=1"); die();
            }

            else{
                header("location: ../../front/projetos/projeto.php?id=".$idaux."&sucesso=5"); die();
            }

        }  
              
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