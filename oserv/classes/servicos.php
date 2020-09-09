<?php

header("content-type: text/html;charset=utf-8");

Class Servico {
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

	public function cadastrar($nome_cliente, $contato_cliente, $marca_carro, $modelo_carro, $cor_carro, $tipo_servico, $descricao_servico, $valor_servico) {
		global $pdo;
			//cadastrar novo serviço
			$sql = $pdo->prepare("INSERT INTO tb_servicos (nome_cliente, contato_cliente, marca_carro, modelo_carro, cor_carro, tipo_servico, descricao_servico, valor_servico) VALUES (:nc, :cc,  (SELECT id_marca_carro FROM tb_marcas_carro WHERE marca_carro = :ma), (SELECT id_modelo_carro FROM tb_modelos_carro WHERE modelo_carro = :mo), UPPER(:cor), (SELECT id_reparo FROM tb_reparos WHERE tipo_reparo = :ts), :ds, :vs)");
			$sql->bindValue(":nc", $nome_cliente);
			$sql->bindValue(":cc", $contato_cliente);
			$sql->bindValue(":ma", $marca_carro);
			$sql->bindValue(":mo", $modelo_carro);
			$sql->bindValue(":cor", $cor_carro);
			$sql->bindValue(":ts", $tipo_servico);
			$sql->bindValue(":ds", $descricao_servico);
			$sql->bindValue(":vs", $valor_servico);
			$sql->execute();
			return true; //cadastrado com sucesso
	}
}

?>