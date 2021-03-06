<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>Conexão - Banco de dados</title>
</head>
<body>
    <?php
        $conecta = mysqli_connect("localhost", "root", "", "projetoic");
        if (!$conecta) {
            die("Não foi possível conectar: " . mysqli_connect_error());
        }
    ?>
</body>
</html>