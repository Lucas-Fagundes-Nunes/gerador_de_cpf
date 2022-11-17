<?php
    session_start();
    if(!isset($_SESSION['id']))
    {
        header('Location: ../login.php');
        exit;
    }
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geradro de Senha</title>
    <meta name="keywords" content="Gerador de senhas, gerador password">

    <link rel="stylesheet" type="text/css" href="gerador.css">
</head>

<body>
  

    <img class="logo" src="./assets/logo.png" alt="Gerador senha logo" />
 
    <div class="container-input">
        <span>Tamanho <span id="valor"></span> caracteres</span>
        
        <input id="slider" class="slider" type="range" min="5" max="25" value="15" />

        <button id="button" class="button-cta" onclick="generatePassword()">Gerar senha</button>
    </div>

    <div id="container-password" onclick="copyPassword()" class="container-password hide">
        <span class="title">Sua senha gerada foi:</span>
        <span id="password" class="password"></span>
        <span class="tooltip">Clique na senha para copiar. 🕵️</span>
    </div>


    <div class="container-input">
        <button id="button" class="button-cta-red"><a href="../sair.php">Logout</a></button>
    </div>


    <script src="gerador.js"></script>
</body>

</html>