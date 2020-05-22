<?php
	include "usuarios.php";
?>
<html>
	<head>
		<title>Cadastro de Usuários</title>
	</head>
	<body>
		<b>
		<h1>Cadastro de Usuários</h1>
<?php

	//Instancio um objeto do tipo usuarios()
	$myuser = new usuarios();
	
	//Se chegam os dados incluindo o id, mostro o form preenchido e faço a alteração
	if(isset($_POST['f_nome']) and isset($_POST['f_mail']) and isset($_POST['f_id'])){

		echo "<form method=POST action=alterar.php>";
		echo "<H2>Nome: <input type=text name=f_nome value=".$_POST['f_nome']."></H2>";
		echo "<br/>";
		echo "<H2>Email: <input type=text name=f_mail value=".$_POST['f_mail']."></H2>";
		echo "<br/>";
		echo "<input type=hidden name=f_id value=".$_POST['f_id'].">";
		echo "<input type=submit value=Enviar>";
		echo "</form>";	
	}
	//Se chegam os dados exceto o id, faço a inserção do usuário
	elseif(isset($_POST['f_nome']) and isset($_POST['f_mail']) and isset($_POST['f_senha'])){
		$myuser->setNome($_POST['f_nome']);
		$myuser->setEmail($_POST['f_mail']);
		$myuser->setSenha(md5($_POST['f_senha']));
		$myuser->insert();
		echo "<form method=POST action=".$_SERVER['PHP_SELF'].">";
		echo "<H2>Nome: <input type=text name=f_nome></H2>";
		echo "<br/>";
		echo "<H2>Email: <input type=text name=f_mail></H2>";
		echo "<br/>";
		echo "<H2>Senha: <input type=password name=f_senha></H2>";
		echo "<br/>";
		echo "<input type=submit value=Enviar>";
		echo "</form>";		
	}
	//Se nada chega o id e a senha faço o reset da senha o formulário para cadastro 
	elseif(isset($_POST['f_id'])and isset($_POST['f_senha'])){
	$myuser->setId($_POST['f_id']);
	$myuser->setSenha($_POST['f_senha']);
	$myuser->reset($_POST['f_id'],$_POST['f_senha']);
	echo "<form method=POST action=".$_SERVER['PHP_SELF'].">";
		echo "<H2>Nome: <input type=text name=f_nome></H2>";
		echo "<br/>";
		echo "<H2>Email: <input type=text name=f_mail></H2>";
		echo "<br/>";
		echo "<H2>Senha: <input type=password name=f_senha></H2>";
		echo "<br/>";
		echo "<input type=submit value=Enviar>";
		echo "</form>";
	
	}
	//Se chega somente o id faço a exclusão e mostro o formulário para cadastro
	elseif(isset($_POST['f_id'])){
		$myuser->setId($_POST['f_id']);
		$myuser->delete($_POST['f_id']);
		echo "<form method=POST action=".$_SERVER['PHP_SELF'].">";
		echo "<H2>Nome: <input type=text name=f_nome></H2>";
		echo "<br/>";
		echo "<H2>Email: <input type=text name=f_mail></H2>";
		echo "<br/>";
		echo "<H2>Senha: <input type=password name=f_senha></H2>";
		echo "<br/>";
		echo "<input type=submit value=Enviar>";
		echo "</form>";	
	}
	//Se nada chega via POST simplesmente mostro o formulário de cadastro
	else{
		echo "<form method=POST action=".$_SERVER['PHP_SELF'].">";
		echo "<H2>Nome: <input type=text name=f_nome></H2>";
		echo "<br/>";
		echo "<H2>Email: <input type=text name=f_mail></H2>";
		echo "<br/>";
		echo "<H2>Senha: <input type=password name=f_senha></H2>";
		echo "<br/>";
		echo "<input type=submit value=Enviar>";
		echo "</form>";				
	}

?>



	<p></p>
	<div>
		<table border=1>
		  <tr>
			<th width="20%">Nome</th>
			<th width="30%">Email</th>
			<th width="20%">Ações... </th>
		  </tr>
			<?php foreach($myuser->findAll() as $key=>$value):?>
		  <tr>
				<td><?php echo "$value->nome";?></td>
				<td><?php echo "$value->email";?></td>
				<td>
					<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">	
						<input type="hidden" name="f_nome" value=<?php echo "$value->nome";?>>
						<input type="hidden" name="f_mail" value=<?php echo "$value->email";?>>
						<input type="hidden" name="f_id" value=<?php echo "$value->id";?>>
						<input type="submit" value="Alterar">
					</form> 
					<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						<input type="hidden" name="f_id" value=<?php echo "$value->id";?>>
						<input type="submit" value="Excluir">
					</form>
					<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						<input type="hidden" name="f_id" value=<?php echo "$value->id";?>>
						<input type="hidden" name="f_senha" value='e10adc3949ba59abbe56e057f20f883e'>
						<input type="submit" value="Resetar senha">
					</form>	
				</td>
		  </tr>
			<?php endforeach;?>	
		</table>
	</div>
		
		</b>
	</body>
</html>