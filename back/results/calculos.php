<?php
    include "../../back/conexao_local.php";

    /*Gráfico Custo final projetos---------------------------------------------------------*/
    $projeto = array();
    $custo = array();
    $orcamento = array();
    $ind_proj = 0;

    $sql = "SELECT * FROM projeto";
    $resultado = mysqli_query($conecta, $sql);
    $qtde = mysqli_num_rows($resultado);

    if($qtde > 0)
    {
        for($cont=0; $cont < $qtde; $cont++)
        {
            $linha=mysqli_fetch_array($resultado);
            $projeto[$cont] = $linha['descricao'];
            $orcamento[$cont] = $linha['orcamento'];
            $custo[$cont] = $linha['c_final']; 
            $ind_proj ++;
        }
    }

    ksort($projeto);
    ksort($custo);

    /*Gráfico Consumo por equipamento---------------------------------------------------------*/
    
    $equipamento = array();
    $auxconsumo = array();
    $consumo = array();
    $contotal = 0;
    $ind_equip = 0;

    if(isset($_GET['pesq']))
    {
        $tipo_pesq = $_GET['pesq'];
    }
    else
    {
        $tipo_pesq = 2021;
    }

    $sql = "SELECT * FROM consumo";
    $resultado = mysqli_query($conecta, $sql);
    $qtde = mysqli_num_rows($resultado);

    if($qtde > 0)
    {
        for($cont=0; $cont < $qtde; $cont++)
        {
            $linha=mysqli_fetch_array($resultado);
            list($ano, $mes, $dia) = explode('-', $linha['dia']);
            if($tipo_pesq == $ano){
                $equipamento[$cont] = $linha['equipamento'];
                $auxconsumo[$cont] = $linha['consumo'];
                $contotal += $linha['consumo']; 
                $ind_equip ++;
            }
        }
    }

    ksort($equipamento);
    ksort($custo);
?>