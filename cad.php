<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
   
    <title>Cadastre-se</title>
</head>
<body>
    <center>
        <?php 

        if($_POST['cnpj']!= NULL)
        {
            $local= $_SERVER['PHP_SELF'];
            include "conexao_local.php";
            $razao=$_POST['razao'];
            $fantasia=$_POST['fantasia'];
            $cep=$_POST['cep'];
            $endereco=$_POST['endereco'];
            $bairro=$_POST['bairro'];
            $num=$_POST['num'];
            
            if($_POST['complemento']==" ")
            {
                $complemento=null;
            }
            else 
                $complemento=$_POST['complemento'];
            
            $cidade=$_POST['cidade'];
            $uf=$_POST['uf'];
            $cnpj=$_POST['cnpj'];
            $ie=$_POST['ie'];
            $cnae=$_POST['cnae'];
            $ativo=$_POST['sit'];
            $senha=$_POST['senha'];
            $senha=md5($senha);

            $sql = "INSERT INTO empresa VALUES( nextval('id_empresa'), '$razao', '$fantasia', '$cep','$endereco','$num','$bairro', '$complemento', '$cidade', '$uf', '$cnpj','$ie', '$cnae','$ativo','$senha');";
                        $resultado=pg_query($conecta,$sql);
                        $linhas=pg_affected_rows($resultado);
                        
//                        exit();
                        if($linhas > 0)
                        {
                            echo "<script type='text/javascript'>alert('Cadastro feito com sucesso!')</script>";
                            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cad.php'>";
                   
            
                        pg_close($conecta);
                    }
         }
                ?>

                <h1>Cadastre-se </h1>
                <form class="cadastro "  id="cadastro" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return verifica_senha(senha)">
                <label align="left" for="razao">Razão Social: *</label>
                    <input class="insere" type="text" name="razao" id="razao"  required>
                    <br>
                    <label align="left" for="fantasia">Fantasia *</label>
                    <input class="insere" type="text" name="fantasia" id="fantasia"required>
                    <br>
                    <label align="left" for="cep">CEP *</label>
                    <input class="insere" type="text" name="cep" id="cep" size="9" required/>
                    <br>
                    <label align="left" for="cidade">Cidade *</label>
                    <input class="insere" type="text" name="cidade" id="cidade" required>
                    <br>
                    <label align="left" for="uf">UF *</label>
                    <input class="insere" type="text" name="uf" id="uf" required>
                    <br>
                    <label align="left" for="endereco">Endereço *</label>
                    <input class="insere" type="text" name="endereco" id="endereco" required>
                    <br>
                    <label align="left" for="bairro">Bairro*</label>
                    <input class="insere" type="text" name="bairro" id="bairro"  required>
                    <br>
                    <label align="left" for="numero">Numero *</label>
                    <input class="insere" type="text" name="num" id="num" size="5" required>
                    <br>
                    <label align="left" for="complemento">Complemento </label>
                    <input class="insere" type="text" name="complemento" id="complemento" size="20" >
                    <br>
                   
                    <label align="left" for="cnpj">CNPJ *</label>
                    <input class="insere" type="text" name="cnpj" id="cnpj" size="18" required/>
                    <br>
                    <label align="left" for="cnpj">IE *</label>
                    <input class="insere" type="text" name="ie" id="ie"size="16" required/>
                    <br>
                    <label align="left" for="cnae">CNAE *</label>
                    <input class="insere" type="text" name="cnae" id="cnae" size="10" required/>
                    <br>
                    <label align="left" for="sit">Situação *</label>
                    <p align="left">
                    <input   type="radio" name="sit" value="s"checked>&nbsp;Ativo
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        <input  type="radio" name="sit" value="n">&nbsp;Inativo
                        </p>
                        <br>
                        <label align="left" for="senha">Senha *</label>
                    <input class="insere" type="password" name="senha" id="senha" size="50" required>
                    <br>
                    <br>
                        <label align="left" for="senha">Confirma senha *</label>
                    <input class="insere" type="password" name="senha2" id="senha" required>
                    <br>
                    <center>
                        <input align="center" type="submit" class="btn border2 border222" id="enviar">
                    </center>
                </form>
       
        
    </center>

</body>
</html>

<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script src="js/jquery-1.2.6.pack.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput-1.1.4.pack.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
    

function verifica_senha(senha)
{
    if(document.getElementById('senha').value !== document.getElementById('senha2').value)
        {
            alert('Senhas diferentes! Por favor, confirme sua senha novamente');
            document.getElementById('senha2').focus();
            return false;
        }
        
}

	$(document).ready(function()
    {	
		$("#cnpj").mask("99.999.999/9999-99");
        $("#cep").mask("99.999-999");
        $("#ie").mask("999.999.999/9999"); 
        $("#cnae").mask("9999-9/99");
	});

    $("#cep").blur(function(){
				// Remove tudo o que não é número para fazer a pesquisa
				var cep = this.value.replace(/[^0-9]/, "");
				
				// Validação do CEP; caso o CEP não possua 8 números, então cancela
				// a consulta
				if(cep.length != 8){
					return false;
				}
				
				// A url de pesquisa consiste no endereço do webservice + o cep que
				// o usuário informou + o tipo de retorno desejado (entre "json",
				// "jsonp", "xml", "piped" ou "querty")
				var url = "https://viacep.com.br/ws/"+cep+"/json/";
				
				// Faz a pesquisa do CEP, tratando o retorno com try/catch para que
				// caso ocorra algum erro (o cep pode não existir, por exemplo) a
				// usabilidade não seja afetada, assim o usuário pode continuar//
				// preenchendo os campos normalmente
				$.getJSON(url, function(dadosRetorno){
					try{
						// Preenche os campos de acordo com o retorno da pesquisa
						$("#endereco").val(dadosRetorno.logradouro);
						$("#bairro").val(dadosRetorno.bairro);
						$("#cidade").val(dadosRetorno.localidade);
						$("#uf").val(dadosRetorno.uf);
					}catch(ex){}
				});
			});

    



    </script>