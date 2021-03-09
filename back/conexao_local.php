<?php
    $conecta = mysqli_connect("localhost", "root", "", "projetoic");
    if (!$conecta) {
        die("Não foi possível conectar: " . mysqli_connect_error());
    }
?>