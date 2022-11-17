<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./estilos.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;900&display=swap"
      rel="stylesheet"
    />
    <title>Cadastro</title>
  </head>
  <body>
    <div class="container">
      <div class="header">
        <h2>Criar Uma Conta</h2>
      </div>

      <form id='form' method="POST" action="" class="form"> <!-- Colocar o method que vai ser, no caso POST para ser seguro -->
        <div class="form-control">
          <label for="username">Nome de usuário</label>
          <input name="nome" type="text" id="username" placeholder="Digite seu nome de usuário..."/> <!-- criar name nos 4 inputs -->
          <i class="fas fa-exclamation-circle"></i>
          <i class="fas fa-check-circle"></i>
          <small>Mensagem de erro</small>
        </div>

        <div class="form-control">
          <label for="email">Email</label>
          <input name="email" type="text" id="email" placeholder="Digite seu email.." />
          <i class="fas fa-exclamation-circle"></i>
          <i class="fas fa-check-circle"></i>
          <small>Mensagem de erro</small>
        </div>

        <div class="form-control">
          <label for="password">Senha</label>
          <input name="senha" type="password" id="password" placeholder="Digite sua senha..."/>
          <i class="fas fa-exclamation-circle"></i>
          <i class="fas fa-check-circle"></i>
          <small>Mensagem de erro</small>
        </div>

        <div class="form-control">
          <label for="password-confirmation">Confirmação de senha</label>
          <input name="confSenha"
            type="password"
            id="password-confirmation"
            placeholder="Digite sua senha novamente..."
          />
          <i class="fas fa-exclamation-circle"></i>
          <i class="fas fa-check-circle"></i>
          <small>Mensagem de erro</small>
        </div>


        <div class="msgErro" id="msgErro">
          <h5 class='msgH1' id='msgH1'></h5>
        </div>

        <button type="submit">Enviar</button>
      </form>
    </div>




    <?php
if(!empty($_POST['nome']) AND !empty($_POST['email']) AND !empty($_POST['senha']) AND !empty($_POST['confSenha']))
{ # Se não estiver vazio, acessa aqqui
    $nome = addslashes($_POST['nome']); # transforma o input que veio do formulário em $nome
    $email = addslashes($_POST['email']); # o addslashes serve para não vir código de programação para ficar seguro
    $senha = addslashes($_POST['senha']);
    $confSenha = addslashes($_POST['confSenha']);



    require_once 'class/usuario.php'; # chama a classe
    $c = new Cadastros; # transforma a class em váriavel para ser usada
    require_once 'class/conexao.php'; # chama a conexão

        $c->conectar($dbname, $host, $usuario, $dbsenha); # pega as váriaveis da conexão para conectar ao banco
        if($c->msgErro == '') # caso o erro for vazio continua
        {
            if($c->cadastrar($nome, $email, $senha)) # manda as váriaveis dos inputs, para a classe e valida
            {
              header('Location: login.php');
            }else # se não foi cadastrado traz para essa tela ( caso retorne false )
            {
              ?>

              <script>
                var msg = document.getElementById('msgErro');
                var msgH1 = document.getElementById('msgH1');
                msgH1.innerHTML='Usuário já cadastrado'
                msg.style.display='block'
                setTimeout(function(){
                  msg.style.display='none'
                }, 5000);
              </script>

             <?php

              
            }
        }else # se não, traz o erro
        {
            echo 'Erro: '.$l->msgErro;
        } 
        
    
}else
{

}
?>



<script
      src="https://kit.fontawesome.com/f9e19193d6.js"
      crossorigin="anonymous"
    ></script>

    <script src="./scripts.js"></script>




  </body>
</html>
