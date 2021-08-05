<?php
    $id_empresa = $_SESSION['id_empresa'];

    $sql = "SELECT * FROM projeto WHERE empresa = ".$id_empresa;
    $resultado = mysqli_query($conecta, $sql);
    $qtde = mysqli_num_rows($resultado);

    $sql3 = "SELECT * FROM consumo WHERE empresa = ".$id_empresa;
    $resultado3 = mysqli_query($conecta, $sql3);
    $qtde3 = mysqli_num_rows($resultado3);
    if($qtde == 0 && $qtde3 == 0)
    {
        header("location: ../../front/results/sem_grafico.php");
    }
?>