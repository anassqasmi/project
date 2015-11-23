<?php 
session_start();
if (!isset($_SESSION))
  {
    
  } ?>

<?php

include ("../Actions/Authentification.php");
include ("../Actions/CategoriesActions.php");
include ("../Actions/TagsActions.php");
include ("../Actions/TachesActions.php");
include ("../Actions/GroupeActions.php");

switch ($_GET['fun'])
{
	case 'terTache' :
		terminerTache();
	case 'addGroupes' :
		addGroup();
		break;
	case 'auth' : 
		auth();
		break;
	case 'inscription' :
		inscription();
		break;
	case 'addCategorie' :
		addCategorie();
		break;
	case 'ModCategorie' :
		modCategorie();
		break;
	case 'deleteCategorie' :
		deleteCategorie();
		break;
	case 'addTag' :
		addTag();
		break;
	case 'ModTag' :
		modTag();
		break;
	case 'deleteTag' :
		deleteTag();
		break;
	case 'addTache' :
		addTaches();
		break;
	case 'modTache' :
		modTaches();
		break;
	case 'modTache2' :
		modTaches2();
		break;
	case 'deleteTache' :
		deleteTaches();
		break;
	case 'dec' :
		deconnecter();
		break;
	case 'deleteGroupes' :
		deleteGroupes();
		break;
	case 'modGroupes' :
		modGroupes();
		break;
	case 'opt' :
		option();
		break;
}

function terminerTache()
{
	if (isset($_GET['id']) && !empty($_GET['id']) )
	{
		changerStatu($_GET['id']);
	}
}

function option()
{
	if (isset($_POST['nom']) && !empty($_POST['nom']) && 
			isset($_POST['email']) && !empty($_POST['email']) &&
			isset($_POST['prenom']) && !empty($_POST['prenom']) &&
			isset($_POST['pwd1']) && !empty($_POST['pwd1']) &&
			isset($_POST['pwd2']) && !empty($_POST['pwd2']))
	{
		
		deleteUser($_SESSION['uid']);
		saveUser($_POST['nom'], $_POST['prenom'], $_POST['pwd1'], $_POST['email'], $_SESSION['utype'] , '../Ressources/Photo/face.jpg');
		deconnecter();
	}else{
		echo '<script type="text/javascript">'
				, 'document.location.replace("../View/Options.php);'
				, '</script>';
		exit();
	}
}

function deconnecter()
{
	session_destroy();
	unset($_SESSION);
	echo '<script type="text/javascript">'
			, 'document.location.replace("../Index.php");'
			, '</script>';
}

function addTag()
{
	if (isset($_POST['cat']))
	{
		if(checkTag($_POST['cat']) == 0)
		{
			saveTagg($_POST['cat']);
				
		}
	}
}

function modTag()
{
	if (isset($_POST['oldCat']) && isset($_POST['newCat']))
	{
		modTa($_POST['newCat'], $_POST['oldCat']);
		echo '<script type="text/javascript">'
				, 'document.location.replace("../View/Tags.php");'
				, '</script>';
	}else {
		echo '<script type="text/javascript">'
				, 'document.location.replace("../View/Tags.php");'
						, '</script>';
		exit;
	}
}

function deleteTag()
{
	if (isset($_POST['oldCat']))
	{
		deleteTagg($_POST['oldCat']);
	}else {
		echo '<script type="text/javascript">'
				, 'document.location.replace("../View/Tags.php");'
						, '</script>';
		exit;
	}
}
////////////////////////////// categories

function addCategorie()
{	
	if (isset($_POST['cat']))
	{
		if(checkCat($_POST['cat']) == 0)
		{
			saveCat($_POST['cat']);
			echo '<script type="text/javascript">'
					, 'document.location.replace("../View/Categories.php");'
					, '</script>';
		}else 
		{
		}
	}
	
}

function modCategorie()
{
	if (isset($_POST['oldCat']) && isset($_POST['newCat']))
	{
		modCate($_POST['newCat'], $_POST['oldCat']);
		echo '<script type="text/javascript">'
				, 'document.location.replace("../View/Categories.php");'
				, '</script>';
	}else {
		echo '<script type="text/javascript">'
				, 'document.location.replace("../View/Categories.php");'
				, '</script>';
		exit;
	}
}

function deleteCategorie()
{
	if (isset($_POST['oldCat']))
	{
		deleteCate($_POST['oldCat']);
		echo '<script type="text/javascript">'
				, 'document.location.replace("../View/Categories.php");';
	}else{
		echo '<script type="text/javascript">'
				, 'document.location.replace("../View/Categories.php");'
						, '</script>';
		exit();
	}
}
///////////////////////////// taches
function addTaches()
{
	if (isset($_POST['categorie']) && isset($_POST['tag']) && !empty($_POST['categorie']) && !empty($_POST['tag']) &&
			isset($_POST['pourQui']) && isset($_POST['tacheContenu']) && !empty($_POST['pourQui']) && !empty($_POST['tacheContenu']) &&
			isset($_POST['laDate']) && !empty($_POST['laDate'])) {
				
		addTachesAction($_POST['laDate'], $_POST['tacheContenu'], $_POST['categorie'], $_POST['tag'], $_POST['pourQui']);
		echo '<script type="text/javascript">'
				, 'document.location.replace("../View/ModifierTacheForm.php");'
				, '</script>';
	}else
	{
		echo '<script type="text/javascript">'
				, 'document.location.replace("../View/ModifierTacheForm.php");'
						, '</script>';
		exit();
	}
}

function deleteTaches()
{
	if (isset($_GET['id']))
	{
		deleteTachesAction($_GET['id']);
		echo "<script type='text/javascript'>
				document.location.replace('../View/ModifierTacheForm.php');
			</script>";
	}else {
		echo '<script type="text/javascript">'
				, 'document.location.replace("../View/ModifierTacheForm.php");'
						, '</script>';
		exit;
	}
}

function modTaches()
{
	if (isset($_GET['id']) && isset($_GET['id']) ) 
	{	
		getTache($_GET['id']);
		echo "<script type='text/javascript'>
				document.location.replace('../View/modTacheForm.php?id=1');
			</script>";
		exit;
	}else
	{
		echo '<script type="text/javascript">'
				, 'document.location.replace("../View/ModifierTacheForm.php");'
				, '</script>';
		exit();
	}
}

function modTaches2()
{
	if (isset($_POST['categorie']) && isset($_POST['tag']) && !empty($_POST['categorie']) && !empty($_POST['tag']) &&
			isset($_POST['pourQui']) && isset($_POST['tacheContenu']) && !empty($_POST['pourQui']) && !empty($_POST['tacheContenu']) &&
			isset($_POST['laDate']) && !empty($_POST['laDate']) && isset($_POST['oldId']) && !empty($_POST['oldId'])) {
				modTacheAction($_POST['oldId'], $_POST['laDate'], $_POST['tacheContenu'],
				$_POST['categorie'], $_POST['tag'], $_POST['pourQui']);
				echo '<script type="text/javascript">'
						, 'document.location.replace("../View/ModifierTacheForm.php");'
								, '</script>';
			}else
			{
				echo '<script type="text/javascript">'
						, 'document.location.replace("../View/ModifierTacheForm.php");'
								, '</script>';
				exit();
			}
}
///////////////////////////// Group

function addGroup()
{
	if (isset($_POST['Gnom']) && isset($_POST['USERsID']) && !empty($_POST['Gnom']) && !empty($_POST['USERsID'])) {
		addGr($_POST['Gnom'], $_POST['USERsID']);
		echo '<script type="text/javascript">'
				, 'document.location.replace("../View/Groupes.php");'
				, '</script>';
	}else 
	{
		echo '<script type="text/javascript">'
   			, 'document.location.replace("../View/Groupes.php");'
   			, '</script>';
		exit();
	}
}

function deleteGroupes()
{
	if (isset($_POST['Gid']) && !empty($_POST['Gid'])) {
		deleteGr($_POST['Gid']);
		echo '<script type="text/javascript">'
				, 'document.location.replace("../View/Groupes.php");'
						, '</script>';
	}else
	{
		echo '<script type="text/javascript">'
				, 'document.location.replace("../View/Groupes.php");'
						, '</script>';
		exit();
	}
}

function modGroupes()
{
	if (isset($_POST['oldGid']) && !empty($_POST['oldGid']) &&
			isset($_POST['newGnom']) && !empty($_POST['oldGid']) &&
			isset($_POST['listU']) && !empty($_POST['listU'])) {
			modGr($_POST['oldGid'], $_POST['newGnom'], $_POST['listU']);
		echo '<script type="text/javascript">'
				, 'document.location.replace("../View/Groupes.php");'
						, '</script>';
	}else
	{
		echo '<script type="text/javascript">'
				, 'document.location.replace("../View/Groupes.php");'
						, '</script>';
		exit();
	}
}
///////////////////////////// auth and inscription
function auth()
{
	if (isset($_POST['login']) && isset($_POST['passwd']) && !empty($_POST['login']) && !empty($_POST['passwd'])) {
		login($_POST['login'], $_POST['passwd']);
		
	}else 
	{
		echo '<script type="text/javascript">'
   			, 'document.location.replace("../Index.php?form=champs oblegatoire");'
   			, '</script>';
		exit();
	}
}
	
function inscription()
{
		?>
		<form style="display: hidden" action="../View/Inscription.php?form=Incorrecte Donnees" method="post" id="form">
		<input type="text" size="20" name="nomt" value="<?php echo $_POST['nom'];?>">
		<input type="text" size="20" name="prenomt" value="<?php echo $_POST['prenom'];?>">
		<input type="text" size="20" name="emailt" value="<?php echo $_POST['email'];?>">
		</form>
		<?php
	if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['pwd1']) && isset($_POST['pwd2'])
			 && isset($_POST['email']))
	{
		if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pwd1']) && 
				!empty($_POST['pwd2']) && !empty($_POST['email'])) 
		{
			   	if ($_POST['pwd1'] == $_POST['pwd2'] && (checkEmail($_POST['email']))==0)
			   	{
					saveUser($_POST['nom'], $_POST['prenom'], $_POST['pwd1'], $_POST['email'], 'etudiant', '../Ressources/Photo/face.jpg');
					echo '<script type="text/javascript">'
			   				, 'red("../Index.php?form=votre inscription a été validée");'
			   				, '</script>';
			   	}else{
			   		echo '<script type="text/javascript">'
							, 'document.getElementById("form").submit();'
			   				, '</script>';
			   	}
		}
	}
		echo '<script type="text/javascript">'
				, 'document.getElementById("form").submit();'
				, '</script>';
}