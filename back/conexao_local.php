<?php
    $conecta = mysqli_connect("localhost", "eduardo", "15112003", "projetoic");
    if (!$conecta) {
        die("Não foi possível conectar: " . mysqli_connect_error());
    }
?>