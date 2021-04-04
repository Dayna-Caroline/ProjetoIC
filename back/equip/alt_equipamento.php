<?php
    include "../autenticacao.php";
    include "../conexao_local.php";
    
    $descricao = $_POST['descricao'];
    $marca = $_POST['marca'];
    $fabricante = $_POST['fabricante'];
    $tipo = $_POST['tipo'];
    $modelo = $_POST['modelo'];
    $tensao = $_POST['tensao'];
    $consumo = $_POST['consumo'];
    $classe = $_POST['classe'];
    $empresa = $_SESSION['id_empresa'];
    $sqlupdate= "UPDATE equipamentos set descricao='$descricao',marca='$marca',fabricante='$fabricante',tipo='$tipo',modelo='$modelo',tensao='$tensao',consumo='$consumo',classe='$classe'";
    
    if (mysqli_query($conecta, $sqlupdate)) 
            {
                header("location: ../../front/equip/equipamentos.php"); 
            }
            else
            {
                header("location: ../../front/equip/equipamentos.php?success=2");
            }
        
    mysqli_close($conecta);
?>