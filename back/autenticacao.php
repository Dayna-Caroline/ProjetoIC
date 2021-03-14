<?php
    session_start();
    if(!$_SESSION['cnpj']||!$_SESSION['id_empresa']) {
        header("location: ../index.php");
        exit();
    }
?>