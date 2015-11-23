<?php

if (! isset ( $_SESSION )) {
session_start ();
}
?>

<?php

include ("../DAO/FileAccess.php");
function login($login, $passwd) {
	if (connectUser ( $login, $passwd ) == 1) {
		if ($_SESSION ['utype'] == "admin") {
			echo '<script type="text/javascript">'
				, 'document.location.replace("../View/Accueil.php");'
				, '</script>';
		}else {
			echo '<script type="text/javascript">'
						, 'document.location.replace("../View/espaceEtudiant.php");'
						, '</script>';
		}
	} else {
		echo '<script type="text/javascript">', 'document.location.replace("../Index.php?form=login passe incorrect");', '</script>';
		exit ();
	}
}
?>
