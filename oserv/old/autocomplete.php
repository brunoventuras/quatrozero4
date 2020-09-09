<?php
	//$mysqli = mysqli_connect("localhost","root","","db_angelo") or die("database error");
	$mysqli = mysqli_connect("db_angelo.mysql.dbaas.com.br","db_angelo","admin@123","db_angelo") or die("database error");

	$preencher = $_GET['preencher'];
	$getData = $_GET['term'];	

	if ($preencher == "marca") {
		$query = $mysqli->query("SELECT marca_carro FROM tb_marcas_carro WHERE marca_carro LIKE'%".strtoupper($getData)."%';");

		while ($row = $query->fetch_assoc()) {
			$data[] = strtoupper($row['marca_carro']);
		}
	}

	if ($preencher == "modelo") {
		$marca = $_GET['marca'];
		$query = $mysqli->query("SELECT modelo_carro FROM tb_modelos_carro AS mo
									JOIN tb_marcas_carro AS ma ON mo.marca_carro = ma.id_marca_carro
										WHERE ma.marca_carro = '".$marca."' AND mo.modelo_carro LIKE UPPER('%".$getData."%');");

		while ($row = $query->fetch_assoc()) {
			$data[] = strtoupper($row['modelo_carro']);
		}
	}	

	if ($preencher == "cliente") {
		$query = $mysqli->query("SELECT DISTINCT nome_cliente FROM tb_clientes WHERE nome_cliente LIKE UPPER('%".$getData."%');");

		while ($row = $query->fetch_assoc()) {
			$data[] = strtoupper($row['nome_cliente']);
		}
	}	

	if ($preencher == "reparo") {
		$query = $mysqli->query("SELECT DISTINCT tipo_reparo FROM tb_reparos WHERE tipo_reparo LIKE UPPER('%".$getData."%');");

		while ($row = $query->fetch_assoc()) {
			$data[] = strtoupper($row['tipo_reparo']);
		}
	}

	echo json_encode($data);
?>