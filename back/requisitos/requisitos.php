<?php

    include "../autenticacao.php";
    include "../conexao_local.php";
    include "valida_requisitos.php";

    // REDIRECIONA PRA PAGINA DO NOVO REQUISITO

    if(@$_POST['novo']){
        header("location: ../../front/requisitos/cad_requisitos.php");
    }

    if(@$_POST['arquiva']){
        header("location: ../../back/requisitos/exc_requisitos.php");
    }

?>