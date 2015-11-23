<?php
if (! isset ( $_SESSION )) {
	session_start ();
}

?>
<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8" />
<title>Admin</title>

<link rel="stylesheet" href="css/layout.css" type="text/css"
	media="screen" />
<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
<script src="js/hideshow.js" type="text/javascript"></script>
<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {
		document.getElementById("fMod1").style.visibility = 'hidden';
		document.getElementById("fMod2").style.visibility = 'hidden';
		document.getElementById("aj").style.visibility = 'hidden';
		document.getElementById("mod").style.visibility = 'hidden';
		
		//When page loads...
		$(".tab_content").hide(); //Hide all content
		$("ul.tabs li:first").addClass("active").show(); //Activate first tab
		$(".tab_content:first").show(); //Show first tab content
	
		//On Click Event
		$("ul.tabs li").click(function() {
	
			$("ul.tabs li").removeClass("active"); //Remove any "active" class
			$(this).addClass("active"); //Add "active" class to selected tab
			$(".tab_content").hide(); //Hide all tab content
	
			var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
			$(activeTab).fadeIn(); //Fade in the active ID content
			return false;
		});
	
	});

	function deleteUser()
	{
		var t = document.getElementById("listUser");
		t.remove(t.selectedIndex);
	}

	function AddGroupe()
	{
		var GroupeName = document.getElementById("groupeNom").value;
		document.getElementById('Gnom').value = GroupeName;
	
		//var t = document.getElementById("listUser");
		cpt = document.getElementById("listUser").options.length;
		var ids = "";
		for (var i=0; i<cpt; i++) {
		  ids = ids + ',' + document.getElementById('listUser').options[i].value;
		}
		document.getElementById('UserUID').value = ids;
		document.getElementById("newFormGroup").submit();	
	}

	function ajouterUserToGroupe()
	{
		var t = document.getElementById("selectUser");
		var m = document.getElementById('listUser');
		var option = document.createElement("option");
		option.text = t.options[t.selectedIndex].text;
		option.value = t.options[t.selectedIndex].value;
		m.add(option);
	}

	function deleteGroupe()
	{
		var t = document.getElementById('selectGroupe');
		var m = t.options[t.selectedIndex].value;
		document.getElementById('Gid').value = m;
		document.getElementById("deleteFormGroup").submit();
	}

	function modifierGroupe()
	{
		var GroupeName = document.getElementById("groupeNom").value;
		document.getElementById('newGnom').value = GroupeName;
		cpt = document.getElementById("listUser").options.length;
		var ids = "";
		for (var i=0; i<cpt; i++) {
		  ids = ids + ',' + document.getElementById('listUser').options[i].value;
		}
		document.getElementById('listU').value = ids;
		var t = document.getElementById('selectGroupe');
		var m = t.options[t.selectedIndex].value;
		document.getElementById('oldGid').value = m;
		document.getElementById("modFormGroup").submit();
	}

	function showToEdit()
	{
		var t = document.getElementById('selectGroupe');
		var m = t.options[t.selectedIndex].text;
		document.getElementById('groupeNom').value = m;
		document.getElementById("fMod1").style.visibility = 'visible';
		document.getElementById("fMod2").style.visibility = 'visible';
		document.getElementById("mod").style.visibility = 'visible';
		document.getElementById("aj").style.visibility = 'hidden';
	}
	
	function showToAdd()
	{
		document.getElementById("fMod1").style.visibility = 'visible';
		document.getElementById("fMod2").style.visibility = 'visible';
		document.getElementById("aj").style.visibility = 'visible';
		document.getElementById("mod").style.visibility = 'hidden';
	}
    </script>
<script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

</head>

<body>
	
	<?php
	include ('masterPage.php');
	include ('../DAO/FileAccess.php');
	?>
	
	
	<section id="main" class="column">

		<div class="clear"></div>

		<article class="module width_full">
			<header>
				<h3 class="tabs_involved">Groupe Manager</h3>
				<ul class="tabs">
					<li><a href="#tab2" onclick="showToAdd()">Nouveau Groupe +</a></li>
				</ul>
			</header>
			<div class="module_content">
				<div id="sel">
					<fieldset style="width: 100%; float: left; margin-right: 3%;">
						<!-- to make two field float next to one another, adjust values accordingly -->
						<label>Tags : </label>

						<table border="0" style="width: 100%">
							<tr>
								<td><select id="selectGroupe" style="width: 52%;">
							<?php
							readGroups ();
							$GroupsArry = $_SESSION ['GroupeTab'];
							foreach ( $GroupsArry as $Gr ) {
								echo '<option value="' . $Gr [0] . '">' . $Gr [1] . '</option>';
							}
							?>
							</select></td>
								<td style="padding: right"><input type="image"
									src="images/icn_edit.png" title="Edit" onclick="showToEdit()"></td>
								<td><input type="image" src="images/icn_trash.png" title="Trash"
									onclick="deleteGroupe()"></td>
							</tr>
						</table>

					</fieldset>
				</div>
				<div id="fMod1">
					<fieldset >
						<label>Groupe : </label>
						<form>
							<input type="text" size="50%" name="cat" id="groupeNom" />
						</form>
					</fieldset>
				</div>
				<div id="fMod2">
					<table  style="width: 100%">
						<tr>
							<td><select id="selectUser" style="width: 42%;">
								<?php
								readEtudiants ();
								$catArry = $_SESSION ['arrU'];
								foreach ( $catArry as $user ) {
									echo '<option value="' . $user [0] . '">' . $user [1] . '</option>';
								}
								?>
								</select>
							</td>
							<td style="padding: right">
								<input type="image"src="images/icn_edit.png" title="Edit"
									onclick="ajouterUserToGroupe()">
							</td>
							<td>
								<select id="listUser" style="width: 42%;">
								</select>
							</td>
							<td>
								<input type="image" src="images/icn_trash.png" title="Trash"
								onclick="deleteUser();">
							</td>
						</tr>
					</table>
				</div>


			</div>
			<footer>
				<div class="submit_link" >
					<input type="submit" id="aj" value="Ajouter" onclick="AddGroupe()"
						class="alt_btn">
				</div>
				<div class="submit_link" >
					<input type="submit" id="mod" value="Modifier" onclick="modifierGroupe()"
						class="alt_btn">
				</div>
			</footer>
		</article>
		<!-- end of post new article -->

		<div class="spacer"></div>

	</section>
	
	<form style="display: hidden" method="post" action="../Controlor/MainControlor.php?fun=modGroupes" id="modFormGroup">
		<input type="text" id="oldGid" name="oldGid">
		<input type="text" id="newGnom" name="newGnom">
		<input type="text" id="listU" name="listU">
	</form>
	
	<form style="display: hidden" method="post" action="../Controlor/MainControlor.php?fun=deleteGroupes" id="deleteFormGroup">
		<input type="text" id="Gid" name="Gid">
	</form>
	
	<form style="display: hidden" method="post" action="../Controlor/MainControlor.php?fun=addGroupes" id="newFormGroup">
		<input type="text" id="Gnom" name="Gnom">
		<input type="text" id="UserUID" name="USERsID">
	</form>

</body>
</html>