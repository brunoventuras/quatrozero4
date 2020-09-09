<?php

header("content-type: text/html;charset=utf-8");

Class Cliente {
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

	public function cadastrar($nome, $contato) {
		global $pdo;
		//verificar se o cliente já está cadastrado
		$sql = $pdo->prepare("SELECT id_cliente FROM tb_clientes WHERE nome_cliente = :nc AND nome_cliente <> 'PARTICULAR'");
		$sql->bindValue(":nc", $nome);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			return false; //já está cadastrado
		} else { //caso não, CADASTRAR

			//cadastrar novo cliente
			$sql = $pdo->prepare("INSERT INTO tb_clientes (nome_cliente, contato_cliente) VALUES (UPPER(:nc), :cc)");
			$sql->bindValue(":nc", $nome);
			$sql->bindValue(":cc", $contato);
			$sql->execute();
			return true; //cadastrado com sucesso
		}

	}
}

?>