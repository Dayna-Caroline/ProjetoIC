<?php

    include "../autenticacao.php";
    include "../conexao_local.php";

    // REDIRECIONA PRA PAGINA DO NOVO REQUISITO

    if(@$_POST['novo']){
        header("location: ../../front/requisitos/cad_requisitos.php?proj=".$_POST['novo']."");
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
        $versao=$_POST['versao'];
        $tipo=$_POST['tipo'];

        $sql2 = "INSERT INTO requisitos VALUES( null, '$projeto', '$titulo', '$processo', '$cadastro', '$versao', '$descricao', '$tipo');";
                
        if (mysqli_query($conecta, $sql2)) 
        { 
            header("location: ../../front/requisitos/requisitos.php?proj=".$id."&pagina=1");        
        } 
        
        else 
        {
            echo '<script language=\"javascript\">alert(\'Não foi possível finalizar o cadastro, tente novamente em alguns minutos!\')</script>'; 
            header("location: ../../front/requisitos/requisitos.php?proj=".$id."&pagina=1");        
        }

        mysqli_close($conecta);

    }

    // EXCLUI REQUISITO

    if(@$_POST['arquiva']){
 
        if(@$_POST['check_list']){
    
            foreach(@$_POST['check_list'] as $id){
    
                $idaux=md5($id);

                $query2 = "SELECT * FROM requisitos WHERE md5(id_requisito) = '$idaux';";
                $resultado2 = mysqli_query($conecta, $query2);
                $linha=mysqli_fetch_array($resultado2);
                $projeto= md5($linha['projeto']);
    
    
                $query = "DELETE FROM requisitos WHERE md5(id_requisito) = '$idaux';";
                $resultado = mysqli_query($conecta, $query);
                if ($resultado == true )$aux++;
    
            }
    
            if ( $aux>0 ){
                header("location: ../../front/requisitos/requisitos.php?proj=".$projeto."&pagina=1");
            }
    
            else{
                echo '<script language=\"javascript\">alert(\'Não foi possível excluir os requisitos!\')</script>';
                header("location: ../../front/requisitos/requisitos.php?proj=".$projeto."&pagina=1");
            }
    
        }
    
        else{
    
            $idaux=md5($_POST['arquiva']);

            $query2 = "SELECT * FROM requisitos WHERE md5(id_requisito) = '$idaux';";
            $resultado2 = mysqli_query($conecta, $query2);
            $linha=mysqli_fetch_array($resultado2);
            $projeto= md5($linha['projeto']);
    
            $query = "DELETE FROM requisitos WHERE md5(id_requisito) = '$idaux';";
            $resultado = mysqli_query($conecta, $query);
    
            if ( $resultado == true ){
                header("location: ../../front/requisitos/requisitos.php?proj=".$projeto."&pagina=1");
            }
    
            else{
                echo '<script language=\"javascript\">alert(\'Não foi possível excluir o requisito!\')</script>';
                header("location: ../../front/requisitos/requisito.php?id=".$idaux."");
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
        { header("location: ../../front/requisitos/requisito.php?id=".$id."");} 
            
        else 
        {
            echo '<script language=\"javascript\">alert(\'Não foi possível alterar os dados do requisito!\')</script>'; 
            header("location: ../../front/requisitos/requisito.php?id=".$id."");
        } 
    
        mysqli_close($conecta);
        
    }

    // CANCELA ALTERAÇÃO NO REQUISITO

    if(@$_POST['cancela']){
        $auxid=md5($_POST['cancela']);
        { header("location: ../../front/requisitos/requisito.php?id=".$auxid."");} 
    }

?>