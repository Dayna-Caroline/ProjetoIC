<?php

    function valida_descricao($descricao_aux)
    {
        if( !$descricao_aux || strlen($descricao_aux)<10 || strlen($descricao_aux)>100 )
        { return false; } else return true;
    }

    function valida_titulo($titulo_aux)
    {
        if( !$titulo_aux || strlen($titulo_aux)<5 || strlen($titulo_aux)>50 )
        { return false; } else return true;
    }

    function valida_processo($processo_aux)
    {
        if( !$processo_aux || strlen($processo_aux)<10 || strlen($processo_aux)>50 )
        { return false; } else return true;
    }

    function valida_tipo($tipo_aux)
    {
        if( !$tipo_aux || $tipo_aux<=0 )
        { return false; } else return true;
    }

    function verifica_erro_alt($descricao,$titulo,$processo,$tipo,$auxid,$auxproj)
    {

        $erro="";

        if(valida_descricao($descricao)==false){ $erro .= "_1"; }
        if(valida_titulo($titulo)==false){ $erro .= "_2"; }
        if(valida_processo($processo)==false){ $erro .= "_3"; }
        if(valida_tipo($tipo)==false){ $erro .= "_4"; }

        if($erro!="")
        {
            header("location: ../../front/requisitos/requisito.php?id=".$auxid."&proj=".$auxproj."&s=3"."&e=".$erro.""); die(); 
        }

    }

    function verifica_erro_cad($descricao,$titulo,$processo,$tipo,$auxproj)
    {

        $erro="";

        if(valida_descricao($descricao)==false){ $erro .= "_1"; }
        if(valida_titulo($titulo)==false){ $erro .= "_2"; }
        if(valida_processo($processo)==false){ $erro .= "_3"; }
        if(valida_tipo($tipo)==false){ $erro .= "_4"; }

        if($erro!="")
        {
            header("location: ../../front/requisitos/cad_requisitos.php?proj=".$auxproj."&s=3"."&e=".$erro.""); die();
        }

    }

?>