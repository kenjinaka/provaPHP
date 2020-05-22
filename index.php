<?php include "usuarios.php";
			$myuser = new usuarios();
			if(isset($_POST['f_mail']) and isset($_POST['f_senha'])){
				$myuser->setEmail($_POST['f_mail']);
				$myuser->setSenha(md5($_POST['f_senha']));
				$resultado = $myuser->login();
				if($resultado > 0){
					fc_guarda_id($resultado);
					if($_POST['f_senha']=='123456'){
						$pagina = "Location:novasenha.php?id=".$resultado;
					}
					else{
						$pagina = "Location:cadastro.php?id=";
					}
					Header($pagina);
				} else {
					exibe_pagina('Login ou senha incorreto.');
				}
			} else {
				exibe_pagina('');
			}

	function exibe_pagina($mensagem){
		echo "<html>";
		echo "<head>";
		echo "<title>Login do Sistema</title>";
		echo "</head>";
		echo "<body>";
		echo "<b>";
		echo "<p align=center>";
		echo "<img src='/provaPHP/imagens/login.png' height=160 width=400>";
		echo "</p>";
		echo '<p>'.$mensagem.'</p>';
		echo "<div align=center>";
		echo "<form method=POST action=$_SERVER[PHP_SELF]>";
		echo "<H2>Email: <input type=text name=f_mail></H2>";
		echo "<br/>";
		echo "<H2>Senha: <input type=password name=f_senha></H2>";
		echo "<br/>";
		echo "<input type=submit value=Enviar>";
		echo "</form>";
		echo "</div>";
		echo "</b>";
		echo "</body>";
		echo "</html>";
	}
		function fc_guarda_id($valor){
		session_start();
		$_SESSION['val_id']=$valor;
		}
?>