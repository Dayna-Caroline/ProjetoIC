<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title> Conexão</title>
</head>
<body>
    <?php
    $conecta = pg_connect("host=localhost port=5432 dbname=teste_ic user=postgres password=fer081203");
    if (!$conecta)
    {
        echo "Não foi possível estabelecer conexão com o banco de dados!<br><br>";
        exit;
    }
    echo "deu bom";
    ?>
</body>
</html>