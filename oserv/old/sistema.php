<?php
	session_start();
	ob_start();
	if (!empty($_SESSION['id_usuario'])) {
		//echo "<a href='sair.php'>Sair</a>";	
	} else {
		//header("Location: index.php");
		// include_once('_topo_home.php');
		session_start();
		$_SESSION['msgSucesso'] = "areaRestrita";
	}


	include_once('classes/conectar.php'); //inclui a pagina de conexão
	
	// echo '<pre>';//abre tag de visualização
 	
	// $rs = $conn->prepare("SELECT * FROM tb_usuarios");//query

	// if($rs->execute()){ //verifica se true
	// 	while($row = $rs->fetch(PDO::FETCH_OBJ)){ //percorre a tabela conforme a consulta acima
	// 	  echo $row->id_usuario . "<br>";     //imprime os dados (aqui pode acumular os dados em um array e utilizar de outras formas)
	// 	  echo $row->nome_usuario . "<br>";
	// 	}
	// }
	
	// print_r($_SESSION);
	// echo '</pre>';

// include_once('_topo.php');
?>
<html lang="pt-br">
<div class="containerBruno">
	<link rel="stylesheet" href="css/estilo.css">
		<meta charset="utf-8">
	<title>QuatroZero4</title>

	<!-- <link rel="stylesheet" href="css/estiloMenu.css"> -->

	<input type="checkbox" id="check">
	<label for="check">
		<img src="img/ic_menu.png">
	</label>
	<nav class="navigation">
		<ul class="mainmenu">
			<li><a href="cadServicos.php"><strong>Registrar Serviços</strong></a></li>
			<li id="cadastrar"><a href="#"><strong>* Cadastrar</strong></a>
				<ul class="submenu">
					<li><a href="cadCarro.php"><strong>Carros</strong></a></li>
					<li><a href="cadCliente.php"><strong>Clientes</strong></a></li>
					<li><a href="cadReparos.php"><strong>Tipos de Reparo</strong></a></li>
					<li><a href="cadUsuario.php"><strong>Usuarios</strong></a></li>
				</ul>
			</li>
			<li><a href="sair.php"><strong>Sair</strong></a></li>
		</ul>
	</nav>
</div>
<?php
include_once('_rodape.php');
