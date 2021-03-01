<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/login.css">
    <title>Login</title>
</head>
<body>
    <div class="tudo">
    <div class="cabecalho">
        <div class="logo">
            <a href="../index.php"><img src="../imgs/logo.png" alt="Logo da empresa" class="img-logo"></a>
            <h2>Smart Grids</h2>
        </div>
        
    </div>
    <form class="form" action="../back/login.php" method="POST">
        <h1>Faça login</h1>
        <div class="campo">
            <input type="email" name="email" placeholder="Email" value="">
        </div>
        <div class="campo">
            <input type="password" name="password" placeholder="Senha" autocomplete="off">
        </div>
        <input type="submit" name="btnLogar" value="Login">
    </form>
    </div>
</body>
</html>