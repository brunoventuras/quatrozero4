<?php
	require_once 'classes/usuarios.php';
	$u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>QuatroZero4</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<div id="corpo-form">
	<h1>USUÁRIO</h1>
	<form method="POST">
		<input type="text" name="usuario" placeholder="Nome do usuário" maxlength="30" autofocus="true">
		<input type="text" name="login" placeholder="Login" maxlength="30" autofocus="true">
		<input type="password" name="senha" placeholder="Senha" maxlength="10">
		<input type="password" name="confSenha" placeholder="Confirme a Senha" maxlength="10">
		<input type="submit" value="CADASTRAR" name="btnCadastrar">
		<a href="index.php"><strong>Voltar</strong></a>
	</form>
</div>

<?php
//verificar se clicou no botão
if (isset($_POST['btnCadastrar'])) {	
	$usuario   = addslashes($_POST['usuario']);
	$login     = addslashes($_POST['login']);
	$senha     = addslashes($_POST['senha']);
	$confSenha = addslashes($_POST['confSenha']);

	//verificar se está tudo preenchido
	if ((!empty($usuario)) && (!empty($login)) && (!empty($senha)) && (!empty($confSenha))) {
		$u->conectar();
		if ($u->msgErro == "") {
			if ($senha == $confSenha) {
				if ($u->cadastrar($usuario, $login, $senha, 1)) {
					?>
						<div id="msgSucesso"><center>Usuário cadastrado com sucesso!</center></div>
					<?php
				} else {
					?>
					<div class="msgErro"><center>Usuário já cadastrado!</center></div>
					<?php
				}
			} else {
				?>
				<div class="msgErro"><center>As senhas não correspondem!</center></div>
				<?php
			}
			
		} else {
			?>
			<div><center><?php echo "Erro: ".$u->msgErro ?></center></div>
			<?php
		}
	} else {
		?>
		<div class="msgErro"><center>Preencha todos os campos!</center></div>
		<?php
	}
} else { 
	if (empty($_SERVER['HTTP_REFERER'])) {
		header("Location: index.php");
		session_start();
		$_SESSION['msgSucesso'] = "areaRestrita";
	}
}
?>
</body>
</html>