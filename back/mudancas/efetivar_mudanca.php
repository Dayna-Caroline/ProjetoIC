<?php
//solicitação de mudança 

include "../../back/autenticacao.php";
include "../../back/conexao_local.php";

 if(@$_POST['mudanca'])
 {

$req=$_POST['mudanca'];
$solicitante=$_POST['solicitante'];
$desc=$_POST['desc'];
$custo=$_POST['custo']; 
$pedido=$_POST['pedido'];

$sqlg="SELECT * FROM requisitos WHERE id_requisito='$req';";
$resultado = mysqli_query($conecta, $sqlg);
$linha=mysqli_fetch_array($resultado);
$projeto=$linha['projeto'];
$tipo=$linha['tipo'];
$versao=$linha['versao'];
$aceite="s";
$nova_versao=$versao+1;

$sql="INSERT INTO mudancas VALUES(null,'$projeto','$pedido','$tipo','$aceite','$solicitante','$req','$desc','$custo');";

 if (mysqli_query($conecta, $sql)) 
     { 
            echo"deu bom";
            //header("location: ../../front/requisitos/requisitos.php?proj=".$projeto."&pagina=1"); 
            $sql2="UPDATE requisitos SET versao='$nova_versao' WHERE id_requisito='$req';";
              if (mysqli_query($conecta, $sql2))
              {
                  echo"deu bom 2";
              }

    } 
        
else 
    {
      echo '<script language=\"javascript\">alert(\'Não foi possível Solicitar a mudança, tente novamente em alguns minutos!\')</script>'; 
       // header("location: ../../front/requisitos/requisitos.php?proj=".$projeto."&pagina=1");        
    }


 }
mysqli_close($conecta);
?>