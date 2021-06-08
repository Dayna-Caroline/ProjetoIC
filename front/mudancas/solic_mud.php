<?php 
//solicitar mudança
 include "../../back/autenticacao.php";
 include "../../back/conexao_local.php";

 if(isset($_GET['success']))
 {
     if($_GET['success'] == 1)
     {
         echo '<script language="javascript">';
         echo "alert('Erro ao realizar a mudança, tente novamente.')";
         echo '</script>';
     }
 }

    $id_req=$_POST['mudanca'];


 $query = "SELECT * FROM requisitos WHERE id_requisito = '$id_req';";

    // executa a query

    $result = mysqli_query($conecta, $query);
    $row = mysqli_num_rows($result);

    if($row>0)
    {
        $linha = mysqli_fetch_array($result);
        $id=$linha['id_requisito'];
        $projeto=$linha['projeto'];
        $titulo=$linha['titulo'];
        $versao=$linha['versao'];
        $tipo=$linha['tipo'];
    }

$sql = "SELECT id_profissional, nome, empresa FROM profissional WHERE empresa = '{$_SESSION['id_empresa']}';";

    // executa a query

    $result = mysqli_query($conecta, $sql);
    $row = mysqli_num_rows($result);


?>


<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <link rel="stylesheet" href="../../styles/mud/menu_mud.css">
        <link rel="stylesheet" href="../../styles/mud/mud.css">
        <title>Smart Grid</title>
    </head>

    <body onload="visualizar()">

        <div class="tudo">

        <div class="aba">
                <div class="logo">
                    <a href="../../front/projetos/menu.php"><img src="../../imgs/logo.png" alt="Logo da empresa" class="img-logo"></a>
                    <h2 class="nav-text">Smart Grids</h2>
                </div>
                <ul>
                    <li class="navitem"><a href="../empresa/empresa.php"><i class="fas fa-city"></i><span class="nav-text">Empresa</span></a></li>
                    <li class="pag navitem"><a href="../projetos/menu.php?pagina=1"><i class="fas fa-stream"></i><span class="nav-text">Projetos</span></a></li>
                    <li class="navitem"><a href="../funcs/funcionarios.php?pagina=1"><i class="fas fa-users"></i><span class="nav-text">Funcionários</span></a></li>
                    <li class="navitem"><a href="../equip/equipamentos.php"><i class="fas fa-battery-three-quarters"></i><span class="nav-text">Equipamentos</span></a></li>
                    <li class="navitem"><a href="../controle/controle.php"><i class="fas fa-cogs"></i><span class="nav-text">Consumo</span></a></li>
                    <li class="navitem"><a href="../results/resultados.php"><i class="fas fa-chart-pie"></i><span class="nav-text">Resultados</span></a></li>
                </ul>
            </div>

            <div class="conteudo">

                <div  class="titulo">
                    <h1>Solicitar Mudança</h1>
                </div>
                
                
            <div class="projetos2">
            
                <form action="../../back/mudancas/efetivar_mudanca.php"  method="post">
                 <?php
                echo "<div class=\"item2\">

                                <div style=\"color:#999999;cursor:default;\" class=\"leg-id2\"><b>ID Requisito</b></div>
                                <div style=\"width:150px;cursor:not-allowed;\" class=\"item-id2\"><select style=\"cursor:not-allowed;\ name=\"id\" disabled > <option value=\"".$id_req."\">".$id_req."</option></select></div>
                                
                            </div>";
                    
                            echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b>ID Projeto</b></div>
                            <div class=\"item-id2\"><input type=\"text\" id=\"id\" onkeypress=\"alterou()\" required name=\"projeto\" disabled  value=\"".$projeto."\"> </div>
                        </div>";

                    /*echo "<div class=\"item2\">
                    <div style=\"color:#999999;cursor:default;\" class=\"leg-id2\"><b>ID Projeto</b></div>
                    <div style=\"width:150px;cursor:not-allowed;\" class=\"item-id2\"><select style=\"cursor:not-allowed;\ name=\"projeto\" disabled > <option value=\"".$projeto."\">".$projeto."</option></select></div>
                     </div>";*/
                    
                     echo "<div class=\"item2\">
                                <div class=\"leg-id2\"><b>Título</b></div>
                                <div class=\"item-id2\"><input type=\"text\" id=\"titulo\" onkeypress=\"alterou()\" required name=\"titulo\" disabled  value=\"".$titulo."\"> </div>
                            </div>";
                    
                     echo "<div class=\"item2\">
                            
                
                                <div class=\"leg-id2\" style=\"margin-right: 45px; width:150px;\"><b>Tipo</b></div>
                                <div style=\"width:140px;\" class=\"item-id2\"><input id=\"tipo\" required onkeypress=\"alterou()\" class=\"numero\" type=\"number\" name=\"tipo\" disabled value=\"".$tipo."\"></div>
                                <div class=\"leg-id2\"style=\"margin-right: 40px; width:150px;\"><b>Versão </b></div>
                                <div style=\"width:140px;\" class=\"item-id2\"><input id=\"versao\" required class=\"numero\" onkeypress=\"alterou()\" type=\"number\" name=\"versao\" disabled value=\"".$versao."\"></div>
                                
                            </div>";

                      echo "<div class=\"item2\">
                        <div class=\"leg-id2\" style=\"margin-right: 45px; width:150px;\"><b>Custo(R$)</b></div>
                        <div style=\"width:140px;\" class=\"item-id2\"><input id=\"tipo\" required onkeypress=\"alterou()\" class=\"numero\" type=\"number\" name=\"custo\">
                        </div><div class=\"leg-id2\"style=\"margin-right: 45px; width:150px;\"><b>Data da solicitação</b></div>
                        <div style=\"width:140px;\" class=\"item-id2\"><input id=\"cadastro\" onkeypress=\"alterou()\" name=\"pedido\" required  type=\"date\"></div>
                        </div>";
                    
                    echo "<div class=\"item2\">
                        <div class=\"leg-id2\"><b>Descrição </b></div>
                        <div class=\"item-id2\"><input type=\"text\" id=\"descricao\" onkeypress=\"alterou()\" required name=\"desc\"></div>
                        </div>";
                    
                   
                      echo "<div class=\"item2\">
                            <div class=\"leg-id2\"><b> Solicitante</b></div>
                            <div class=\"item-id2\">
                                <select name=\"solicitante\" style=\"cursor: pointer\" required id=\"profissional\">";

                                for($i=0;$i<$row;$i++){
                                    $linha = mysqli_fetch_array($result);
                                    echo "<option value=\"".$linha['id_profissional']."\">".$linha['id_profissional']." - ".$linha['nome']."</option>";
                                }

                                echo "</select>
                            </div>
                        </div>";  
                    

                    ?>
                  
                      <div class="botoes">
                        <button type="submit" value="<?php echo $id_req;?>" name="mudanca" class="novo" style="cursor: pointer;margin-left:300px;">Solicitar Mudança</button>
                    </div>

                   
                   
                </form>
                 </div>
             </div>