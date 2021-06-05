<?php

    include "../autenticacao.php";
    include "../conexao_local.php";

    // REDIRECIONA PRA PAGINA DO NOVO REQUISITO
    
    // sucesso = 1: operação bem sucedida; sucesso = 2: erro na alteração; sucesso = 3: erro de preenchimento dos campos;
    // sucesso = 4: erro na conclusão; sucesso = 5: erro na exclusão;

    if(@$_POST['novo']){
        header("location: ../../front/requisitos/cad_requisitos.php?proj=".$_POST['novo'].""); die();
    }

    // CADASTRA REQUISITO

    if(@$_POST['cadastra']){

        $id=$_POST['cadastra'];

        $sql = "SELECT id_projeto FROM projeto WHERE md5(id_projeto) = '$id';";
        $resultado = mysqli_query($conecta, $sql);
        $linha=mysqli_fetch_array($resultado);
        $projeto=$linha['id_projeto'];

        $descricao=$_POST['descricao'];
        $titulo=$_POST['titulo'];
        $processo=$_POST['processo'];
        $cadastro=$_POST['cadastro'];
        $versao='1';
        $tipo=$_POST['tipo'];

        $sql2 = "INSERT INTO requisitos VALUES( null, '$projeto', '$titulo', '$processo', '$cadastro', '$versao', '$descricao', '$tipo', 's');";
                
        if (mysqli_query($conecta, $sql2)) 
        { 
            header("location: ../../front/requisitos/requisitos.php?proj=".$id."&pagina=1&sucesso=1"); die();       
        } 
        
        else 
        {
            header("location: ../../front/requisitos/requisitos.php?proj=".$id."&pagina=1&sucesso=2"); die();      
        }

        mysqli_close($conecta);

    }

    // EXCLUI REQUISITO

    if(@$_POST['arquiva']){
 
        if(@$_POST['check_list']){
    
            foreach(@$_POST['check_list'] as $id){
    
                $idaux=md5($id);
    
                $query = "UPDATE requisitos SET ativo = 'n' WHERE md5(id_requisito) = '$idaux';";
                $resultado = mysqli_query($conecta, $query);
                if ($resultado == true )$aux++;
    
            }
    
            if ( $aux>0 ){
                header("location: ../../front/requisitos/requisitos.php?proj=".$_POST['arquiva']."&pagina=1&sucesso=1"); die();
            }
    
            else{
                header("location: ../../front/requisitos/requisitos.php?proj=".$_POST['arquiva']."&pagina=1&sucesso=5"); die();
            }
    
        }
    
        else{
    
            $idaux=md5($_POST['arquiva']);

            $sql = "SELECT projeto FROM requisitos WHERE md5(id_requisito) = '$idaux';";
            $resultado2 = mysqli_query($conecta, $sql);
            $linha=mysqli_fetch_array($resultado2);
            $projeto=md5($linha['projeto']);
    
            $query = "UPDATE requisitos SET ativo = 'n' WHERE md5(id_requisito) = '$idaux';";
            $resultado = mysqli_query($conecta, $query);
    
            if ( $resultado == true ){
                header("location: ../../front/requisitos/requisitos.php?proj=".$projeto."&pagina=1&sucesso=1"); die();
            }
    
            else{
                header("location: ../../front/requisitos/requisito.php?id=".$projeto."&sucesso=5"); die();
            }
    
        }

        mysqli_close($conecta);
                  
    }

    // ALTERA REQUISITO

    if(@$_POST['altera']){

        $id=md5($_POST['altera']);

        $descricao=$_POST['descricao'];
        $projeto=$_POST['projeto'];
        $titulo=$_POST['titulo'];
        $processo=$_POST['processo'];
        $cadastro=$_POST['cadastro'];
        $versao=$_POST['versao'];
        $tipo=$_POST['tipo'];
    
        $sql = "UPDATE requisitos SET descricao = '$descricao', titulo = '$titulo', processo = '$processo', cadastro = '$cadastro', versao = '$versao', tipo = '$tipo' WHERE md5(id_requisito) = '$id';";
            
        if (mysqli_query($conecta, $sql))
        { header("location: ../../front/requisitos/requisito.php?id=".$id."&sucesso=1");  die(); } 
            
        else 
        {
            header("location: ../../front/requisitos/requisito.php?id=".$id."&sucesso=2");  die();
        } 
    
        mysqli_close($conecta);
        
    }

    // CANCELA ALTERAÇÃO NO REQUISITO

    if(@$_POST['cancela']){
        $auxid=md5($_POST['cancela']);
        { header("location: ../../front/requisitos/requisito.php?id=".$auxid.""); die(); } 
    }

    // REDIRECIONA PRA PAGINA DE RESTAURAR EXCLUIDOS
    if(@$_POST['restaurar']){
        header("location: ../../front/requisitos/restaurar.php?pagina=1&proj=".$_POST['restaurar'].""); die();
    }

    // RESTAURAR REQUISITOS EXCLUIDOS
    if(@$_POST['restaura']){
        if(@$_POST['check_list_restaurar']){

            foreach(@$_POST['check_list_restaurar'] as $id){

                $idaux=md5($id);
                $query = "UPDATE requisitos SET ativo = 's' WHERE md5(id_requisito) = '$idaux';";
                $resultado2 = mysqli_query($conecta, $query);
                if ($resultado2 == true )$aux++;

            }

            if ( $aux>0 ){
                header("location: ../../front/requisitos/requisitos.php?proj=".$_POST['restaura']."&sucesso=1&pagina=1"); die();
            }

            else{
                header("location: ../../front/requisitos/requisitos.php?proj=".$_POST['restaura']."&sucesso=5&pagina=6"); die();
            }

        }
    }

?>