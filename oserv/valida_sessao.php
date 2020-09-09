<?php

if($_SESSION['login'] == null || $_SESSION['login'] == ''){
	session_destroy();
	header('../index.php');
}
?>