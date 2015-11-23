<?php 
if (!isset($_SESSION))
  {
    session_start();
  }

?>
<!DOCTYPE link PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Inscription</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<br />
<form class="login-form"
	action="../Controlor/MainControlor.php?fun=inscription" method="post">

	<div class="header">
		<h1>Inscription</h1>
		<span style="font: red;">
			<?php
			if (isset ( $_GET ['form'] ))
				echo '*'. $_GET ['form'] . "</br>";
			?>
		</span>
	</div>

	<div class="content">

		<br /> <input class="input username" type="text" size="20" name="nom"
			value="<?php echo $_POST['nomt'];?>" placeholder="nom">

		<div>
		<?php if(isset($_GET['nomTag'])) echo $_GET['nomTag'];?></div>

		<br /> <input class="input username" type="text" size="20"
			value="<?php  echo $_POST['prenomt'];?>" placeholder="prenom"
			name="prenom">

		<div>
		<?php if(isset($_GET['prenomTag'])) echo $_GET['prenomTag'];?></div>

		<br /> <input class="input password" type="password" size="20"
			placeholder="password" name="pwd1">

		<div>
		<?php if(isset($_GET['pwdTag'])) echo $_GET['pwdTag'];?></div>

		<br /> <input class="input password" type="password" size="20"
			placeholder="password" name="pwd2"><br /> <br /> <input
			class="input username" type="text" size="20"
			value="<?php if(isset($_POST['emailt'])) echo $_POST['emailt'];?>"
			placeholder="email" name="email">

		<div>
		<?php if(isset($_GET['emailTag'])) echo $_GET['emailTag'];?></div>
	</div>

	<div class="footer">
		<br /> <input type="submit" value="valider" class="button">
	</div>


</form>
</html>