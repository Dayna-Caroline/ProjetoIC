<?php

 //codigo adaptado do código do eduardo 
function valida_descricao($descricao_aux)
{
    if( !$descricao_aux || strlen($descricao_aux)<10 || strlen($descricao_aux)>100 )
    { return false; } else return true;
}

function valida_orcamento($orcamento_aux)
    {
        if( !$orcamento_aux || $orcamento<0 )
        { return false; } else return true;
    }

    function valida_aprovacao($aprovacao_aux)
    {
        if( !$aprovacao_aux )
        { return false; } else return true;
    }

    function verifica_erro_cad($descricao,$orcamento,$aprovacao)
    {

        $erro="";

       
        if(valida_descricao($descricao)==false){ $erro .= "_2"; }
       
        if(valida_orcamento($orcamento)==false){ $erro .= "_4"; }
        if(valida_aprovacao($aprovacao)==false){ $erro .= "_6"; }

        if($erro!="")
        {
            header("location: ../../front/mudancas/solic_mud.php?s=3&e=".$erro.""); die();
        }

    }

?>