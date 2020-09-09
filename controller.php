<?php
  require_once('functions.php');
 	// echo '<pre>';
 	// print_r($_GET);
 	// print_r($_POST);
 	// echo '</pre>';

	if ($_GET['action']=='setServ') {
		$teste = setServ($_POST['dadosArr']['dtServ'],$_POST['dadosArr']['cliente'],$_POST['dadosArr']['mdCar'],$_POST['dadosArr']['placa'],$_POST['dadosArr']['tpServ'],$_POST['dadosArr']['vlServ']);
	}
	if ($_GET['action']=='editServ') {
		echo $teste = editServ($_POST['dadosArr'][0]['value'],$_POST['dadosArr'][1]['value'],$_POST['dadosArr'][2]['value'],$_POST['dadosArr'][3]['value'],$_POST['dadosArr'][4]['value'],$_POST['dadosArr'][5]['value']);
	}
	if ($_POST['action']=='pgServ') {
		echo $teste = pgServ($_POST['pgServ']);
	}
	if ($_POST['action']=='delServ') {
		echo $teste = delServ($_POST['delServ']);
	}
	if ($_GET['action']=='setCar') {
		$teste = setCar($_POST['dadosArr'][0]['value']);
	}
	if ($_GET['action']=='editCar') {
		echo $teste = editCar($_POST['dadosArr'][0]['value'],$_POST['dadosArr'][1]['value']);
	}
	if ($_POST['action']=='delCar') {
		echo $teste = delCar($_POST['delCar']);
	}
	if ($_GET['action']=='setClt') {
		$teste = setClt($_POST['dadosArr'][0]['value'],$_POST['dadosArr'][1]['value']);
	}
	if ($_GET['action']=='editClt') {
		echo $teste = editClt($_POST['dadosArr'][0]['value'],$_POST['dadosArr'][1]['value'],$_POST['dadosArr'][2]['value']);
	}
	if ($_POST['action']=='delClt') {
		echo $teste = delClt($_POST['delClt']);
	}
	if ($_GET['action']=='setReparo') {
		$teste = setReparo($_POST['dadosArr'][0]['value']);
	}
	if ($_GET['action']=='editReparo') {
		echo $teste = editReparo($_POST['dadosArr'][0]['value'],$_POST['dadosArr'][1]['value']);
	}
	if ($_POST['action']=='delReparo') {
		echo $teste = delReparo($_POST['delReparo']);
	}
	if ($_POST['action']=='sair') {
		// session_destroy();
		echo 'https://quatrozero4.com.br';
	}
	// if ($_POST['action']=='cdCar') {
	// 	echo 'oserv/cadCarro.php';
	// }
	// if ($_POST['action']=='cdClt') {
	// 	echo 'oserv/cadCliente.php';
	// }
	// if ($_POST['action']=='cdTpServ') {
	// 	echo 'oserv/cadReparos.php';
	// }

	if ($_POST['action']=='home') {
		echo 'home.php';
	}

  if ($_POST['action']=='fin') {
    echo 'oserv/financeiro.php';
  }
?>