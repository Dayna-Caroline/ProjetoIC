<?php
    include "../../back/conexao_local.php";

    $id_empresa = $_SESSION['id_empresa'];
    
    if(isset($_GET['pesq']))
    {
        $tipo_pesq = $_GET['pesq'];
    }
    else
    {
        $tipo_pesq = 1;
    }


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
    $mesconpequip = 0;
    $ind_conequip = 0;

    $sql1 = "SELECT * FROM consumo WHERE empresa = ".$id_empresa." ORDER BY dia DESC";
    $resultado = mysqli_query($conecta, $sql1);
    $qtde = mysqli_num_rows($resultado);
    if($qtde > 0)
    {
        $linha=mysqli_fetch_array($resultado);
        list($ano, $mes, $dia) = explode('-', $linha['dia']);         
        $auxconpequip = $ano;
        $mesconpequip = $mes;
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
            if($ano == $auxconpequip && $mes == $mesconpequip){
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
    $conant = array();
    $condep = array();
    $conano = array();
    $auxantot = 0;
    $auxdeptot = 0;
    $auxpos = 0;
    $test = 0;
    $ind_equip = 0;

    $sql = "SELECT * FROM consumo WHERE empresa = ".$id_empresa." ORDER BY dia ASC";
    $resultado = mysqli_query($conecta, $sql);
    $qtde = mysqli_num_rows($resultado);
    if($qtde > 0)
    {
        $linha=mysqli_fetch_array($resultado);
        list($ano, $mes, $dia) = explode('-', $linha['dia']);         
        $conano[0] = $ano;
    }

    $sql = "SELECT * FROM consumo WHERE empresa = ".$id_empresa." ORDER BY dia ASC";
    $resultado = mysqli_query($conecta, $sql);
    $qtde = mysqli_num_rows($resultado);
    if($qtde > 0)
    {
        for($cont=0; $cont < $qtde; $cont++)
        {
            $linha=mysqli_fetch_array($resultado);
            list($ano, $mes, $dia) = explode('-', $linha['dia']);
            if($ano == $conano[$auxpos]){
                if($linha['fase'] == 1){
                    $auxantot += $linha['consumo'];
                }else{
                    $auxdeptot += $linha['consumo'];
                }
            }else{                
                $auxantot = 0;
                $auxdeptot = 0;
                $auxpos++;

                $conano[$auxpos] = $ano;

                if($linha['fase'] == 1){
                    $auxantot += $linha['consumo'];
                }else{
                    $auxdeptot += $linha['consumo'];
                }
            }
            $conant[$auxpos] = $auxantot;
            $condep[$auxpos] = $auxdeptot;
        }
    }

    ksort($conano); 
    ksort($conant);
    ksort($condep);

?>