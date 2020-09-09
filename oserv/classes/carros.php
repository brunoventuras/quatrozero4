<?php

Class Carro {
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

	public function cadastrar($marca, $modelo) {
		global $pdo;
		//verificar se o carro já está cadastrado (marca & modelo)
		$sql = $pdo->prepare("SELECT mo.id_modelo_carro FROM tb_modelos_carro AS mo 
								JOIN tb_marcas_carro AS ma on mo.marca_carro = ma.id_marca_carro 
									WHERE mo.modelo_carro = UPPER(:mo) 
										AND ma.marca_carro = UPPER(:ma);");
		$sql->bindValue(":mo", $modelo);
		$sql->bindValue(":ma", $marca);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			return false; //já está cadastrado
		} else { //caso não, CADASTRAR

			//verificar se a marca já está cadastrada
			$sql = $pdo->prepare("SELECT id_marca_carro FROM tb_marcas_carro WHERE marca_carro = :ma");
			$sql->bindValue(":ma", $marca);
			$sql->execute();
			if ($sql->rowCount() < 1) {
				//cadastrar nova_marca
				$sql = $pdo->prepare("INSERT INTO tb_marcas_carro (marca_carro) VALUES (UPPER(:ma))");
				$sql->bindValue(":ma", $marca);
				$sql->execute();
			}

			//localizar id_marca_carro
			$sql = $pdo->prepare("SELECT id_marca_carro FROM tb_marcas_carro WHERE marca_carro = :ma");
			$sql->bindValue(":ma", $marca);
			$sql->execute();
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
				$marca = $row['id_marca_carro'];
			}

			//cadastrar novo modelo
			$sql = $pdo->prepare("INSERT INTO tb_modelos_carro (marca_carro, modelo_carro) VALUES (UPPER(:ma), UPPER(:mo))");
			$sql->bindValue(":ma", $marca);
			$sql->bindValue(":mo", $modelo);
			$sql->execute();
			return true; //cadastrado com sucesso
		}

	}
}

?>