<?php
	session_start();
	unset($_SESSION['id_usuario'], $_SESSION['nome_usuario'], $_SESSION['login'], $_SESSION['senha']);

	$_SESSION['msg'] = "<div class='alert alert-info'>Deslogado com sucesso!</div>";
	header("Location: index.php");
	session_start();
	$_SESSION['msgSucesso'] = "sair";
?>