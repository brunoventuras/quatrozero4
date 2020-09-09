<?php 
// session_start();
require_once('connections/conectar.php');

Class AuthT{
  private $pdo;
  public $msgErro = "";

  public function cadastrar($usuario, $login, $senha, $privilegio) {
    global $pdo;
    $query = "SELECT id_usuario FROM tb_usuarios WHERE login = '{$login}'";
    $pdo = $pdo->prepare($query);
    $pdo->execute();

    if ($pdo->rowCount() > 0) {
      return false; //já está cadastrado
    } else {
      $senha = md5($senha);     
      $query = "INSERT INTO tb_usuarios (nome_usuario, login, senha, privilegio) VALUES (UPPER('{$usuario}'), '{$login}', '{$senha}', '{$privilegio}')";
      $pdo = $pdo->prepare($query);
      $pdo->execute();
        
      return true; 
    }

  }

  public function acessar($login, $senha) {
    global $pdo;
    $senha = md5($senha);     
    $query = "SELECT id_usuario FROM tb_usuarios WHERE login = '{$login}' AND senha = '{$senha}'";
    $pdo = $pdo->prepare($query);
    $pdo->execute();
 
    if ($pdo->rowCount() > 0) {
      $dados = $pdo->fetch();

      $_SESSION['id_usuario'] = $dados['id_usuario'];
      return true; 

    } else {
      return false; 
    }
  }
}

?>
