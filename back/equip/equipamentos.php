<?php

    include "../autenticacao.php";
    include "../conexao_local.php";

    //REDIRECIONAMENTO CADASTRO
    if(@$_POST['enovo']){
        header("location: ../../front/equip/cad_equipamento.php");
    }

    if(@$_POST['ealtera']){
        header("location: ../../front/equip/escolha_equip.php");
    }

    //DELETA SELECIONADOS
    if(@$_POST['edelete'])
    {
        if(@$_POST['check_list']){
            $aux=0;
            foreach(@$_POST['check_list'] as $id){

                $idaux=md5($id);

                $query = "DELETE FROM equipamentos WHERE id_equipamento='$id' AND empresa ='{$_SESSION['id_empresa']}';";
                $resultado = mysqli_query($conecta, $query);
                if ($resultado == true )
                    $aux++;

            }
            mysqli_close($conecta);

            if ( $aux>0 ){
                header("location: ../../front/equip/equipamentos.php");
            }

            else{
                header("location: ../../front/equip/equipamentos.php?success=2");
            }

        }
        else
        {
            header("location: ../../front/equip/equipamentos.php?success=2");
        }
    }

?>