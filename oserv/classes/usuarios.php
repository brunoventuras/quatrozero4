<?php
// include_once('conectar.php');
Class Usuario {
	private $pdo;
	public $msgErro = "";

	public function conectar() {
		global $pdo;

		$banco   = "db_angelo";
		$host    = "db_angelo.mysql.dbaas.com.br";
		$usuario = "db_angelo";
		$senha   = "admin@123";

		try {
			$pdo = new PDO("mysql:dbname=".$banco.";host=".$host,$usuario,$senha);
		} catch (PDOException $e) {
			$msgErro = $e->getMessage();
		}
	}

	public function cadastrar($usuario, $login, $senha, $privilegio) {
		global $pdo;
		//verificar se já existe usuário cadastrado
		$sql = $pdo->prepare("SELECT id_usuario FROM tb_usuarios WHERE login = :u");
		$sql->bindValue(":u", $login);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			return false; //já está cadastrado
		} else {
		//caso não, CADASTRAR
			$sql = $pdo->prepare("INSERT INTO tb_usuarios (nome_usuario, login, senha, privilegio) VALUES (UPPER(:u), :l, :s, :p)");
			$sql->bindValue(":u", $usuario);			
			$sql->bindValue(":l", $login);
			$sql->bindValue(":s", md5($senha));			
			$sql->bindValue(":p", $privilegio);
			$sql->execute();
			return true; //cadastrado com sucesso
		}

	}

	public function acessar($login, $senha) {
		global $pdo;
		//verificar se o usuário está cadastrado e a senha correta
		$sql = $pdo->prepare("SELECT id_usuario FROM tb_usuarios WHERE login = :l AND senha = :s");
		$sql->bindValue(":l", $login);
		$sql->bindValue(":s", md5($senha));
		$sql->execute();
		if ($sql->rowCount() > 0) {
		//se sim, entrar no sistema (sessão)
			$dados = $sql->fetch();
			session_start();
			$_SESSION['id_usuario'] = $dados['id_usuario'];
			return true; //login successfull
		} else {
			return false; //não foi possível logar
		}
	}
}

?>