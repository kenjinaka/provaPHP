<?php
	include "usuarios.php";
	
	$myuser = new usuarios();
	$myuser->setNome($_POST['f_nome']);
	$myuser->setEmail($_POST['f_mail']);
	$myuser->setId($_POST['f_id']);
	$myuser->update($_POST['f_id']);
	Header( "Location: cadastro.php" );
?>