<?php

header("content-type: text/html;charset=utf-8");

Class Reparo {
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

	public function cadastrar($tipo_reparo) {
		global $pdo;
		//verificar se o tipo de reparo já está cadastrado
		$sql = $pdo->prepare("SELECT id_reparo FROM tb_reparos WHERE tipo_reparo = :tr");
		$sql->bindValue(":tr", $tipo_reparo);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			return false; //já está cadastrado
		} else { //caso não, CADASTRAR

			//cadastrar novo tipo de reparo
			$sql = $pdo->prepare("INSERT INTO tb_reparos (tipo_reparo) VALUES (UPPER(:tr))");
			$sql->bindValue(":tr", $tipo_reparo);
			$sql->execute();
			return true; //cadastrado com sucesso
		}

	}
}

?>