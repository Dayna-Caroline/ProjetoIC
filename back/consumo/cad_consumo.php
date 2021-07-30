<?php

    include "../conexao_local.php";
    session_start();

    $equipamento = $_POST['equipamento'];
    $data = $_POST['data'];
    $horainis = $_POST['horainicial'];
    $horaini = date('h:i A', strtotime($horainis));
    $horafims = $_POST['horafinal'];
    $horafim = date('h:i A', strtotime($horafims));
    $consumo = $_POST['consumo'];
    $empresa = $_SESSION['id_empresa'];

    $sql = "INSERT INTO consumo VALUES(null,'$empresa','$equipamento','$horaini','$horafim','$data','$consumo')";
    if (mysqli_query($conecta, $sql)) {
        header("location: ../../front/controle/consumo.php");
    } else {
        header("location: ../../front/controle/consumo.php?success=1");
    }
    mysqli_close($conecta);
?>