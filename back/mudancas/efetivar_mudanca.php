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
    
}
else
{
    echo"deu ruim";
}



$sql="INSERT INTO mudancas VALUES ( NULL,'$projeto','$pedido','$tipo','s','$solicitante','$req','$desc','$custo');";

    if (mysqli_query($conecta, $sql)) 
    {       
            echo"deu bom 2";
            //header("location: ../../front/requisitos/requisitos.php?proj=".$projeto."&pagina=1"); 
           
    } 
        
    else 
    {
      echo '<script language=\"javascript\">alert(\'Não foi possível Solicitar a mudança, tente novamente em alguns minutos!\')</script>'; 
       // header("location: ../../front/requisitos/requisitos.php?proj=".$projeto."&pagina=1");        
    }


mysqli_close($conecta);
?>