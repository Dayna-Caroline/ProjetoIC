<?php

    include "../conexao_local.php";
    session_start();

    $descricao = $_POST['descricao'];
    $marca = $_POST['marca'];
    $fabricante = $_POST['fabricante'];
    $tipo = $_POST['tipo'];
    $modelo = $_POST['modelo'];
    $tensao = $_POST['tensao'];
    $consumo = $_POST['consumo'];
    $classe = $_POST['classe'];
    $empresa = $_SESSION['id_empresa'];

    $sql = "INSERT INTO equipamentos VALUES(null,'$descricao','$marca','$fabricante','$tipo','$modelo','$tensao','$consumo','$classe','$empresa')";
    if (mysqli_query($conecta, $sql)) {
        header("location: ../../front/equip/equipamentos.php");
    } else {
        header("location: ../../front/equip/equipamentos.php?success=1");
    }
    mysqli_close($conecta);
?>