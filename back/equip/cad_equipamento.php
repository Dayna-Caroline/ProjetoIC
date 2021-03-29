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


$resultado = mysqli_query($conecta, $sql);
    if ( mysqli_num_rows($resultado) > 0 )
    {        
        header("location: ../front/empresa.php?success=2");
    }else
    {
        $sql = "INSERT INTO equipamentos VALUES(null,'$descricao','$marca','$fabricante','$tipo','$modelo','$tensao','$consumo','$classe','$empresa')";
        if (mysqli_query($conecta, $sql)) {
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../front/equip/equipamentos.php?pagina=1'>";
        } else {
            header("location: ../front/empresa.php?success=1");
        }
    }
    mysqli_close($conecta);
?>