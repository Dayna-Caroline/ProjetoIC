<?php
//solicitação de mudança 
include "../../back/autenticacao.php";
include "../../back/conexao_local.php";

//recebe os dados do form
$req=$_POST['mudanca'];
$solicitante=$_POST['solicitante'];
$desc=$_POST['desc'];
$custo=$_POST['custo']; 
$pedido=$_POST['pedido'];
$aceite='s';

$sqlg="SELECT * FROM requisitos WHERE id_requisito='$req';";
$resultado = mysqli_query($conecta, $sqlg);
$row = mysqli_num_rows($resultado);
if ($row == 1) 
{ 
    //echo "deu bom";
    $linha = mysqli_fetch_array($resultado);
    $projeto = $linha['projeto'];
    $tipo = $linha['tipo'];
    $versao = $linha['versao'];
    $nova_versao=$versao+1;
    
}
else
{
    //echo"deu ruim";
}



$sql="INSERT INTO mudancas VALUES ( NULL,'$projeto','$pedido','$tipo','s','$solicitante','$req','$desc','$custo');";

    if (mysqli_query($conecta, $sql)) 
    {         
        
        header("location: ../../front/mudancas/hist_mud.php?pagina=1&mudanca=".$req."");
        //header("location: ../../front/projetos/projeto.php?proj=".$projeto."&pagina=1"); 
   
    } 
        
    else 
    {
        header("location: ../../front/mudancas/solic_mud.php?sucess=1");
        //header("location: ../../front/projetos/projeto.php?proj=".$projeto."&pagina=1"); 
       //       
    }


mysqli_close($conecta);
?>