<?php

    include "../conexao_local.php";
    session_start();

    $empresa = $_SESSION['id_empresa'];
    $equipamento = $_POST['equipamento'];
    $horaini = date('H:i:s',strtotime($_POST['horainicial']));

    $horafim = date('H:i:s',strtotime($_POST['horafinal']));
    $dia = $_POST['data'];
    $consumo = $_POST['consumo'];
    $fase = $_POST['fase'];
    if($fase=="sim")
        $fase = 1;
    else
        $fase = 2;

    $sql = "INSERT INTO consumo VALUES(null,'$empresa','$equipamento','$horaini','$horafim','$dia','$consumo','$fase')";
    if (mysqli_query($conecta, $sql)) {
        header("location: ../../front/controle/consumo.php");
    } 
    else 
    {
        header("location: ../../front/controle/consumo.php?success=1");
    }
    mysqli_close($conecta);
?>