<?php 
  include_once('auth.php');
  $auth = new AuthT;


  $login = addslashes($_POST['login']);
  $senha = addslashes($_POST['senha']);

  if ((!empty($login)) && (!empty($senha))) {
    if ($auth->acessar($login, $senha)) {
      header("Location: home.php");
    } else {
      echo '<div class="msgErro"><center>Usuário ou senha incorretos!</center></div>';
    }
  } else {
      echo '<div class="msgErro"><center>Preencha todos os campos!</center></div>';
  }

?>
