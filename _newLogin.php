<?php 
  
?>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="/fonts/FONT/css/all.css" rel="stylesheet">
  <!-- <link href="css/signin.css" rel="stylesheet"> -->
  <script src="js/jquery-3.4.1.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <link href="style.css" rel="stylesheet">

  <title>QuatroZero4</title>

<body>
  <div class=" bkgLogin">
    <div class="col-md-offset-4 col-md-4 center imgLogo">
      <img src="img/logo404p.png" class="" alt="Responsive image">
    </div>
    <div class="col-md-offset-4 col-md-4">
      <div class="col-md-offset-3 col-md-6 login">
          
        <h2 class="h2 mb-3 center">LOGIN</h2>

        <form method="POST" id="formLogin" action="_newVerificador.php">
          <div class="col-md-12 center">
            <i class="fas fa-user iLog"></i>
            <input type="text" id="login" name="login" class="inptblk" placeholder="Usuário" autofocus="">
          </div>
          <div class="col-md-12 center">
            <i class="fas fa-key iLog"></i>
            <input type="password" id="senha" name="senha" class="inptblk" placeholder="Senha">
          </div>
          <div class="col-md-12 center">
            <button type="submit" class="btnLogin"><i class="fas fa-chevron-circle-right fa-2x"></i></button>
          </div>
          <input class="btnLogin" type="hidden" name="btnEntrar" value="Entrar">
          <!-- <a href="cadUsuario.php"><center>Cadastrar usuário</center></a> -->
        </form>

        <div>
<!--           <div class="msgErro"><center>Preencha todos os campos!</center></div>
          <div id="msgSucesso"><center><?php echo "Deslogado com sucesso!"; ?></center></div> -->
        </div>

      </div>
    </div>
  </div>

</body>

