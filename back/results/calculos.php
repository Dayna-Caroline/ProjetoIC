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
?>