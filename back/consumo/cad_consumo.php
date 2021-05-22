<?php

    include "../conexao_local.php";
    session_start();

    $equipamento = $_POST['equipamento'];
    $data = $_POST['data'];
    $horaini = $_POST['horainicial'];
    $horafim = $_POST['horafinal'];
    $consumo = $_POST['consumo'];
    $empresa = $_SESSION['id_empresa'];

    $sql = "INSERT INTO consumo VALUES(null,'$empresa','$equipamento','$horaini','$horafim','$dia','$consumo')";
    if (mysqli_query($conecta, $sql)) {
        header("location: ../../front/consumo/consumo.php");
    } else {
        header("location: ../../front/consumo/consumo.php?success=1");
    }
    mysqli_close($conecta);
?>