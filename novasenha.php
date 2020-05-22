<?php 
			session_start();
			$my_val =$_SESSION['val_id'];
			include "usuarios.php";
			$myuser = new usuarios();
			if(isset($_POST['f_id']) and isset($_POST['f_senha'])){
				$myuser->setId($_POST['f_id']);
				$myuser->setSenha(MD5($_POST['f_senha']));
				$myuser->reset($myuser->getId(),$myuser->getSenha());
				Header("Location:index.php");
			}
			else{
				mostra_form($_GET['id']);
			}	

	function mostra_form($id){
		echo "<html>";
		echo "<head>";
		echo "<title>Alteração de Senha</title>";
		echo "</head>";
		echo "<body>";
		echo "<b>";
		echo "<p align=center>";
		echo "<img src='imagens/login.png' height=160 width=400>";
		echo "</p>";
		echo "<div align=center>";
		echo "<form method=POST action=$_SERVER[PHP_SELF]>";
		echo "<H2>Nova Senha: <input type=password name=f_senha></H2>";
		echo "<input type=hidden name=f_id value=".$id."></H2>";
		echo "<br/>";
		echo "<input type=submit value=Enviar>";
		echo "</form>";
		echo "</div>";
		echo "</b>";
		echo "</body>";
		echo "</html>";
	}
	function pega_valor(){
		session_start();
		return $_SESSION['val_id'];
	}
?>