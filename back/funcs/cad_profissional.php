<?php
    //cadastro de funcionarios 
    include "../conexao_local.php";
    session_start();
    
    $nome=$_POST['nome'];
    $cpf=$_POST['cpf'];
    $rg=$_POST['rg'];
    $cep=$_POST['cep'];
    $endereco=$_POST['endereco'];
    $bairro=$_POST['bairro'];
    $num=$_POST['num'];        
    $complemento=$_POST['complemento'];
    $cidade=$_POST['cidade'];
    $uf=$_POST['uf'];
    $registro=$_POST['registro'];
    $orgao=$_POST['orgao'];
    $empresa=$_SESSION['id_empresa'];

    $sql = "SELECT * FROM profissional WHERE cpf = '$cpf' ";
    $resultado = mysqli_query($conecta, $sql);
    if ( mysqli_num_rows($resultado) > 0 )
    {        
        header("location: ../../front/funcs/cad_funcs.php?success=2");
    }else
    {
        $sql = "INSERT INTO profissional VALUES( null, '$nome', '$cpf', '$rg','$cep','$endereco','$num','$bairro', '$complemento', '$cidade', '$uf', '$registro','$orgao', '$empresa', 's');";
        if (mysqli_query($conecta, $sql)) {
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../front/funcs/funcionarios.php?pagina=1'>";
        } else {
            header("location: ../../front/funcs/cad_funcs.php?success=1");
        }
    }
    mysqli_close($conecta);


    /*Valida cpf
    $vcpf = preg_replace('/[^0-9]', '', $cpf);
    $digitoA = 0;
    $digitoB = 0;
    for($i = 0, $x = 10; $i <= 8; $i++, $x--){
        $digitoA += $vcpf[$i] * $x;
    }
    for($i = 0, $x = 11; $i <= 9; $i++, $x--){
        if(str_repeat($i, 11) == $vcpf) return false;
        $digitoB += $vcpf[$i] * $x; 
    }
    $somaA = (($digitoA%11) < 2) ? 0 : 11-($digitoA%11);
    $somaB = (($digitoB%11) < 2) ? 0 : 11-($digitoB%11); 
    if($somaA != $vcpf[9] || $somaB != $vcpf[10])*/
?>

