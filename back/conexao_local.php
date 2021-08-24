<?php
    $conecta = mysqli_connect("localhost", "root", "", "projetoic2");
    if (!$conecta) {
        die("Não foi possível conectar: " . mysqli_connect_error());
    }
?>