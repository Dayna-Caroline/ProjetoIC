<?php

    include "../autenticacao.php";
    include "../conexao_local.php";
    include "valida_requisitos.php";

    // REDIRECIONA PRA PAGINA DO NOVO REQUISITO
    
    // sucesso = 1: operação bem sucedida; sucesso = 2: erro na alteração; sucesso = 3: erro de preenchimento dos campos;
    // sucesso = 4: erro na conclusão; sucesso = 5: erro na exclusão;

    if(@$_POST['novo']){
        header("location: ../../front/requisitos/cad_requisitos.php?proj=".$_POST['novo'].""); die();
    }

    // CADASTRA REQUISITO

    if(@$_POST['cadastra']){

        $id=$_POST['cadastra'];

        $sql = "SELECT id_projeto, custo FROM projeto WHERE md5(id_projeto) = '$id';";
        $resultado = mysqli_query($conecta, $sql);
        $linha=mysqli_fetch_array($resultado);
        $custo_proj=$linha['custo'];
        $projeto=$linha['id_projeto'];

        verifica_erro_cad($_POST['descricao'],$_POST['titulo'],$_POST['processo'],$_POST['tipo'],md5($projeto),$_POST['custo']);

        $descricao=$_POST['descricao'];
        $titulo=$_POST['titulo'];
        $processo=$_POST['processo'];
        $cadastro=date("Y-m-d");
        $versao='1';
        $tipo=$_POST['tipo'];
        $custo=$_POST['custo'];

        $custo_proj+=$custo;
        $query = "UPDATE projeto SET custo = '$custo_proj' WHERE md5(id_projeto) = md5('$projeto');";
        
        if(mysqli_query($conecta, $query)){
            $sql2 = "INSERT INTO requisitos VALUES( null, '$projeto', '$titulo', '$processo', '$cadastro', '$custo', '$versao', '$descricao', '$tipo', 's');";
                
            if (mysqli_query($conecta, $sql2)) 
            { 
                header("location: ../../front/requisitos/requisitos.php?proj=".$id."&pagina=1&s=1"); die();       
            } 
            
            else 
            {
                header("location: ../../front/requisitos/cad_requisitos.php?proj=".$id."&s=2"); die();      
            } 
        } 
        else 
        {
            header("location: ../../front/requisitos/cad_requisitos.php?proj=".$id."&s=2"); die();      
        }

        mysqli_close($conecta);

    }

    // EXCLUI REQUISITO

    if(@$_POST['arquiva']){

        $id_proj=$_POST['arquiva'];
 
        if(@$_POST['check_list']){
    
            foreach(@$_POST['check_list'] as $id){
    
                $idaux=md5($id);

                $sql = "SELECT id_projeto, custo FROM projeto WHERE md5(id_projeto) = '$id_proj';";
                echo $sql;
                $resultado = mysqli_query($conecta, $sql);
                $linha=mysqli_fetch_array($resultado);
                $custo_proj=$linha['custo'];

                $sql2 = "SELECT custo FROM requisitos WHERE md5(id_requisito) = '$idaux';";
                echo $sql2;  
                $resultado2 = mysqli_query($conecta, $sql2);
                $linha2=mysqli_fetch_array($resultado2);
                $custo=$linha2['custo'];

                $custo_proj=(float)$custo_proj-(float)$custo;
                $query2 = "UPDATE projeto SET custo = '$custo_proj' WHERE md5(id_projeto) = '$id_proj';";
                echo $query2;

                if(mysqli_query($conecta, $query2)){
                    $query = "UPDATE requisitos SET ativo = 'n' WHERE md5(id_requisito) = '$idaux';";
                    $resultado = mysqli_query($conecta, $query);
                    if ($resultado == true )$aux++;else $aux=0;  
                }
                else{
                    $aux=0;
                }
                
            }
    
            if ( $aux>0 ){
                header("location: ../../front/requisitos/requisitos.php?proj=".$_POST['arquiva']."&pagina=1&s=8"); die();
            }
    
            else{
                header("location: ../../front/requisitos/requisitos.php?proj=".$_POST['arquiva']."&pagina=1&s=5"); die();
            }
    
        }
    
        else{
    
            $idaux=md5($_POST['arquiva']);

            $sql = "SELECT projeto, custo FROM requisitos WHERE md5(id_requisito) = '$idaux';";
            $resultado = mysqli_query($conecta, $sql);
            $linha=mysqli_fetch_array($resultado);
            $projeto=md5($linha['projeto']);
            $custo=$linha['custo'];

            $sql2 = "SELECT custo FROM projeto WHERE md5(id_projeto) = '$projeto';";
            $resultado2 = mysqli_query($conecta, $sql2);
            $linha2=mysqli_fetch_array($resultado2);

            $custo_proj=$linha2['custo']-$custo;
            $query2 = "UPDATE projeto SET custo = '$custo_proj' WHERE md5(id_projeto) = '$projeto';";
                
            if(mysqli_query($conecta, $query2)){
                $query = "UPDATE requisitos SET ativo = 'n' WHERE md5(id_requisito) = '$idaux';";
                $resultado = mysqli_query($conecta, $query);
        
                if ( $resultado == true ){
                    header("location: ../../front/requisitos/requisitos.php?proj=".$projeto."&pagina=1&s=8"); die();
                }
        
                else{
                    header("location: ../../front/requisitos/requisito.php?id=".$projeto."&s=5"); die();
                }
            }
            else{
                header("location: ../../front/requisitos/requisito.php?id=".$projeto."&s=5"); die();
            }
    
        }

        mysqli_close($conecta);
                  
    }

    // ALTERA REQUISITO

    if(@$_POST['altera']){

        $id=md5($_POST['altera']);

        $sql3 = "SELECT projeto, custo FROM requisitos WHERE md5(id_requisito) = '$id';";
        echo $sql3;

        $resultado3 = mysqli_query($conecta, $sql3);
        $linha3=mysqli_fetch_array($resultado3);
        $projeto=md5($linha3['projeto']);
        $custo_antes=$linha3['custo'];

        $sql2 = "SELECT custo FROM projeto WHERE md5(id_projeto) = '$projeto';";
        echo $sql2;
        $resultado2 = mysqli_query($conecta, $sql2);
        $linha2=mysqli_fetch_array($resultado2);
        $custo_proj=(float)$linha2['custo']-(float)$custo_antes;

        $query2 = "UPDATE projeto SET custo = '$custo_proj' WHERE md5(id_projeto) = '$projeto';";
        echo $query2;
        if(mysqli_query($conecta, $query2)){

            verifica_erro_alt($_POST['descricao'],$_POST['titulo'],$_POST['processo'],$_POST['tipo'],$id,$projeto, $_POST['custo']);

            $descricao=$_POST['descricao'];
            $titulo=$_POST['titulo'];
            $processo=$_POST['processo'];
            $custo=$_POST['custo'];
            $tipo=$_POST['tipo'];

            $custo_proj=(float)$custo_proj+(float)$custo;
            $query3 = "UPDATE projeto SET custo = '$custo_proj' WHERE md5(id_projeto) = '$projeto';";
            echo $query3;
            if(mysqli_query($conecta, $query3)){
                $sql = "UPDATE requisitos SET descricao = '$descricao', titulo = '$titulo', processo = '$processo', tipo = '$tipo', custo = '$custo' WHERE md5(id_requisito) = '$id';";
                echo $sql;
                if (mysqli_query($conecta, $sql))
                { header("location: ../../front/requisitos/requisito.php?id=".$id."&s=1");  die(); 
                } 
                    
                else 
                {
                    header("location: ../../front/requisitos/requisito.php?id=".$id."&s=2");  die();
                } 
            }
            else{
                header("location: ../../front/requisitos/requisito.php?id=".$id."&s=2");  die(); 
            }
        }
        else{
            header("location: ../../front/requisitos/requisito.php?id=".$id."&s=2");  die(); 
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

                $query = "SELECT projeto, custo FROM requisitos WHERE md5(id_requisito) = '$idaux';";
                $resultado = mysqli_query($conecta, $query);
                $linha=mysqli_fetch_array($resultado);
                $custo=$linha['custo'];
                $projeto=md5($linha['projeto']);

                $query3 = "SELECT custo FROM projeto WHERE md5(id_projeto) = '$projeto';";
                $resultado3 = mysqli_query($conecta, $query3);
                $linha3=mysqli_fetch_array($resultado3);
                $custo_proj=(float)$linha3['custo']+(float)$custo;
                
                $query4 = "UPDATE projeto SET custo = '$custo_proj' WHERE md5(id_projeto) = '$projeto';";
                if(mysqli_query($conecta, $query4)){
                    $query2 = "UPDATE requisitos SET ativo = 's' WHERE md5(id_requisito) = '$idaux';";
                    $resultado2 = mysqli_query($conecta, $query2);
                    if ($resultado2 == true )$aux++;else $aux=0;
                }
                else{
                    $aux=0;
                }

            }

            if ( $aux>0 ){
                header("location: ../../front/requisitos/restaurar.php?proj=".$_POST['restaura']."&s=9&pagina=1"); die();
            }

            else{
                header("location: ../../front/requisitos/restaurar.php?proj=".$_POST['restaura']."&s=6&pagina=1"); die();
            }

        }
    }

?>