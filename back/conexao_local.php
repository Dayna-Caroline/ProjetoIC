<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>Conexão - Banco de dados</title>
</head>
<body>
    <?php
    $conecta = pg_connect("host=localhost port=5432 dbname=teste_ic user=postgres password=dayna120704");
    if (!$conecta)
    {
        echo '<script language="javascript">';
        echo "alert('Falha na conexão com o Banco de Dados.')";
        echo '</script>';
    }
    ?>
</body>
</html>