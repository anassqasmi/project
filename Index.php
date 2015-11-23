<?php 
if (!isset($_SESSION))
	session_start();
	if (isset($_SESSION['unom']))
  	{
  		echo '<script type="text/javascript">'
  			, 'document.location.replace("View/Accueil.php");'
  			, '</script>';
  	}
?>
<!DOCTYPE html>

<html lang='en'>
<head>
    <meta charset="UTF-8" /> 
    <title>
        Welcome
    </title>
    <link rel="stylesheet" type="text/css" href="View/css/style.css" />
</head>
<body>

<div id="wrapper">

	<form name="login-form" class="login-form" action="Controlor/MainControlor.php?fun=auth" method="post">
	
		<div class="header">
		<h1>Login Form</h1>
		<span style=" font-color: red;">
			<?php 
				 if(isset($_GET['form']))
					echo $_GET['form'] . "</br>";
			?>
		</span>
		</div>
	
		<div class="content">
		<input name="login" type="text" class="input username" placeholder="Username" />
		<div class="user-icon"></div>
		<input name="passwd" type="password" class="input password" placeholder="Password" />
		<div class="pass-icon"></div>		
		</div>

		<div class="footer">
		<input type="submit" name="submit" value="Login" class="button" />
		<a class="register" href="View/Inscription.php"> inscription </a>
		</div>
	
	</form>

</div>
<div class="gradient"></div>


</body>
</html>
	
