<?php
    include "../../back/conexao_local.php";

    $id_empresa = $_SESSION['id_empresa'];


    /*Gráfico Custo final projetos---------------------------------------------------------*/
    $projeto = array();
    $custo = array();
    $orcamento = array();
    $ind_proj = 0;

    $sql = "SELECT * FROM projeto WHERE empresa = ".$id_empresa;
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

    /*Média de consumo no último ano---------------------------------------------------------*/
    $equipamento = array();
    $auxcon = array();
    $auxconpequip = 0;
    $ind_conequip = 0;

    $sql1 = "SELECT * FROM consumo ORDER BY dia DESC";
    $resultado = mysqli_query($conecta, $sql1);
    $qtde = mysqli_num_rows($resultado);
    if($qtde > 0)
    {
        $linha=mysqli_fetch_array($resultado);
        list($ano, $mes, $dia) = explode('-', $linha['dia']);         
        $auxconpequip = $ano;
    }

    $sql2 = "SELECT consumo.*, equipamentos.descricao
            FROM consumo
            INNER JOIN equipamentos ON consumo.equipamento = equipamentos.id_equipamento AND consumo.empresa = ".$id_empresa."
            ORDER BY dia DESC";
    $resultado = mysqli_query($conecta, $sql2);
    $qtde = mysqli_num_rows($resultado);


    if($qtde > 0)
    {
        for($cont1=0; $cont1 < $qtde; $cont1++)
        {
            $linha=mysqli_fetch_array($resultado);
            list($ano, $mes, $dia) = explode('-', $linha['dia']);
            if($ano == $auxconpequip){
                $equipamento[$cont1] = $linha['descricao'];
                $auxcon[$cont1] = $linha['consumo'];
                $ind_conequip ++;
            }else{
                break;
            } 
        }
    }
    ksort($equipamento);
    ksort($auxcon); 

    /*Gráfico Antes e depois consumo---------------------------------------------------------*/
    $antequip = array();
    $antes = array();
    $depois = array();
    $ind_equip = 0;

    $sql = "SELECT * FROM consumo WHERE empresa = ".$id_empresa."ORDER BY equipamento ASC";
    $resultado = mysqli_query($conecta, $sql);
    $qtde = mysqli_num_rows($resultado);

    if($qtde > 0)
    {
        for($cont=0; $cont < $qtde; $cont++)
        {
            $linha=mysqli_fetch_array($resultado);
            $ind_equip ++;
        }
    }
?>