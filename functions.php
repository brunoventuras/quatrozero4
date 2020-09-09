<?php
	// require_once("connections/conectar.php"); 

	  global $pdo;

  $banco   = "db_angelo";
  $host    = "db_angelo.mysql.dbaas.com.br";
  $usuario = "db_angelo";
  $senha   = "admin@123";

define('BANCO' , "mysql:host=db_angelo.mysql.dbaas.com.br;dbname=db_angelo");
define('USUARIO' , "db_angelo");
define('SENHA' , "admin@123");

try {
    $pdo = new PDO(BANCO, USUARIO, SENHA);
    $pdo->exec("set names utf8");
} catch ( PDOException $erro ) {
    echo  'Erro ao conectar com o banco de dados: ' . $erro->getMessage();
    exit(1);
}


	function dataInicio() {
    global $pdo;
		$dataIni = "SELECT DISTINCT MIN(DT_SERV) AS DT_SERV FROM SERV";
		$pdo = $pdo->prepare($dataIni);
    $pdo->execute();
    $result = $pdo->fetch();

		return $result['DT_SERV'];
	}

function getServ(){
    global $pdo;
    $arrayDados = array();
    $sql = "SELECT * FROM SERV WHERE PG IS NULL ORDER BY CD_SERV DESC";
    $pdo = $pdo->prepare($sql);
    $pdo->execute();

    while($row = $pdo->fetch(PDO::FETCH_ASSOC)) {
      $arrayDados[$row['CD_SERV']] = [$row['CD_SERV'],$row['DT_SERV'],$row['DC_CLI'],$row['DC_VEICULO'],$row['NM_SERV'],$row['VL_SERV'],$row['PLACA']];
    }

    return $arrayDados;
  }

	function getServPG(){
    global $pdo;
		$arrayDados = array();
		$sql = "SELECT * FROM SERV WHERE PG IS NOT NULL ORDER BY CD_SERV DESC";
		$pdo = $pdo->prepare($sql);
    $pdo->execute();

    while($row = $pdo->fetch(PDO::FETCH_ASSOC)) {
			$arrayDados[$row['CD_SERV']] = array($row['CD_SERV'],$row['DT_SERV'],$row['DC_CLI'],$row['DC_VEICULO'],$row['PLACA'],$row['NM_SERV'],$row['VL_SERV'],$row['PAGO_EM']);
		}
		return $arrayDados;
	}

	function fillServ($dtIni, $dtFim, $clt, $car, $serv){
    global $pdo;
		if ($clt != "") {
			$clt = " AND DC_CLI = '" .$clt. "'";
		}		
		if ($car != "") {
			$car = " AND DC_VEICULO = '" .$car. "'";
		}		
		if ($serv != "") {
			$serv = " AND NM_SERV = '" .$serv. "'";
		}
		$sql = "SELECT * FROM SERV WHERE DT_SERV BETWEEN '{$dtIni}' AND '{$dtFim}' AND PG IS NULL {$clt} {$car} {$serv} ORDER BY CD_SERV DESC";
		$pdo = $pdo->prepare($sql);
    $pdo->execute();

    while($row = $pdo->fetch(PDO::FETCH_ASSOC)) {
			$arrayDados[$row['CD_SERV']] = [$row['CD_SERV'],$row['DT_SERV'],$row['DC_CLI'],$row['DC_VEICULO'],$row['NM_SERV'],$row['VL_SERV'],$row['PLACA'],$row['PAGO_EM']];
      $arrayDados[$row['CD_SERV']] = [$row['CD_SERV'],$row['DT_SERV'],$row['DC_CLI'],$row['DC_VEICULO'],$row['NM_SERV'],$row['VL_SERV'],$row['PLACA']];
		}
		return $arrayDados;
	}

	function fillServPG($dtIni, $dtFim, $clt, $car, $serv){
    global $pdo;
		if ($clt != "") {
			$clt = " AND DC_CLI = '" .$clt. "'";
		}		
		if ($car != "") {
			$car = " AND DC_VEICULO = '" .$car. "'";
		}		
		if ($serv != "") {
			$serv = " AND NM_SERV = '" .$serv. "'";
		}
		$sql = "SELECT * FROM SERV WHERE DT_SERV BETWEEN '{$dtIni}' AND '{$dtFim}' AND PG IS NOT NULL {$clt} {$car} {$serv} ORDER BY CD_SERV DESC";
		$pdo = $pdo->prepare($sql);
    $pdo->execute();

    while($row = $pdo->fetch(PDO::FETCH_ASSOC)) {
			$arrayDados[$row['CD_SERV']] = array($row['CD_SERV'],$row['DT_SERV'],$row['DC_CLI'],$row['DC_VEICULO'],$row['PLACA'],$row['NM_SERV'],$row['VL_SERV'],$row['PAGO_EM']);
		}
		return $arrayDados;
	}

	function setServ($dtServ,$dcCli,$dcVeiculo,$placa,$nmServ,$vlServ){
    global $pdo;
		$query = "INSERT INTO SERV (DT_SERV,DC_CLI,DC_VEICULO,PLACA,NM_SERV,VL_SERV) VALUES ('{$dtServ}','{$dcCli}','{$dcVeiculo}',UPPER('{$placa}'),'{$nmServ}',{$vlServ})";
		$pdo = $pdo->prepare($query);
    $pdo->execute();

		firstUpper('SERV', 'DC_CLI');
		firstUpper('SERV', 'DC_VEICULO');
		firstUpper('SERV', 'NM_SERV');
		return $query;		
	}

	function editServ($clt, $car, $placa, $serv, $valor, $id){
    global $pdo;
		$query = "UPDATE SERV SET DC_CLI = '{$clt}', DC_VEICULO = '{$car}', PLACA = UPPER('{$placa}'), NM_SERV = '{$serv}', VL_SERV = {$valor} WHERE CD_SERV = {$id}";
		$pdo = $pdo->prepare($query);
    $pdo->execute();
		return $query;
	}

	function pgServ($serv){
    global $pdo;
		$query = "UPDATE SERV SET PG = 1, PAGO_EM = NOW() WHERE CD_SERV IN ({$serv})";
		$pdo = $pdo->prepare($query);
    $pdo->execute();
		return $query;	
	}

	function delServ($serv){
    global $pdo;
		$query = "DELETE FROM SERV WHERE CD_SERV IN ({$serv})";
    $pdo = $pdo->prepare($query);
    $pdo->execute();
		return $query;
	}

	function getCar(){
    global $pdo;
		$arrayDados = array();
		$sql = "SELECT * FROM tb_modelos_carro ORDER BY modelo_carro ASC";
    $pdo = $pdo->prepare($sql);
    $pdo->execute();

    while($row = $pdo->fetch(PDO::FETCH_ASSOC)) {
			$arrayDados[$row['id_modelo_carro']] = array($row['modelo_carro']);
		}
		return $arrayDados;
	}

	function setCar($modeloCarro){
    global $pdo;
		$query = "INSERT INTO tb_modelos_carro (modelo_carro) VALUES ('{$modeloCarro}')";
    $pdo = $pdo->prepare($query);
    $pdo->execute();
		firstUpper('tb_modelos_carro', 'modelo_carro');	
		return $query;
	}

	function editCar($modeloCarro, $id){
    global $pdo;
		$query = "UPDATE tb_modelos_carro SET modelo_carro = '{$modeloCarro}' WHERE id_modelo_carro = {$id}";
    $pdo = $pdo->prepare($query);
    $pdo->execute();
		firstUpper('tb_modelos_carro', 'modelo_carro');	
		return $query;
	}

	function delCar($modeloCarro){
    global $pdo;
		$query = "DELETE FROM tb_modelos_carro WHERE id_modelo_carro = {$modeloCarro}";
    $pdo = $pdo->prepare($query);
    $pdo->execute();
		return $query;
	}

	function getClt(){
    global $pdo;
    $arrayDados = array();
    $sql = "SELECT * FROM tb_clientes ORDER BY nome_cliente ASC";
    $pdo = $pdo->prepare($sql);
    $pdo->execute();

    while($row = $pdo->fetch(PDO::FETCH_ASSOC)) {
      $arrayDados[$row['id_cliente']] = array($row['nome_cliente'],$row['tipo_cliente']);
    }
    return $arrayDados;

	}

	function fillClt($tipo){
    global $pdo;
		$arrayDados = array();
		$sql = "SELECT * FROM tb_clientes WHERE tipo_cliente = '{$tipo}' ORDER BY nome_cliente ASC";
    $pdo = $pdo->prepare($sql);
    $pdo->execute();

    while($row = $pdo->fetch(PDO::FETCH_ASSOC)) {
			$arrayDados[$row['id_cliente']] = array($row['nome_cliente'],$row['tipo_cliente']);
		}
		return $arrayDados;
	}

	function setClt($nome, $tipo){
    global $pdo;
		$query = "INSERT INTO tb_clientes (nome_cliente, tipo_cliente) VALUES ('{$nome}', '{$tipo}')";
    $pdo = $pdo->prepare($query);
    $pdo->execute();
		firstUpper('tb_clientes', 'nome_cliente');		
		firstUpper('tb_clientes', 'tipo_cliente');
		return $query;
	}

	function editClt($nome, $tipo, $id){
    global $pdo;
		$query = "UPDATE tb_clientes SET nome_cliente = '{$nome}', tipo_cliente = '{$tipo}' WHERE id_cliente = {$id}";
    $pdo = $pdo->prepare($query);
    $pdo->execute();
		firstUpper('tb_clientes', 'nome_cliente');
		firstUpper('tb_clientes', 'tipo_cliente');
		return $query;
	}

	function delClt($cliente){
    global $pdo;
		$query = "DELETE FROM tb_clientes WHERE id_cliente = {$cliente}";
    $pdo = $pdo->prepare($query);
    $pdo->execute();
		return $query;
	}

	function getReparo(){
    global $pdo;
		$arrayDados = array();
		$sql = "SELECT * FROM tb_reparos ORDER BY tipo_reparo ASC";
    $pdo = $pdo->prepare($sql);
    $pdo->execute();

    while($row = $pdo->fetch(PDO::FETCH_ASSOC)) {
			$arrayDados[$row['id_reparo']] = array($row['tipo_reparo'],$row['id_reparo']);
		}
		return $arrayDados;
	}

	function setReparo($reparo){
    global $pdo;
		$query = "INSERT INTO tb_reparos (tipo_reparo) VALUES ('{$reparo}')";
    $pdo = $pdo->prepare($query);
    $pdo->execute();
		firstUpper('tb_reparos', 'tipo_reparo');
		return $query;
	}

	function editReparo($reparo, $id){
    global $pdo;
		$query = "UPDATE tb_reparos SET tipo_reparo = '{$reparo}' WHERE id_reparo = {$id}";
    $pdo = $pdo->prepare($query);
    $pdo->execute();
		firstUpper('tb_reparos', 'tipo_reparo');
		return $query;
	}

	function delReparo($reparo){
    global $pdo;
		$query = "DELETE FROM tb_reparos WHERE id_reparo = {$reparo}";
    $pdo = $pdo->prepare($query);
    $pdo->execute();
		return $query;
	}

	function getServicos(){
    global $pdo;
		$arrayDados = array();
		$sql = "SELECT * FROM tb_servicos";
    $pdo = $pdo->prepare($sql);
    $pdo->execute();

    while($row = $pdo->fetch(PDO::FETCH_ASSOC)) {
			$arrayDados[$row['id_servico']] = array($row['nome_cliente'],$row['tipo_cliente'],$row['marca_carro'],$row['modelo_carro'],$row['cor_carro'],$row['tipo_servico'],$row['descricao_servico'],$row['valor_servico']);
		}
		return $arrayDados;
	}

	function padrao_data($pdate) {

	  if($pdate=='0000-00-00' || $pdate=='' || is_null($pdate)){
	    return '';
	  }else{
		 return $pdate = date('d-m-Y',strtotime($pdate));	
	  }
	}

	function firstUpper($tabela, $campo) {
    global $pdo;
		$query = "UPDATE {$tabela} SET {$campo} = (SELECT CONCAT(UPPER(SUBSTRING({$campo} FROM 1 FOR 1)), LOWER(SUBSTRING({$campo} FROM 2 FOR LENGTH({$campo})))))";
    $pdo = $pdo->prepare($query);
    $pdo->execute();  
		return $query;
	}

  function getVencimento() {
    global $pdo;
    $arrayDados = array();
    $sql = "SELECT * FROM tb_financeiro WHERE CD_STATUS = 1";
    $pdo = $pdo->prepare($sql);
    $pdo->execute();

    while($row = $pdo->fetch(PDO::FETCH_ASSOC)) {
      $arrayDados[$row['CD_FINANCEIRO']] = $row;
    }
    return $arrayDados;
  }

  function getArchive() {
    global $pdo;
    $arrayDados = array();
    $sql = "SELECT * FROM tb_archive WHERE CD_ARCHIVE = 1";
    $pdo = $pdo->prepare($sql);
    $pdo->execute();

    while($row = $pdo->fetch(PDO::FETCH_ASSOC)) {
      $arrayDados = $row;
    }
    return $arrayDados;
  }
  
?>