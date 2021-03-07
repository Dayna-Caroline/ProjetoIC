<?php
    session_start();
    if(!$_SESSION['cnpj']) {
        header("location: ../index.php");
        exit();
    }
?>