<?php
session_start();
    if(isset($_SESSION['cnpj']))
    {
        session_destroy();
        header("Location: ../index.php");
    }
?>