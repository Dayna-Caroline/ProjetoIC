<?php

    function valida_responsavel($responsavel_aux)
    {   
        include "../conexao_local.php";
        $query = "SELECT id_profissional FROM profissional WHERE empresa = '{$_SESSION['id_empresa']}' AND id_profissional = '$responsavel_aux' AND profissional.ativo = 's';";
        $result = mysqli_query($conecta, $query);
        $row = mysqli_num_rows($result);

        if( $responsavel_aux == "" || $row == 0 || !$responsavel_aux )
        { return false; } else return true;
    }

    function valida_descricao($descricao_aux)
    {
        if( !$descricao_aux || strlen($descricao_aux)<10 || strlen($descricao_aux)>100 )
        { return false; } else return true;
    }

    function valida_finalidade($finalidade_aux)
    {
        if( !$finalidade_aux || strlen($finalidade_aux)<10 || strlen($finalidade_aux)>100 )
        { return false; } else return true;
    }

    function valida_orcamento($orcamento_aux)
    {
        if( !$orcamento_aux )
        { return false; } else return true;
    }

    function valida_inicio($inicio_aux)
    {
        if( !$inicio_aux )
        { return false; } else return true;
    }

    function valida_aprovacao($aprovacao_aux)
    {
        if( !$aprovacao_aux )
        { return false; } else return true;
    }

    function valida_c_final($c_final_aux)
    {
        if( !$c_final_aux )
        { return false; } else return true;
    }

    function valida_previa($previa_aux, $inicio_aux)
    {
        if( !$previa_aux || $previa_aux < $inicio_aux )
        { return false; } else return true;
    }

    function verifica_erro_alt($responsavel,$descricao,$finalidade,$orcamento,$inicio,$aprovacao,$c_final,$previa,$auxid)
    {

        $erro="";

        if(valida_responsavel($responsavel)==false){ $erro .= "_1"; }
        if(valida_descricao($descricao)==false){ $erro .= "_2"; }
        if(valida_finalidade($finalidade)==false){ $erro .= "_3"; }
        if(valida_orcamento($orcamento)==false){ $erro .= "_4"; }
        if(valida_inicio($inicio)==false){ $erro .= "_5"; }
        if(valida_aprovacao($aprovacao)==false){ $erro .= "_6"; }
        //if(valida_c_final($c_final)==false){ $erro .= "_7"; }
        if(valida_previa($previa,$inicio)==false){ $erro .= "_8"; }

        if($erro!="")
        {
            header("location: ../../front/projetos/projeto.php?id=".$auxid."&sucesso=3"."&e=".$erro.""); die(); 
        }

    }

    function verifica_erro_cad($responsavel,$descricao,$finalidade,$orcamento,$inicio,$aprovacao,$previa)
    {

        $erro="";

        if(valida_responsavel($responsavel)==false){ $erro .= "_1"; }
        if(valida_descricao($descricao)==false){ $erro .= "_2"; }
        if(valida_finalidade($finalidade)==false){ $erro .= "_3"; }
        if(valida_orcamento($orcamento)==false){ $erro .= "_4"; }
        if(valida_inicio($inicio)==false){ $erro .= "_5"; }
        if(valida_aprovacao($aprovacao)==false){ $erro .= "_6"; }
        if(valida_previa($previa,$inicio)==false){ $erro .= "_7"; }

        if($erro!="")
        {
            header("location: ../../front/projetos/cad_projeto.php?sucesso=3&e=".$erro.""); die();
        }

    }

?>