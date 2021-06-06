<?php
    include "../../back/autenticacao.php";
    include "../../back/conexao_local.php";

    /*Gráfico Custo final projetos---------------------------------------------------------*/
    $projeto = array();
    $custo = array();
    $ind_proj = 0;

    $sql = "SELECT * FROM projeto";
    $resultado = mysqli_query($conecta, $sql);
    $qtde = mysqli_num_rows($resultado);
    $linha=mysqli_fetch_array($resultado);

    if($qtde > 0)
    {
        for($cont=0; $cont < $qtde; $cont++)
        {
            $linha=pg_fetch_array($resultado);
            $projeto[$cont] = $linha['projeto'];
            $custo[$cont] = $linha['c_final']; 
            $ind_proj ++;
        }
    }

    ksort($projeto);
    ksort($custo);
?>