<?php

    include "../autenticacao.php";
    include "../conexao_local.php";

    //REDIRECIONAMENTO CADASTRO
    if(@$_POST['cnovo']){
        header("location: ../../front/consumo/cad_consumo.php");
    }

    if(@$_POST['caltera']){
        header("location: ../../front/consumo/escolha_consumo.php");
    }

    //DELETA SELECIONADOS
    if(@$_POST['cdelete'])
    {
        if(@$_POST['check_list']){
            $aux=0;
            foreach(@$_POST['check_list'] as $id){

                $idaux=md5($id);

                $query = "DELETE FROM consumo WHERE id_equipamento='$id' AND empresa ='{$_SESSION['id_empresa']}';";
                $resultado = mysqli_query($conecta, $query);
                if ($resultado == true )
                    $aux++;

            }
            mysqli_close($conecta);

            if ( $aux>0 ){
                header("location: ../../front/consumo/consumo.php");
            }

            else{
                header("location: ../../front/consumo/consumo.php?success=2");
            }

        }
        else
        {
            header("location: ../../front/consumo/consumo.php?success=2");
        }
    }

?>